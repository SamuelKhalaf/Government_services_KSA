<?php

namespace App\Http\Controllers;

use App\Enums\PermissionEnum;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\BranchCommercialRegistration;
use App\Models\CivilDefenseLicense;
use App\Models\Company;
use App\Models\CompanyDocument;
use App\Models\Employee;
use App\Models\EmployeeDocument;
use App\Models\MunicipalityLicense;
use App\Models\Task;
use App\Models\TaskDocument;
use App\Models\User;
use App\Services\TaskHistoryService;
use App\Services\NotificationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        if (!auth()->user()->can(PermissionEnum::VIEW_ALL_TASKS->value) && 
            !auth()->user()->can(PermissionEnum::VIEW_ASSIGNED_TASKS->value)) {
            abort(403, __('tasks.cannot_view_tasks'));
        }

        $query = Task::with(['assignedUser', 'creator', 'histories.changedBy', 'taskDocuments']);

        // Apply filters based on user permissions
        if (auth()->user()->can(PermissionEnum::VIEW_ALL_TASKS->value)) {
            // Admin can see all tasks
        } elseif (auth()->user()->can(PermissionEnum::VIEW_ASSIGNED_TASKS->value)) {
            // Regular users can only see assigned tasks
            $query->where('assigned_to', auth()->id());
        } else {
            abort(403, __('tasks.cannot_view_tasks'));
        }

        // Apply filters
        // Note: Client filtering is now handled through documents, so this filter is removed

        if ($request->filled('assigned_to')) {
            $query->where('assigned_to', $request->assigned_to);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('due_date_from')) {
            $query->where('due_date', '>=', $request->due_date_from);
        }

        if ($request->filled('due_date_to')) {
            $query->where('due_date', '<=', $request->due_date_to);
        }

        if ($request->filled('overdue')) {
            $query->overdue();
        }

        if ($request->filled('due_soon')) {
            $query->dueSoon();
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Sorting
        $sortBy = $request->get('sort_by', 'created_at');
        $sortDirection = $request->get('sort_direction', 'desc');
        $query->orderBy($sortBy, $sortDirection);

        // Pagination
        $perPage = $request->get('per_page', 15);
        $tasks = $query->paginate($perPage);

        return view('admin.tasks.index', [
            'tasks' => $tasks,
            'users' => User::employees()->select('id', 'name')->get(), // Only employees
            'statuses' => Task::getStatuses(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        if (!auth()->user()->can(PermissionEnum::CREATE_TASKS->value)) {
            abort(403, __('tasks.cannot_create_tasks'));
        }

        return view('admin.tasks.create', [
            'clients' => Company::select('id', 'company_name_en')->get(),
            'statuses' => Task::getStatuses(),
            'documentTypes' => Task::getDocumentTypes(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $validatedData = $request->validated();
            $documents = $validatedData['documents'] ?? [];
            unset($validatedData['documents']);

            // Set created_by automatically to current authenticated user
            $validatedData['created_by'] = auth()->id();

            $task = Task::create($validatedData);

            // Create task document relationships if user has permission
            if (auth()->user()->can(PermissionEnum::MANAGE_TASK_DOCUMENTS->value)) {
                foreach ($documents as $document) {
                    TaskDocument::create([
                        'task_id' => $task->id,
                        'document_type' => $document['type'],
                        'document_id' => $document['id'],
                    ]);
                }
            }

            // Load relationships for history logging
            $task->load(['taskDocuments', 'assignedUser']);

            // Log task creation
            TaskHistoryService::logCreated($task, auth()->id());

            // Send notifications
            NotificationService::notifyTaskCreated($task, auth()->id());

            DB::commit();

            return redirect()->route('admin.tasks.show', $task)
                ->with('success', __('tasks.task_created_successfully'));

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('error', __('common.error_occurred') . ': ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task): View
    {
        // Check if user can view all tasks or if task is assigned to them
        if (!auth()->user()->can(PermissionEnum::VIEW_ALL_TASKS->value) && 
            (!auth()->user()->can(PermissionEnum::VIEW_ASSIGNED_TASKS->value) || $task->assigned_to !== auth()->id())) {
            abort(403, __('tasks.access_denied'));
        }

        $task->load(['assignedUser', 'creator', 'histories.changedBy', 'taskDocuments']);

        return view('admin.tasks.show', [
            'task' => $task,
            'histories' => $task->histories()->with('changedBy')->orderBy('created_at', 'desc')->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task): View
    {
        if (!auth()->user()->can(PermissionEnum::UPDATE_TASKS->value)) {
            abort(403, __('tasks.cannot_update_tasks'));
        }

        $task->load(['taskDocuments', 'assignedUser']);
        
        return view('admin.tasks.edit', [
            'task' => $task,
            'statuses' => Task::getStatuses(),
            'clients' => Company::select('id', 'company_name_en')->get(),
            'documentTypes' => Task::getDocumentTypes(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task): RedirectResponse
    {
        if (!auth()->user()->can(PermissionEnum::UPDATE_TASKS->value) && 
            !auth()->user()->can(PermissionEnum::COMPLETE_TASKS->value)) {
            abort(403, __('tasks.cannot_update_tasks'));
        }

        DB::beginTransaction();
        try {
            // Get old data for comparison
            $oldData = TaskHistoryService::getOldData($task);
            $oldStatus = $task->status;
            $oldAssignedTo = $task->assigned_to;

            // Check if user has full update permissions or only status update permissions
            if (auth()->user()->can(PermissionEnum::UPDATE_TASKS->value)) {
                // User has full update permissions
                $validatedData = $request->validated();
                $documents = $validatedData['documents'] ?? [];
                unset($validatedData['documents']);
                
                $task->update($validatedData);
                
                // Update documents if provided and user has permission to manage task documents
                if (!empty($documents) && auth()->user()->can(PermissionEnum::MANAGE_TASK_DOCUMENTS->value)) {
                    // Remove old document relationships
                    $task->taskDocuments()->delete();
                    
                    // Create new document relationships
                    foreach ($documents as $document) {
                        TaskDocument::create([
                            'task_id' => $task->id,
                            'document_type' => $document['type'],
                            'document_id' => $document['id'],
                        ]);
                    }
                }
            } elseif (auth()->user()->can(PermissionEnum::COMPLETE_TASKS->value)) {
                // User can only update status
                $validatedData = $request->validated();
                if (isset($validatedData['status'])) {
                    $task->update(['status' => $validatedData['status']]);
                }
            } else {
                abort(403, __('tasks.cannot_update_tasks'));
            }

            // Log changes
            TaskHistoryService::logUpdated($task, $oldData, auth()->id());

            // Send notifications
            if ($oldAssignedTo !== $task->assigned_to) {
                // Task was reassigned
                NotificationService::notifyTaskAssigned($task, $task->assigned_to, auth()->id());
            } else {
                // Task was updated but not reassigned
                NotificationService::notifyTaskUpdated($task, auth()->id());
            }

            // Log status change if it changed
            if ($oldStatus !== $task->status) {
                TaskHistoryService::logStatusChanged($task, $oldStatus, auth()->id());
                NotificationService::notifyTaskStatusChanged($task, $oldStatus, $task->status, auth()->id());
            }

            DB::commit();

            return redirect()->route('admin.tasks.show', $task)
                ->with('success', __('tasks.task_updated_successfully'));

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('error', __('common.error_occurred') . ': ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task): RedirectResponse
    {
        if (!auth()->user()->can(PermissionEnum::DELETE_TASKS->value)) {
            abort(403, __('tasks.cannot_delete_tasks'));
        }

        DB::beginTransaction();
        try {
            // Log task deletion before deleting
            TaskHistoryService::logDeleted($task, auth()->id());

            $task->delete();

            DB::commit();

            return redirect()->route('admin.tasks.index')
                ->with('success', __('tasks.task_deleted_successfully'));

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', __('common.error_occurred') . ': ' . $e->getMessage());
        }
    }

    /**
     * Show document assignment interface for admins
     */
    public function showAssignDocuments(): View
    {
        if (!auth()->user()->can(PermissionEnum::CREATE_TASKS->value)) {
            abort(403, __('tasks.cannot_create_tasks'));
        }

        return view('admin.tasks.assign-documents', [
            'employees' => User::employees()->select('id', 'name')->get(),
            'companyDocuments' => CompanyDocument::with(['company', 'documentType'])->get(),
            'employeeDocuments' => EmployeeDocument::with(['employee', 'documentType'])->get(),
            'statuses' => Task::getStatuses(),
        ]);
    }

    /**
     * Bulk assign documents to employees via tasks
     */
    public function bulkAssignDocuments(Request $request): RedirectResponse
    {
        if (!auth()->user()->can(PermissionEnum::CREATE_TASKS->value)) {
            abort(403, __('tasks.cannot_create_tasks'));
        }

        $request->validate([
            'assignments' => 'required|array|min:1',
            'assignments.*.document_type' => 'required|in:company_document,employee_document,civil_defense,municipality,branch_registration',
            'assignments.*.document_id' => 'required|integer|min:1',
            'assignments.*.assigned_to' => 'required|exists:users,id',
            'assignments.*.title' => 'required|string|max:255',
            'assignments.*.due_date' => 'nullable|date|after_or_equal:today',
        ]);

        DB::beginTransaction();
        try {
            $createdTasks = [];

            foreach ($request->assignments as $assignment) {
                // Create task
                $task = Task::create([
                    'title' => $assignment['title'],
                    'description' => $assignment['description'] ?? null,
                    'assigned_to' => $assignment['assigned_to'],
                    'status' => 'new',
                    'due_date' => $assignment['due_date'] ?? null,
                    'created_by' => auth()->id(),
                ]);

                // Create task document relationship if user has permission
                if (auth()->user()->can(PermissionEnum::MANAGE_TASK_DOCUMENTS->value)) {
                    TaskDocument::create([
                        'task_id' => $task->id,
                        'document_type' => $assignment['document_type'],
                        'document_id' => $assignment['document_id'],
                    ]);
                }

                // Load relationships for history logging
                $task->load(['taskDocuments', 'assignedUser']);

                // Log task creation
                TaskHistoryService::logCreated($task, auth()->id());

                // Send notifications
                NotificationService::notifyTaskCreated($task, auth()->id());

                $createdTasks[] = $task;
            }

            DB::commit();

            return redirect()->route('admin.tasks.index')
                ->with('success', __('tasks.bulk_tasks_created_successfully', ['count' => count($createdTasks)]));

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('error', __('common.error_occurred') . ': ' . $e->getMessage());
        }
    }

    /**
     * Get employees for a specific company (AJAX endpoint)
     */
    public function getCompanyEmployees(Request $request): JsonResponse
    {
        $request->validate([
            'company_id' => 'required|exists:companies,id'
        ]);

        $employees = Employee::where('company_id', $request->company_id)
            ->where('status', 'active')
            ->select('id', 'full_name_en', 'full_name_ar', 'job_title')
            ->get()
            ->map(function ($employee) {
                $locale = app()->getLocale();
                $name = $locale === 'ar' ? $employee->full_name_ar : $employee->full_name_en;
                
                return [
                    'id' => $employee->id,
                    'name' => $name . ' (' . $employee->job_title . ')',
                ];
            });

        return response()->json($employees);
    }

    /**
     * Get company documents for a specific company (AJAX endpoint)
     */
    public function getCompanyDocuments(Request $request): JsonResponse
    {
        $request->validate([
            'company_id' => 'required|exists:companies,id'
        ]);

        $locale = app()->getLocale();
        $nameField = $locale === 'ar' ? 'name_ar' : 'name_en';
        $documents = collect();

        // 1. Get CompanyDocument records
        $companyDocs = CompanyDocument::with('documentType')
            ->where('company_id', $request->company_id)
            ->select('id', 'document_type_id', 'status', 'custom_fields')
            ->get()
            ->map(function ($doc) use ($nameField) {
                $documentName = $doc->documentType->{$nameField} ?? $doc->documentType->name_en ?? 'Unknown Document';
                
                // Try to get document number from custom fields
                $documentNumber = null;
                if ($doc->custom_fields && is_array($doc->custom_fields)) {
                    // Common field names for document numbers
                    $numberFields = ['document_number', 'number', 'registration_number', 'license_number'];
                    foreach ($numberFields as $field) {
                        if (isset($doc->custom_fields[$field]) && !empty($doc->custom_fields[$field])) {
                            $documentNumber = $doc->custom_fields[$field];
                            break;
                        }
                    }
                }
                
                $displayName = $documentNumber ? "{$documentName} ({$documentNumber})" : $documentName;
                
                return [
                    'id' => $doc->id,
                    'name' => $displayName,
                    'status' => $doc->status,
                    'type' => 'company_document'
                ];
            });

        // Return only company documents (not licenses/registrations)
        $documents = $companyDocs;

        return response()->json($documents);
    }

    /**
     * Get company licenses/registrations for a specific company and type (AJAX endpoint)
     */
    public function getCompanyLicenses(Request $request): JsonResponse
    {
        $request->validate([
            'company_id' => 'required|exists:companies,id',
            'type' => 'required|in:civil_defense,municipality,branch_registration'
        ]);

        $locale = app()->getLocale();
        $documents = collect();

        switch ($request->type) {
            case 'civil_defense':
                $documents = CivilDefenseLicense::where('company_id', $request->company_id)
                    ->select('id', 'license_number')
                    ->get()
                    ->map(function ($doc) use ($locale) {
                        $documentName = $locale === 'ar' ? 'رخصة الدفاع المدني' : 'Civil Defense License';
                        $displayName = $doc->license_number ? "{$documentName} ({$doc->license_number})" : $documentName;
                        
                        return [
                            'id' => $doc->id,
                            'name' => $displayName,
                            'status' => 'active',
                            'type' => 'civil_defense'
                        ];
                    });
                break;

            case 'municipality':
                $documents = MunicipalityLicense::where('company_id', $request->company_id)
                    ->select('id', 'license_number')
                    ->get()
                    ->map(function ($doc) use ($locale) {
                        $documentName = $locale === 'ar' ? 'رخصة البلدية' : 'Municipality License';
                        $displayName = $doc->license_number ? "{$documentName} ({$doc->license_number})" : $documentName;
                        
                        return [
                            'id' => $doc->id,
                            'name' => $displayName,
                            'status' => 'active',
                            'type' => 'municipality'
                        ];
                    });
                break;

            case 'branch_registration':
                $documents = BranchCommercialRegistration::where('company_id', $request->company_id)
                    ->select('id', 'branch_reg_number')
                    ->get()
                    ->map(function ($doc) use ($locale) {
                        $documentName = $locale === 'ar' ? 'السجل التجاري للفرع' : 'Branch Commercial Registration';
                        $displayName = $doc->branch_reg_number ? "{$documentName} ({$doc->branch_reg_number})" : $documentName;
                        
                        return [
                            'id' => $doc->id,
                            'name' => $displayName,
                            'status' => 'active',
                            'type' => 'branch_registration'
                        ];
                    });
                break;
        }

        return response()->json($documents);
    }

    /**
     * Get employee documents for a specific employee (AJAX endpoint)
     */
    public function getEmployeeDocuments(Request $request): JsonResponse
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id'
        ]);

        $documents = EmployeeDocument::with('documentType')
            ->where('employee_id', $request->employee_id)
            ->select('id', 'document_type_id', 'employee_id', 'status', 'custom_fields')
            ->get()
            ->map(function ($doc) {
                $locale = app()->getLocale();
                $nameField = $locale === 'ar' ? 'name_ar' : 'name_en';
                $documentName = $doc->documentType->{$nameField} ?? $doc->documentType->name_en ?? 'Unknown Document';
                
                // Try to get document number from custom fields
                $documentNumber = null;
                if ($doc->custom_fields && is_array($doc->custom_fields)) {
                    // Common field names for document numbers
                    $numberFields = ['document_number', 'number', 'registration_number', 'license_number', 'id_number', 'passport_number', 'iqama_number'];
                    foreach ($numberFields as $field) {
                        if (isset($doc->custom_fields[$field]) && !empty($doc->custom_fields[$field])) {
                            $documentNumber = $doc->custom_fields[$field];
                            break;
                        }
                    }
                }
                
                $displayName = $documentNumber ? "{$documentName} ({$documentNumber})" : $documentName;
                
                return [
                    'id' => $doc->id,
                    'name' => $displayName,
                    'status' => $doc->status
                ];
            });

        return response()->json($documents);
    }

    /**
     * Get users with employee role for assignment (AJAX endpoint)
     */
    public function getEmployeesForAssignment(Request $request): JsonResponse
    {
        $employees = User::whereHas('roles', function ($query) {
            $query->where('name', 'employee');
        })
        ->where('status', 'active')
        ->select('id', 'name', 'email')
        ->get();

        return response()->json($employees);
    }

}

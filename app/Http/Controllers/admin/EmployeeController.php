<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Company;
use App\Models\Employee;
use App\Models\DocumentType;
use App\Http\Controllers\admin\DocumentTypeController;
use App\Services\PackageValidationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Employee::with(['company', 'documents.documentType']);

        // If user is employee, only show assigned employees
        if (auth()->user()->isEmployee()) {
            $assignedEmployeeIds = auth()->user()->getAssignedEmployeeIds()->toArray();
            $query->whereIn('id', $assignedEmployeeIds);
        }

        // Search functionality
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        // Filter by company
        if ($request->filled('company_id')) {
            $query->where('company_id', $request->company_id);
        }

        // Filter by employee type
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Filter by nationality
        if ($request->filled('nationality')) {
            $query->where('nationality', 'like', '%' . $request->nationality . '%');
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by documents expiring soon
        if ($request->boolean('expiring_soon')) {
            $query->withExpiringDocuments();
        }

        // Filter by contract type
        if ($request->filled('contract_type')) {
            $query->where('contract_type', $request->contract_type);
        }

        $employees = $query->latest()->paginate(15);

        // Get filter options - for employees, only show options for their assigned employees
        if (auth()->user()->isEmployee()) {
            $assignedEmployeeIds = auth()->user()->getAssignedEmployeeIds()->toArray();
            $assignedCompanyIds = auth()->user()->getAssignedCompanyIds()->toArray();
            $companies = Company::whereIn('id', $assignedCompanyIds)->select('id', 'company_name_en', 'company_name_ar')->get();
            $nationalities = Employee::whereIn('id', $assignedEmployeeIds)->distinct()->pluck('nationality')->filter()->sort();
        } else {
            $companies = Company::select('id', 'company_name_en', 'company_name_ar')->get();
            $nationalities = Employee::distinct()->pluck('nationality')->filter()->sort();
        }
        
        $contractTypes = ['permanent', 'temporary', 'part_time', 'contract'];
        
        return view('admin.employees.index', compact('employees', 'companies', 'nationalities', 'contractTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Company $company)
    {
        // Get package validation information
        $packageValidationService = new PackageValidationService();
        $packageStatus = $packageValidationService->getPackageStatus($company);
        $warnings = $packageValidationService->getWarningMessages($company);
        $canAddEmployee = $packageValidationService->canAddEmployee($company);
        
        return view('admin.employees.create', compact('company', 'packageStatus', 'warnings', 'canAddEmployee'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request, Company $company)
    {
        // Validate package limits before creating employee
        $packageValidationService = new PackageValidationService();
        $validation = $packageValidationService->canAddEmployee($company);
        
        if (!$validation['allowed']) {
            return back()
                ->withInput()
                ->with('error', $validation['message']);
        }

        try {
            DB::beginTransaction();

            $employeeData = $request->validated();
            $employeeData['company_id'] = $company->id;

            $employee = Employee::create($employeeData);

            DB::commit();

            return redirect()
                ->route('admin.employees.show', $employee)
                ->with('success', __('Employee created successfully.'));
        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->withInput()
                ->with('error', __('An error occurred while creating the employee. Please try again.'));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        // If user is employee, check if they have access to this employee
        if (auth()->user()->isEmployee()) {
            $assignedEmployeeIds = auth()->user()->getAssignedEmployeeIds()->toArray();
            
            // Only show this employee if they're assigned to the user's tasks
            if (!in_array($employee->id, $assignedEmployeeIds)) {
                abort(403, 'You do not have access to this employee.');
            }
            
            $employee->load([
                'company',
                'documents' => function ($query) {
                    // Only show documents that are related to employee's tasks
                    $query->whereHas('taskDocuments.task', function ($q) {
                        $q->where('assigned_to', auth()->id());
                    })->with('documentType')->latest();
                }
            ]);
        } else {
            // Admin users see all data
            $employee->load([
                'company',
                'documents' => function ($query) {
                    $query->with('documentType')->latest();
                }
            ]);
        }

        // Get document statistics
        $documentStats = [
            'total_documents' => $employee->documents->count(),
            'active_documents' => $employee->activeDocuments->count(),
            'expiring_soon' => $employee->expiring_soon_documents->count(),
            'expired_documents' => $employee->documents()->expired()->count()
        ];

        // Get available document types using DocumentTypeController for consistency
        $documentTypeController = app(DocumentTypeController::class);
        $availableDocumentTypes = $documentTypeController->getCompatibleDocumentTypes($employee);

        return view('admin.employees.show', compact('employee', 'documentStats', 'availableDocumentTypes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        $employee->load('company');
        return view('admin.employees.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        try {
            DB::beginTransaction();

            $employee->update($request->validated());

            DB::commit();

            return redirect()
                ->route('admin.employees.show', $employee)
                ->with('success', __('Employee updated successfully.'));
        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->withInput()
                ->with('error', __('An error occurred while updating the employee. Please try again.'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        try {
            DB::beginTransaction();

            // Check if employee has documents
            if ($employee->documents()->count() > 0) {
                return back()->with('error', __('Cannot delete employee with existing documents. Please remove all documents first.'));
            }

            $companyId = $employee->company_id;
            $employee->delete();

            DB::commit();

            return redirect()
                ->route('admin.companies.show', $companyId)
                ->with('success', __('Employee deleted successfully.'));
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', __('An error occurred while deleting the employee. Please try again.'));
        }
    }

    /**
     * Search employees via AJAX
     */
    public function search(Request $request)
    {
        $query = Employee::with('company');

        if ($request->filled('term')) {
            $query->search($request->term);
        }

        if ($request->filled('company_id')) {
            $query->where('company_id', $request->company_id);
        }

        $employees = $query->select('id', 'full_name_ar', 'full_name_en', 'job_title', 'type', 'company_id')
            ->limit(10)
            ->get();

        return response()->json($employees);
    }
}
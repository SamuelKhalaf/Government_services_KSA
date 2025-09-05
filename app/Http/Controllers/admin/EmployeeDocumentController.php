<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeeDocumentRequest;
use App\Http\Requests\UpdateEmployeeDocumentRequest;
use App\Models\Employee;
use App\Models\EmployeeDocument;
use App\Models\DocumentType;
use App\Http\Controllers\admin\DocumentTypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Enums\PermissionEnum;

class EmployeeDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = EmployeeDocument::with(['employee.company', 'documentType']);

        // Search functionality
        if ($request->filled('search')) {
            $query->whereHas('employee', function ($q) use ($request) {
                $q->search($request->search);
            })->orWhere('document_number', 'like', '%' . $request->search . '%');
        }

        // Filter by document type
        if ($request->filled('document_type_id')) {
            $query->where('document_type_id', $request->document_type_id);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by employee type
        if ($request->filled('employee_type')) {
            $query->whereHas('employee', function ($q) use ($request) {
                $q->where('type', $request->employee_type);
            });
        }

        // Filter by company
        if ($request->filled('company_id')) {
            $query->whereHas('employee', function ($q) use ($request) {
                $q->where('company_id', $request->company_id);
            });
        }

        // Filter by expiring soon
        if ($request->boolean('expiring_soon')) {
            $query->expiringSoon();
        }

        // Filter by expired documents
        if ($request->boolean('expired')) {
            $query->expired();
        }

        $documents = $query->latest()->paginate(15);

        // Get filter options using DocumentTypeController for consistency
        $documentTypeController = app(DocumentTypeController::class);
        $documentTypes = $documentTypeController->getCompatibleDocumentTypes(new Employee());
        
        return view('admin.documents.index', compact('documents', 'documentTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Employee $employee)
    {
        $employee->load('company');
        
        // Use DocumentTypeController method for consistency
        $documentTypeController = app(DocumentTypeController::class);
        $documentTypes = $documentTypeController->getCompatibleDocumentTypes($employee);

        // Validate that employee has compatible document types available
        if ($documentTypes->isEmpty()) {
            return back()->with('error', __('documents.no_compatible_document_types'));
        }

        return view('admin.documents.create', compact('employee', 'documentTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeDocumentRequest $request, Employee $employee)
    {
        try {
            DB::beginTransaction();

            $documentData = $request->validated();
            $documentData['employee_id'] = $employee->id;

            // Get document type to apply specific logic
            $documentType = DocumentType::find($documentData['document_type_id']);
            
            if (!$documentType) {
                throw new \Exception(__('documents.document_type_not_found'));
            }

            // Validate document type compatibility with employee
            $this->validateDocumentTypeCompatibility($documentType, $employee);
            
            // Handle file upload if required by document type
            if ($request->hasFile('document_file')) {
                $file = $request->file('document_file');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('employee_documents/' . $employee->id, $filename, 'public');
                
                $documentData['file_path'] = $path;
                $documentData['original_filename'] = $file->getClientOriginalName();
                $documentData['file_type'] = $file->getClientOriginalExtension();
                $documentData['file_size'] = $file->getSize();
            } elseif ($documentType->requires_file_upload) {
                // If file is required but not provided, throw error
                throw new \Exception(__('documents.file_upload_required'));
            }

            // Set default status if not provided
            if (!isset($documentData['status'])) {
                $documentData['status'] = 'active';
            }

            // Apply document type specific logic
            $documentData = $this->applyDocumentTypeLogic($documentData, $documentType);

            $document = EmployeeDocument::create($documentData);

            DB::commit();

            return redirect()
                ->route('admin.employees.show', $employee)
                ->with('success', __('documents.document_uploaded_successfully'));
        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->withInput()
                ->with('error', $e->getMessage() ?: __('documents.error_uploading_document'));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee, EmployeeDocument $document)
    {
        $document->load(['employee.company', 'documentType']);
        
        return view('admin.documents.show', compact('document'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee, EmployeeDocument $document)
    {
        $document->load(['employee.company', 'documentType']);
        
        // Use DocumentTypeController method for consistency
        $documentTypeController = app(DocumentTypeController::class);
        $documentTypes = $documentTypeController->getCompatibleDocumentTypes($employee);

        // Validate that employee has compatible document types available
        if ($documentTypes->isEmpty()) {
            return back()->with('error', __('documents.no_compatible_document_types'));
        }

        return view('admin.documents.edit', compact('document', 'documentTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeDocumentRequest $request, Employee $employee, EmployeeDocument $document)
    {
        try {
            DB::beginTransaction();

            $documentData = $request->validated();

            // Get document type to apply specific logic
            $documentType = DocumentType::find($documentData['document_type_id']);
            
            if (!$documentType) {
                throw new \Exception(__('documents.document_type_not_found'));
            }

            // Validate document type compatibility with employee
            $this->validateDocumentTypeCompatibility($documentType, $employee);
            
            // Handle file upload if required by document type
            if ($request->hasFile('document_file')) {
                // Delete old file if exists
                if ($document->file_path && Storage::disk('public')->exists($document->file_path)) {
                    Storage::disk('public')->delete($document->file_path);
                }

                $file = $request->file('document_file');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('employee_documents/' . $employee->id, $filename, 'public');
                
                $documentData['file_path'] = $path;
                $documentData['original_filename'] = $file->getClientOriginalName();
                $documentData['file_type'] = $file->getClientOriginalExtension();
                $documentData['file_size'] = $file->getSize();
            } elseif ($documentType->requires_file_upload && !$document->file_path) {
                // If file is required but not provided and no existing file, throw error
                throw new \Exception(__('documents.file_upload_required'));
            }

            // Apply document type specific logic
            $documentData = $this->applyDocumentTypeLogic($documentData, $documentType);

            $document->update($documentData);

            DB::commit();

            return redirect()
                ->route('admin.employees.show', $employee)
                ->with('success', __('documents.document_updated_successfully'));
        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->withInput()
                ->with('error', $e->getMessage() ?: __('documents.error_updating_document'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee, EmployeeDocument $document)
    {
        try {
            DB::beginTransaction();

            // Delete file if exists
            if ($document->file_path && Storage::disk('public')->exists($document->file_path)) {
                Storage::disk('public')->delete($document->file_path);
            }

            $document->delete();

            DB::commit();

            return redirect()
                ->route('admin.employees.show', $employee)
                ->with('success', __('documents.document_deleted_successfully'));
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', __('documents.error_deleting_document'));
        }
    }

    /**
     * Download document file
     */
    public function download(EmployeeDocument $document)
    {
        if (!$document->file_path || !Storage::disk('public')->exists($document->file_path)) {
            return back()->with('error', __('documents.document_file_not_found'));
        }

        return Storage::disk('public')->download($document->file_path, $document->original_filename);
    }

    /**
     * Validate document type compatibility with employee
     */
    private function validateDocumentTypeCompatibility(DocumentType $documentType, Employee $employee): void
    {
        // Check if document type is for employees
        if ($documentType->category !== 'employee') {
            throw new \Exception(__('documents.document_type_not_for_employees'));
        }

        // Check if document type is compatible with employee type
        if ($employee->type === 'saudi' && !in_array($documentType->entity_type, ['saudi', 'both'])) {
            throw new \Exception(__('documents.document_type_not_compatible_saudi'));
        }

        if ($employee->type === 'expat' && !in_array($documentType->entity_type, ['expat', 'both'])) {
            throw new \Exception(__('documents.document_type_not_compatible_expat'));
        }

        // Check if document type is active
        if (!$documentType->is_active) {
            throw new \Exception(__('documents.document_type_inactive'));
        }
    }

    /**
     * Apply document type specific logic to document data
     */
    private function applyDocumentTypeLogic(array $documentData, DocumentType $documentType): array
    {
        // Set auto reminder if document type has it enabled
        if ($documentType->has_auto_reminder && $documentType->requires_expiry_date) {
            $documentData['auto_reminder'] = true;
            if (isset($documentData['expiry_date'])) {
                $expiryDate = \Carbon\Carbon::parse($documentData['expiry_date']);
                $reminderDate = $expiryDate->subDays($documentType->reminder_days_before ?? 30);
                $documentData['reminder_date'] = $reminderDate;
            }
        } else {
            $documentData['auto_reminder'] = false;
            $documentData['reminder_date'] = null;
        }

        // Set default values based on document type requirements
        if ($documentType->requires_expiry_date && !isset($documentData['expiry_date'])) {
            // Set a default expiry date (e.g., 1 year from now)
            $documentData['expiry_date'] = now()->addYear();
        }

        // Apply custom field validation based on document type
        if ($documentType->required_fields && is_array($documentType->required_fields)) {
            foreach ($documentType->required_fields as $field) {
                if (!isset($documentData[$field]) || empty($documentData[$field])) {
                    throw new \Exception(__('documents.required_field_missing', ['field' => $field]));
                }
            }
        }

        return $documentData;
    }
}
<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeeDocumentRequest;
use App\Http\Requests\UpdateEmployeeDocumentRequest;
use App\Models\Employee;
use App\Models\EmployeeDocument;
use App\Models\DocumentType;
use App\Http\Controllers\admin\DocumentTypeController;
use App\Services\PackageValidationService;
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

        // If user is employee, only show documents assigned to them via tasks
        if (auth()->user()->isEmployee()) {
            $assignedDocumentIds = auth()->user()->assignedTasks()
                ->with('taskDocuments')
                ->get()
                ->pluck('taskDocuments')
                ->flatten()
                ->where('document_type', 'employee_document')
                ->pluck('document_id')
                ->toArray();
                
            $query->whereIn('id', $assignedDocumentIds);
        }

        // Search functionality
        if ($request->filled('search')) {
            $query->whereHas('employee', function ($q) use ($request) {
                $q->search($request->search);
            })->orWhereRaw("JSON_EXTRACT(custom_fields, '$.document_number') LIKE ?", ['%' . $request->search . '%']);
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
    public function store(Request $request, Employee $employee)
    {
        // Validate package limits before creating employee document
        $packageValidationService = new PackageValidationService();
        $validation = $packageValidationService->canAddEmployeeDocument($employee->company);
        
        if (!$validation['allowed']) {
            return back()
                ->withInput()
                ->with('error', $validation['message']);
        }

        try {
            DB::beginTransaction();

            // Get document type to apply specific logic
            $documentType = DocumentType::find($request->document_type_id);
            
            if (!$documentType) {
                throw new \Exception(__('documents.document_type_not_found'));
            }

            // Validate document type compatibility with employee
            $this->validateDocumentTypeCompatibility($documentType, $employee);
            
            // Get validation rules from document type
            $validationRules = $documentType->getAllValidationRules();
            $customMessages = $this->getCustomValidationMessages($documentType);
            $validatedData = $request->validate($validationRules, $customMessages);

            // Prepare document data
            $documentData = [
                'employee_id' => $employee->id,
                'document_type_id' => $documentType->id,
                'status' => $validatedData['status'] ?? 'active',
                'custom_fields' => []
            ];

            // Process custom fields from document type
            if ($documentType->custom_fields && is_array($documentType->custom_fields)) {
                foreach ($documentType->custom_fields as $field) {
                    $fieldKey = $field['key'];
                    $fieldType = $field['type'];
                    
                    if (isset($validatedData[$fieldKey])) {
                        $value = $validatedData[$fieldKey];
                        
                        // Handle file uploads
                        if ($fieldType === 'file' && $request->hasFile($fieldKey)) {
                            $file = $request->file($fieldKey);
                            $filename = time() . '_' . $file->getClientOriginalName();
                            $path = $file->storeAs('employee_documents/' . $employee->id, $filename, 'public');
                            
                            $documentData['custom_fields'][$fieldKey] = [
                                'file_path' => $path,
                                'original_filename' => $file->getClientOriginalName(),
                                'file_type' => $file->getClientOriginalExtension(),
                                'file_size' => $file->getSize(),
                            ];
                        } else {
                            $documentData['custom_fields'][$fieldKey] = $value;
                        }
                    }
                }
            }

            // Handle reminder settings
            $documentData['enable_reminder'] = $request->boolean('enable_reminder');
            
            if (isset($validatedData['reminder_days'])) {
                $documentData['reminder_days'] = $validatedData['reminder_days'];
            }

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
        
        return view('admin.documents.show', compact('document', 'employee'));
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

        return view('admin.documents.edit', compact('document', 'documentTypes', 'employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee, EmployeeDocument $document)
    {
        try {
            DB::beginTransaction();

            // Get document type to apply specific logic
            $documentType = DocumentType::find($request->document_type_id);
            
            if (!$documentType) {
                throw new \Exception(__('documents.document_type_not_found'));
            }

            // Validate document type compatibility with employee
            $this->validateDocumentTypeCompatibility($documentType, $employee);
            
            // Get validation rules from document type
            $validationRules = $documentType->getAllValidationRules();
            $customMessages = $this->getCustomValidationMessages($documentType);
            $validatedData = $request->validate($validationRules, $customMessages);

            // Prepare document data
            $documentData = [
                'document_type_id' => $documentType->id,
                'status' => $validatedData['status'] ?? $document->status,
                'custom_fields' => $document->custom_fields ?? []
            ];

            // Process custom fields from document type
            if ($documentType->custom_fields && is_array($documentType->custom_fields)) {
                foreach ($documentType->custom_fields as $field) {
                    $fieldKey = $field['key'];
                    $fieldType = $field['type'];
                    
                    if (isset($validatedData[$fieldKey])) {
                        $value = $validatedData[$fieldKey];
                        
                        // Handle file uploads
                        if ($fieldType === 'file' && $request->hasFile($fieldKey)) {
                            // Delete old file if exists
                            if (isset($document->custom_fields[$fieldKey]['file_path']) && Storage::disk('public')->exists($document->custom_fields[$fieldKey]['file_path'])) {
                                Storage::disk('public')->delete($document->custom_fields[$fieldKey]['file_path']);
                            }

                            $file = $request->file($fieldKey);
                            $filename = time() . '_' . $file->getClientOriginalName();
                            $path = $file->storeAs('employee_documents/' . $employee->id, $filename, 'public');
                            
                            $documentData['custom_fields'][$fieldKey] = [
                                'file_path' => $path,
                                'original_filename' => $file->getClientOriginalName(),
                                'file_type' => $file->getClientOriginalExtension(),
                                'file_size' => $file->getSize(),
                            ];
                        } else {
                            $documentData['custom_fields'][$fieldKey] = $value;
                        }
                    }
                }
            }

            // Handle reminder settings
            $documentData['enable_reminder'] = $request->boolean('enable_reminder');
            
            if (isset($validatedData['reminder_days'])) {
                $documentData['reminder_days'] = $validatedData['reminder_days'];
            }

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

            // Delete custom field files if they exist
            if ($document->custom_fields && is_array($document->custom_fields)) {
                foreach ($document->custom_fields as $fieldKey => $fieldData) {
                    if (isset($fieldData['file_path']) && Storage::disk('public')->exists($fieldData['file_path'])) {
                        Storage::disk('public')->delete($fieldData['file_path']);
                    }
                }
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
     * Download document file (with employee parameter)
     */
    public function download(Employee $employee, EmployeeDocument $document)
    {
        // Try custom field files
        if ($document->custom_fields && is_array($document->custom_fields)) {
            foreach ($document->custom_fields as $fieldKey => $fieldData) {
                if (isset($fieldData['file_path']) && Storage::disk('public')->exists($fieldData['file_path'])) {
                    return Storage::disk('public')->download($fieldData['file_path'], $fieldData['original_filename']);
                }
            }
        }

        return back()->with('error', __('documents.document_file_not_found'));
    }

    /**
     * Download document file (legacy route without employee parameter)
     */
    public function downloadLegacy(EmployeeDocument $document)
    {
        // Try custom field files
        if ($document->custom_fields && is_array($document->custom_fields)) {
            foreach ($document->custom_fields as $fieldKey => $fieldData) {
                if (isset($fieldData['file_path']) && Storage::disk('public')->exists($fieldData['file_path'])) {
                    return Storage::disk('public')->download($fieldData['file_path'], $fieldData['original_filename']);
                }
            }
        }

        return back()->with('error', __('documents.document_file_not_found'));
    }

    /**
     * Get custom validation messages for document type fields
     */
    private function getCustomValidationMessages(DocumentType $documentType): array
    {
        $messages = [];
        
        if ($documentType->custom_fields && is_array($documentType->custom_fields)) {
            foreach ($documentType->custom_fields as $field) {
                $fieldKey = $field['key'];
                $fieldName = app()->getLocale() === 'ar' ? $field['name_ar'] : $field['name_en'];
                
                // Required field messages
                $messages[$fieldKey . '.required'] = __('documents.required_field_missing', ['field' => $fieldName]);
                
                // Field-specific messages
                switch ($field['type'] ?? 'text') {
                    case 'email':
                        $messages[$fieldKey . '.email'] = __('documents.invalid_email_format', ['field' => $fieldName]);
                        break;
                    case 'date':
                        $messages[$fieldKey . '.date'] = __('documents.invalid_date_format', ['field' => $fieldName]);
                        break;
                    case 'number':
                        $messages[$fieldKey . '.numeric'] = __('documents.invalid_number_format', ['field' => $fieldName]);
                        break;
                    case 'file':
                        $messages[$fieldKey . '.file'] = __('documents.invalid_file_format', ['field' => $fieldName]);
                        $messages[$fieldKey . '.mimes'] = __('documents.invalid_file_type', ['field' => $fieldName]);
                        $messages[$fieldKey . '.max'] = __('documents.file_too_large', ['field' => $fieldName]);
                        break;
                    case 'select':
                        $messages[$fieldKey . '.in'] = __('documents.invalid_selection', ['field' => $fieldName]);
                        break;
                    default:
                        $messages[$fieldKey . '.string'] = __('documents.invalid_text_format', ['field' => $fieldName]);
                        $messages[$fieldKey . '.max'] = __('documents.text_too_long', ['field' => $fieldName]);
                        break;
                }
            }
        }
        
        return $messages;
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
     * Download document file
     */
    public function downloadFile(EmployeeDocument $document, $fieldKey)
    {
        if (!$document->custom_fields || !isset($document->custom_fields[$fieldKey])) {
            return back()->with('error', __('documents.document_file_not_found'));
        }

        $fileData = $document->custom_fields[$fieldKey];
        
        if (!isset($fileData['file_path']) || !Storage::disk('public')->exists($fileData['file_path'])) {
            return back()->with('error', __('documents.document_file_not_found'));
        }

        return Storage::disk('public')->download($fileData['file_path'], $fileData['original_filename']);
    }
}
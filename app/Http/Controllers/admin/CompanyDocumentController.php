<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyDocument;
use App\Models\DocumentType;
use App\Services\PackageValidationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class CompanyDocumentController extends Controller
{
    /**
     * Display a listing of all company documents from all companies.
     */
    public function allIndex()
    {
        $documentsQuery = CompanyDocument::with(['company', 'documentType']);
        
        // If user is employee, only show documents assigned to them via tasks
        if (auth()->user()->isEmployee()) {
            $assignedDocumentIds = auth()->user()->assignedTasks()
                ->with('taskDocuments')
                ->get()
                ->pluck('taskDocuments')
                ->flatten()
                ->where('document_type', 'company_document')
                ->pluck('document_id')
                ->toArray();
                
            $documentsQuery->whereIn('id', $assignedDocumentIds);
        }
        
        $documents = $documentsQuery->latest()->paginate(15);

        return view('admin.companies.documents.all-index', compact('documents'));
    }

    /**
     * Display a listing of the resource for a specific company.
     */
    public function index(Company $company)
    {
        $company->load(['companyDocuments.documentType']);
        
        $documentsQuery = $company->companyDocuments()->with('documentType');
        
        // If user is employee, only show documents assigned to them via tasks
        if (auth()->user()->isEmployee()) {
            $assignedDocumentIds = auth()->user()->assignedTasks()
                ->with('taskDocuments')
                ->get()
                ->pluck('taskDocuments')
                ->flatten()
                ->where('document_type', 'company_document')
                ->pluck('document_id')
                ->toArray();
                
            $documentsQuery->whereIn('id', $assignedDocumentIds);
        }
        
        $documents = $documentsQuery->latest()->paginate(15);

        return view('admin.companies.documents.index', compact('company', 'documents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Company $company)
    {
        $documentTypes = $company->getCompatibleDocumentTypes();
        
        if ($documentTypes->isEmpty()) {
            return back()->with('error', __('No compatible document types found for this company.'));
        }

        // Get package validation information
        $packageValidationService = new PackageValidationService();
        $packageStatus = $packageValidationService->getPackageStatus($company);
        $warnings = $packageValidationService->getWarningMessages($company);
        $canAddDocument = $packageValidationService->canAddCompanyDocument($company);

        return view('admin.companies.documents.create', compact('company', 'documentTypes', 'packageStatus', 'warnings', 'canAddDocument'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Company $company)
    {
        // Validate package limits before creating company document
        $packageValidationService = new PackageValidationService();
        $validation = $packageValidationService->canAddCompanyDocument($company);
        
        if (!$validation['allowed']) {
            return back()
                ->withInput()
                ->with('error', $validation['message']);
        }

        $documentType = DocumentType::findOrFail($request->document_type_id);
        
        // Validate basic fields
        $validatedData = $request->validate([
            'document_type_id' => 'required|exists:document_types,id',
            'status' => 'required|in:active,expired,cancelled,pending',
            'enable_reminder' => 'nullable|boolean',
            'reminder_days' => 'nullable|integer|min:1|max:365',
        ]);

        // Get custom field validation rules
        $customRules = $documentType->getCustomFieldsValidationRules();
        $customMessages = $this->getCustomValidationMessages($documentType);
        
        // Validate custom fields
        $customData = $request->validate($customRules, $customMessages);

        try {
            DB::beginTransaction();

            // Prepare document data
            $documentData = [
                'company_id' => $company->id,
                'document_type_id' => $validatedData['document_type_id'],
                'status' => $validatedData['status'],
                'enable_reminder' => $request->boolean('enable_reminder'),
                'reminder_days' => $validatedData['reminder_days'] ?? null,
                'custom_fields' => []
            ];

            // Process custom fields
            foreach ($documentType->custom_fields as $field) {
                $fieldKey = $field['key'];
                $fieldType = $field['type'];
                $isRequired = $field['required'] ?? false;

                if ($fieldType === 'file') {
                    if ($request->hasFile($fieldKey)) {
                        $file = $request->file($fieldKey);
                        $filename = time() . '_' . $file->getClientOriginalName();
                        $path = $file->storeAs('company-documents', $filename, 'public');
                        
                        $documentData['custom_fields'][$fieldKey] = [
                            'file_path' => $path,
                            'original_filename' => $file->getClientOriginalName(),
                            'file_type' => $file->getMimeType(),
                            'file_size' => $file->getSize(),
                        ];
                    }
                } else {
                    $value = $request->input($fieldKey);
                    if ($value !== null) {
                        $documentData['custom_fields'][$fieldKey] = $value;
                    }
                }
            }

            // Create the document
            $document = CompanyDocument::create($documentData);

            DB::commit();

            return redirect()
                ->route('admin.companies.documents.show', [$company, $document])
                ->with('success', __('Document created successfully.'));

        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->withInput()
                ->with('error', __('An error occurred while creating the document. Please try again.'));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company, CompanyDocument $document)
    {
        $document->load(['company', 'documentType']);
        
        return view('admin.companies.documents.show', compact('company', 'document'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company, CompanyDocument $document)
    {
        $document->load(['company', 'documentType']);
        $documentTypes = $company->getCompatibleDocumentTypes();
        
        if ($documentTypes->isEmpty()) {
            return back()->with('error', __('No compatible document types found for this company.'));
        }

        return view('admin.companies.documents.edit', compact('company', 'document', 'documentTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company, CompanyDocument $document)
    {
        $documentType = $document->documentType;
        
        // Validate basic fields
        $validatedData = $request->validate([
            'document_type_id' => 'required|exists:document_types,id',
            'status' => 'required|in:active,expired,cancelled,pending',
            'enable_reminder' => 'nullable|boolean',
            'reminder_days' => 'nullable|integer|min:1|max:365',
        ]);

        // Get custom field validation rules
        $customRules = $documentType->getCustomFieldsValidationRules();
        $customMessages = $this->getCustomValidationMessages($documentType);
        
        // Validate custom fields
        $customData = $request->validate($customRules, $customMessages);

        try {
            DB::beginTransaction();

            // Prepare document data
            $documentData = [
                'document_type_id' => $validatedData['document_type_id'],
                'status' => $validatedData['status'],
                'enable_reminder' => $request->boolean('enable_reminder'),
                'reminder_days' => $validatedData['reminder_days'] ?? null,
            ];

            // Process custom fields
            $customFields = $document->custom_fields ?? [];
            
            foreach ($documentType->custom_fields as $field) {
                $fieldKey = $field['key'];
                $fieldType = $field['type'];

                if ($fieldType === 'file') {
                    if ($request->hasFile($fieldKey)) {
                        // Delete old file if exists
                        if (isset($customFields[$fieldKey]['file_path'])) {
                            Storage::disk('public')->delete($customFields[$fieldKey]['file_path']);
                        }
                        
                        $file = $request->file($fieldKey);
                        $filename = time() . '_' . $file->getClientOriginalName();
                        $path = $file->storeAs('company-documents', $filename, 'public');
                        
                        $customFields[$fieldKey] = [
                            'file_path' => $path,
                            'original_filename' => $file->getClientOriginalName(),
                            'file_type' => $file->getMimeType(),
                            'file_size' => $file->getSize(),
                        ];
                    }
                } else {
                    $value = $request->input($fieldKey);
                    if ($value !== null) {
                        $customFields[$fieldKey] = $value;
                    }
                }
            }

            $documentData['custom_fields'] = $customFields;

            // Update the document
            $document->update($documentData);

            DB::commit();

            return redirect()
                ->route('admin.companies.documents.show', [$company, $document])
                ->with('success', __('Document updated successfully.'));

        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->withInput()
                ->with('error', __('An error occurred while updating the document. Please try again.'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company, CompanyDocument $document)
    {
        try {
            DB::beginTransaction();

            // Delete associated files
            if ($document->custom_fields && is_array($document->custom_fields)) {
                foreach ($document->custom_fields as $fieldKey => $fieldData) {
                    if (isset($fieldData['file_path']) && Storage::disk('public')->exists($fieldData['file_path'])) {
                        Storage::disk('public')->delete($fieldData['file_path']);
                    }
                }
            }

            $document->delete();

            DB::commit();

            // Return JSON for AJAX requests
            if (request()->wantsJson() || request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => __('Document deleted successfully.')
                ]);
            }

            return redirect()
                ->route('admin.companies.documents.index', $company)
                ->with('success', __('Document deleted successfully.'));

        } catch (\Exception $e) {
            DB::rollBack();
            
            // Return JSON error for AJAX requests
            if (request()->wantsJson() || request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => __('An error occurred while deleting the document. Please try again.')
                ], 500);
            }
            
            return back()->with('error', __('An error occurred while deleting the document. Please try again.'));
        }
    }

    /**
     * Download document file
     */
    public function download(Company $company, CompanyDocument $document)
    {
        // Try custom field files
        if ($document->custom_fields && is_array($document->custom_fields)) {
            foreach ($document->custom_fields as $fieldKey => $fieldData) {
                if (isset($fieldData['file_path']) && Storage::disk('public')->exists($fieldData['file_path'])) {
                    return Storage::disk('public')->download($fieldData['file_path'], $fieldData['original_filename']);
                }
            }
        }
        
        return back()->with('error', __('Document file not found.'));
    }

    /**
     * Get custom validation messages for document type
     */
    private function getCustomValidationMessages(DocumentType $documentType): array
    {
        $messages = [];
        
        if (!$documentType->custom_fields || !is_array($documentType->custom_fields)) {
            return $messages;
        }

        foreach ($documentType->custom_fields as $field) {
            $fieldKey = $field['key'];
            $fieldName = app()->getLocale() === 'ar' ? $field['name_ar'] : $field['name_en'];
            
            $messages["{$fieldKey}.required"] = __('The :field field is required.', ['field' => $fieldName]);
            $messages["{$fieldKey}.file"] = __('The :field must be a file.', ['field' => $fieldName]);
            $messages["{$fieldKey}.mimes"] = __('The :field must be a file of type: :values.', ['field' => $fieldName, 'values' => 'pdf,doc,docx,jpg,jpeg,png']);
            $messages["{$fieldKey}.max"] = __('The :field may not be greater than :max kilobytes.', ['field' => $fieldName, 'max' => 10240]);
        }

        return $messages;
    }
}

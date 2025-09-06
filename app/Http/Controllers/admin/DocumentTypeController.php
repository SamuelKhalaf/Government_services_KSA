<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\DocumentType;
use App\Models\EmployeeDocument;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DocumentTypeController extends Controller
{
    /**
     * Display a listing of document types
     */
    public function index(Request $request)
    {
        $query = DocumentType::query();

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Filter by entity type
        if ($request->filled('entity_type')) {
            if ($request->entity_type === 'saudi') {
                $query->forSaudi();
            } elseif ($request->entity_type === 'expat') {
                $query->forExpat();
            }
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('is_active', $request->boolean('status'));
        }

        $documentTypes = $query->ordered()->paginate(15);

        return view('admin.document-types.index', compact('documentTypes'));
    }

    /**
     * Show the form for creating a new document type
     */
    public function create()
    {
        return view('admin.document-types.create');
    }

    /**
     * Store a newly created document type
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:document_types,code',
            'category' => 'required|in:employee,company',
            'entity_type' => 'required|in:saudi,expat,both',
            'reminder_days_before' => 'nullable|integer|min:1|max:365',
            'custom_fields' => 'nullable|array',
            'quick_fields' => 'nullable|array',
            'quick_fields.*.name_en' => 'required|string|max:255',
            'quick_fields.*.name_ar' => 'required|string|max:255',
            'quick_fields.*.key' => 'required|string|max:100',
            'quick_fields.*.type' => 'required|in:text,number,email,date,file,select,textarea',
            'quick_fields.*.required' => 'boolean',
            'quick_fields.*.placeholder_en' => 'nullable|string|max:255',
            'quick_fields.*.placeholder_ar' => 'nullable|string|max:255',
            'custom_fields.*.key' => 'required|string|max:100',
            'custom_fields.*.name_en' => 'required|string|max:255',
            'custom_fields.*.name_ar' => 'required|string|max:255',
            'custom_fields.*.type' => 'required|in:text,number,email,date,file,select,textarea',
            'custom_fields.*.required' => 'boolean',
            'custom_fields.*.options' => 'nullable|array',
            'custom_fields.*.placeholder_en' => 'nullable|string|max:255',
            'custom_fields.*.placeholder_ar' => 'nullable|string|max:255',
            'description_en' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        try {
            DB::beginTransaction();

            $data = $request->all();
            
            // Ensure is_active is properly set as boolean
            $data['is_active'] = $request->boolean('is_active');
            
            // Merge quick_fields with custom_fields
            if ($request->has('quick_fields')) {
                $quickFields = collect($request->quick_fields)->map(function ($field) {
                    return [
                        'name_en' => $field['name_en'],
                        'name_ar' => $field['name_ar'],
                        'key' => $field['key'],
                        'type' => $field['type'],
                        'required' => (bool) $field['required'],
                        'placeholder_en' => $field['placeholder_en'] ?? '',
                        'placeholder_ar' => $field['placeholder_ar'] ?? '',
                    ];
                })->toArray();
                
                $existingCustomFields = $data['custom_fields'] ?? [];
                $data['custom_fields'] = array_merge($existingCustomFields, $quickFields);
            }
            
            unset($data['quick_fields']); // Remove quick_fields from data
            
            $documentType = DocumentType::create($data);

            DB::commit();

            return redirect()
                ->route('admin.document-types.index')
                ->with('success', __('document-types.document_type_created_successfully'));
        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->withInput()
                ->with('error', __('document-types.error_creating_document_type'));
        }
    }

    /**
     * Show the form for editing the specified document type
     */
    public function edit(DocumentType $type)
    {
        return view('admin.document-types.edit', compact('type'));
    }

    /**
     * Update the specified document type
     */
    public function update(Request $request, DocumentType $type)
    {
        $request->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:document_types,code,' . $type->id,
            'category' => 'required|in:employee,company',
            'entity_type' => 'required|in:saudi,expat,both',
            'reminder_days_before' => 'nullable|integer|min:1|max:365',
            'custom_fields' => 'nullable|array',
            'quick_fields' => 'nullable|array',
            'quick_fields.*.name_en' => 'required|string|max:255',
            'quick_fields.*.name_ar' => 'required|string|max:255',
            'quick_fields.*.key' => 'required|string|max:100',
            'quick_fields.*.type' => 'required|in:text,number,email,date,file,select,textarea',
            'quick_fields.*.required' => 'boolean',
            'quick_fields.*.placeholder_en' => 'nullable|string|max:255',
            'quick_fields.*.placeholder_ar' => 'nullable|string|max:255',
            'custom_fields.*.key' => 'required|string|max:100',
            'custom_fields.*.name_en' => 'required|string|max:255',
            'custom_fields.*.name_ar' => 'required|string|max:255',
            'custom_fields.*.type' => 'required|in:text,number,email,date,file,select,textarea',
            'custom_fields.*.required' => 'boolean',
            'custom_fields.*.options' => 'nullable|array',
            'custom_fields.*.placeholder_en' => 'nullable|string|max:255',
            'custom_fields.*.placeholder_ar' => 'nullable|string|max:255',
            'description_en' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        try {
            DB::beginTransaction();

            $data = $request->all();
            
            // Ensure is_active is properly set as boolean
            $data['is_active'] = $request->boolean('is_active');
            
            // Merge quick_fields with custom_fields
            if ($request->has('quick_fields')) {
                $quickFields = collect($request->quick_fields)->map(function ($field) {
                    return [
                        'name_en' => $field['name_en'],
                        'name_ar' => $field['name_ar'],
                        'key' => $field['key'],
                        'type' => $field['type'],
                        'required' => (bool) $field['required'],
                        'placeholder_en' => $field['placeholder_en'] ?? '',
                        'placeholder_ar' => $field['placeholder_ar'] ?? '',
                    ];
                })->toArray();
                
                $existingCustomFields = $data['custom_fields'] ?? [];
                $data['custom_fields'] = array_merge($existingCustomFields, $quickFields);
            }
            
            unset($data['quick_fields']); // Remove quick_fields from data
            
            $type->update($data);

            DB::commit();

            return redirect()
                ->route('admin.document-types.index')
                ->with('success', __('document-types.document_type_updated_successfully'));
        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->withInput()
                ->with('error', __('document-types.error_updating_document_type'));
        }
    }

    /**
     * Remove the specified document type
     */
    public function destroy(DocumentType $type)
    {
        try {
            DB::beginTransaction();

            // Check if document type is being used
            if ($type->employeeDocuments()->exists()) {
                return back()->with('error', __('document-types.cannot_delete_document_type'));
            }

            $type->delete();

            DB::commit();

            return redirect()
                ->route('admin.document-types.index')
                ->with('success', __('document-types.document_type_deleted_successfully'));
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', __('document-types.error_deleting_document_type'));
        }
    }

    /**
     * Get dynamic fields for a specific document type
     */
    public function getFields(DocumentType $type)
    {
        return response()->json([
            'success' => true,
            'data' => [
                'id' => $type->id,
                'name' => $type->name_en,
                'name_ar' => $type->name_ar,
                'category' => $type->category,
                'entity_type' => $type->entity_type,
                'reminder_days_before' => $type->reminder_days_before,
                'custom_fields' => $type->custom_fields ?? [],
                'description' => $type->description_en,
                'description_ar' => $type->description_ar,
                'is_active' => $type->is_active,
                'validation_rules' => $this->getValidationRules($type),
            ],
        ]);
    }

    /**
     * Get document types for employee based on type
     */
    public function getEmployeeDocumentTypes(Request $request)
    {
        $employeeType = $request->get('employee_type'); // saudi or expat

        $query = DocumentType::active()->forEmployees();

        if ($employeeType === 'saudi') {
            $query->forSaudi();
        } elseif ($employeeType === 'expat') {
            $query->forExpat();
        }

        $documentTypes = $query->ordered()->get();

        return response()->json([
            'success' => true,
            'data' => $documentTypes->map(function ($type) {
                return [
                    'id' => $type->id,
                    'name' => $type->name_en,
                    'name_ar' => $type->name_ar,
                    'code' => $type->code,
                    'category' => $type->category,
                    'entity_type' => $type->entity_type,
                    'reminder_days_before' => $type->reminder_days_before,
                    'custom_fields' => $type->custom_fields ?? [],
                    'validation_rules' => $this->getValidationRules($type),
                    'is_active' => $type->is_active,
                ];
            }),
        ]);
    }

    /**
     * Get document statistics by type
     */
    public function getStatistics()
    {
        $stats = DocumentType::active()
            ->withCount('employeeDocuments')
            ->get()
            ->map(function ($type) {
                return [
                    'id' => $type->id,
                    'name' => $type->name_en,
                    'name_ar' => $type->name_ar,
                    'category' => $type->category,
                    'total_documents' => $type->employee_documents_count,
                    'custom_fields_count' => $type->custom_fields_count,
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $stats,
        ]);
    }

    /**
     * Get validation rules for a specific document type
     */
    private function getValidationRules(DocumentType $type): array
    {
        $rules = [
            'document_type_id' => 'required|exists:document_types,id',
            'document_number' => 'nullable|string|max:255',
            'issue_date' => 'nullable|date',
            'issuing_authority' => 'nullable|string|max:255',
            'place_of_issue' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'renewal_notes' => 'nullable|string',
        ];

        // Expiry date validation can be handled through custom fields
        $rules['expiry_date'] = 'nullable|date|after:today';

        // File upload validation can be handled through custom fields
        $rules['document_file'] = 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240';

        // Custom field validation is now handled by getCustomFieldsValidationRules()

        // Apply custom fields validation
        $customRules = $type->getCustomFieldsValidationRules();
        $rules = array_merge($rules, $customRules);

        return $rules;
    }

    /**
     * Get document types compatible with employee
     */
    public function getCompatibleDocumentTypes(Employee $employee)
    {
        $query = DocumentType::active()
            ->forEmployees()
            ->when($employee->type === 'saudi', function ($query) {
                return $query->forSaudi();
            })
            ->when($employee->type === 'expat', function ($query) {
                return $query->forExpat();
            });

        return $query->ordered()->get();
    }

    /**
     * Validate document type compatibility with employee
     */
    public function validateEmployeeCompatibility(DocumentType $documentType, Employee $employee): bool
    {
        // Check if document type is for employees
        if ($documentType->category !== 'employee') {
            return false;
        }

        // Check if document type is compatible with employee type
        if ($employee->type === 'saudi' && !in_array($documentType->entity_type, ['saudi', 'both'])) {
            return false;
        }

        if ($employee->type === 'expat' && !in_array($documentType->entity_type, ['expat', 'both'])) {
            return false;
        }

        // Check if document type is active
        if (!$documentType->is_active) {
            return false;
        }

        return true;
    }
}

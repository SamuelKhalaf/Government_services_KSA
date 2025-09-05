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
            'requires_expiry_date' => 'boolean',
            'requires_file_upload' => 'boolean',
            'has_auto_reminder' => 'boolean',
            'reminder_days_before' => 'nullable|integer|min:1|max:365',
            'required_fields' => 'nullable|array',
            'optional_fields' => 'nullable|array',
            'icon' => 'nullable|string|max:100',
            'color' => 'nullable|string|max:7',
            'description_en' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean'
        ]);

        try {
            DB::beginTransaction();

            $documentType = DocumentType::create($request->all());

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
            'requires_expiry_date' => 'boolean',
            'requires_file_upload' => 'boolean',
            'has_auto_reminder' => 'boolean',
            'reminder_days_before' => 'nullable|integer|min:1|max:365',
            'required_fields' => 'nullable|array',
            'optional_fields' => 'nullable|array',
            'icon' => 'nullable|string|max:100',
            'color' => 'nullable|string|max:7',
            'description_en' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean'
        ]);

        try {
            DB::beginTransaction();

            $type->update($request->all());

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
                'requires_expiry_date' => $type->requires_expiry_date,
                'requires_file_upload' => $type->requires_file_upload,
                'has_auto_reminder' => $type->has_auto_reminder,
                'reminder_days_before' => $type->reminder_days_before,
                'required_fields' => $type->required_fields ?? [],
                'optional_fields' => $type->optional_fields ?? [],
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
                    'requires_expiry_date' => $type->requires_expiry_date,
                    'requires_file_upload' => $type->requires_file_upload,
                    'has_auto_reminder' => $type->has_auto_reminder,
                    'reminder_days_before' => $type->reminder_days_before,
                    'required_fields' => $type->required_fields ?? [],
                    'optional_fields' => $type->optional_fields ?? [],
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
                    'color' => $type->color,
                    'icon' => $type->icon,
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

        // Apply expiry date validation if required
        if ($type->requires_expiry_date) {
            $rules['expiry_date'] = 'required|date|after:today';
        } else {
            $rules['expiry_date'] = 'nullable|date|after:today';
        }

        // Apply file upload validation if required
        if ($type->requires_file_upload) {
            $rules['document_file'] = 'required|file|mimes:pdf,jpg,jpeg,png|max:10240';
        } else {
            $rules['document_file'] = 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240';
        }

        // Apply custom field validation based on required_fields
        if ($type->required_fields && is_array($type->required_fields)) {
            foreach ($type->required_fields as $field) {
                if (!isset($rules[$field])) {
                    $rules[$field] = 'required|string|max:255';
                }
            }
        }

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

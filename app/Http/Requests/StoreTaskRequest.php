<?php

namespace App\Http\Requests;

use App\Enums\PermissionEnum;
use App\Models\CompanyDocument;
use App\Models\EmployeeDocument;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can(PermissionEnum::CREATE_TASKS->value);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'documents' => [
                'required',
                'array',
                'min:1',
                function ($attribute, $value, $fail) {
                    // Check if user has permission to manage task documents
                    if (!$this->user()->can(PermissionEnum::MANAGE_TASK_DOCUMENTS->value)) {
                        $fail(__('tasks.cannot_manage_task_documents'));
                    }
                }
            ],
            'documents.*.type' => 'required|in:company_document,employee_document,civil_defense,municipality,branch_registration',
            'documents.*.id' => [
                'required',
                'integer',
                'min:1',
                function ($attribute, $value, $fail) {
                    $index = explode('.', $attribute)[1];
                    $documentType = $this->input("documents.{$index}.type");
                    
                    switch ($documentType) {
                        case 'company_document':
                            if (!\App\Models\CompanyDocument::find($value)) {
                                $fail(__('tasks.company_document_not_found'));
                            }
                            break;
                        case 'employee_document':
                            if (!\App\Models\EmployeeDocument::find($value)) {
                                $fail(__('tasks.employee_document_not_found'));
                            }
                            break;
                        case 'civil_defense':
                            if (!\App\Models\CivilDefenseLicense::find($value)) {
                                $fail(__('tasks.civil_defense_license_not_found'));
                            }
                            break;
                        case 'municipality':
                            if (!\App\Models\MunicipalityLicense::find($value)) {
                                $fail(__('tasks.municipality_license_not_found'));
                            }
                            break;
                        case 'branch_registration':
                            if (!\App\Models\BranchCommercialRegistration::find($value)) {
                                $fail(__('tasks.branch_registration_not_found'));
                            }
                            break;
                    }
                }
            ],
            'assigned_to' => [
                'required',
                'exists:users,id',
                function ($attribute, $value, $fail) {
                    $user = \App\Models\User::find($value);
                    if ($user && !$user->hasRole('employee')) {
                        $fail(__('tasks.user_must_be_employee'));
                    }
                }
            ],
            'status' => 'nullable|in:new,in_progress,completed,pending',
            'due_date' => 'nullable|date|after_or_equal:today',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'title.required' => __('tasks.title_required'),
            'title.max' => __('tasks.title_max'),
            'client_id.required' => __('tasks.client_required'),
            'client_id.exists' => __('tasks.client_not_found'),
            'documents.required' => __('tasks.documents_required'),
            'documents.min' => __('tasks.documents_min_one'),
            'documents.*.type.required' => __('tasks.document_type_required'),
            'documents.*.type.in' => __('tasks.document_type_invalid'),
            'documents.*.id.required' => __('tasks.document_required'),
            'documents.*.id.integer' => __('tasks.document_invalid'),
            'assigned_to.required' => __('tasks.assigned_to_required'),
            'assigned_to.exists' => __('tasks.assigned_to_not_found'),
            'status.in' => __('tasks.status_invalid'),
            'due_date.date' => __('tasks.due_date_invalid'),
            'due_date.after_or_equal' => __('tasks.due_date_future'),
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'status' => $this->status ?? 'new',
        ]);
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePackageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'max_employees' => 'nullable|integer|min:1',
            'max_employee_documents' => 'nullable|integer|min:1',
            'max_company_documents' => 'nullable|integer|min:1',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|integer|min:1',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'name.required' => __('packages.validation.name_required'),
            'name.max' => __('packages.validation.name_max'),
            'max_employees.integer' => __('packages.validation.max_employees_integer'),
            'max_employees.min' => __('packages.validation.max_employees_min'),
            'max_employee_documents.integer' => __('packages.validation.max_employee_documents_integer'),
            'max_employee_documents.min' => __('packages.validation.max_employee_documents_min'),
            'max_company_documents.integer' => __('packages.validation.max_company_documents_integer'),
            'max_company_documents.min' => __('packages.validation.max_company_documents_min'),
            'price.required' => __('packages.validation.price_required'),
            'price.numeric' => __('packages.validation.price_numeric'),
            'price.min' => __('packages.validation.price_min'),
            'duration.required' => __('packages.validation.duration_required'),
            'duration.integer' => __('packages.validation.duration_integer'),
            'duration.min' => __('packages.validation.duration_min'),
        ];
    }
}

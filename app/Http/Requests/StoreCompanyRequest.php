<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompanyRequest extends FormRequest
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
            // Basic Company Information
            'company_name_ar' => 'required|string|max:255',
            'company_name_en' => 'required|string|max:255',
            'cr_number' => 'required|string|max:255|unique:companies,cr_number',
            'establishment_number' => 'nullable|string|max:255',
            'license_number' => 'nullable|string|max:255',
            'tax_number' => 'nullable|string|max:255|unique:companies,tax_number',
            'company_type' => 'required|string|max:255',
            'isic_code' => 'nullable|string|max:255',

            // Contact Information
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'website' => 'nullable|url|max:255',

            // Address Information
            'region' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'street' => 'required|string|max:255',
            'building_number' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:255',
            'additional_location' => 'nullable|string',

            // Legal Information
            'owner_name' => 'required|string|max:255',
            'owner_id_number' => 'required|string|max:255',
            'owner_nationality' => 'required|string|max:255',
            'legal_status' => 'required|string|max:255',
            'establishment_date' => 'required|date',
            'capital_amount' => 'nullable|numeric|min:0',

            'status' => 'nullable|in:active,inactive,suspended'
        ];
    }

    /**
     * Get custom error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'company_name_ar.required' => 'اسم المنشأة بالعربية مطلوب',
            'company_name_en.required' => 'Company name in English is required',
            'cr_number.required' => 'رقم السجل التجاري مطلوب',
            'cr_number.unique' => 'رقم السجل التجاري موجود مسبقاً',
            'tax_number.unique' => 'الرقم الضريبي موجود مسبقاً',
            'email.email' => 'يجب أن يكون البريد الإلكتروني صحيحاً',
            'website.url' => 'يجب أن يكون الموقع الإلكتروني رابطاً صحيحاً',
            'establishment_date.required' => 'تاريخ التأسيس مطلوب',
            'establishment_date.date' => 'تاريخ التأسيس يجب أن يكون تاريخاً صحيحاً'
        ];
    }
}

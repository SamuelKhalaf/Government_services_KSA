<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
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
        $employeeId = $this->route('employee')->id;
        
        return [
            // Personal Information
            'full_name_ar' => 'required|string|max:255',
            'full_name_en' => 'required|string|max:255',
            'type' => 'required|in:saudi,expat',
            'nationality' => 'required|string|max:255',
            'dob_hijri' => 'nullable|date',
            'dob_greg' => 'required|date',
            'pob' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
            'marital_status' => 'required|in:single,married,divorced,widowed',
            'religion' => 'nullable|string|max:255',
            'education' => 'nullable|string|max:255',
            'specialization' => 'nullable|string|max:255',
            
            // Identity Information - Saudi
            'national_id' => 'required_if:type,saudi|nullable|string|max:255|unique:employees,national_id,' . $employeeId,
            'national_id_issue_date' => 'required_if:type,saudi|nullable|date',
            'national_id_expiry_date' => 'required_if:type,saudi|nullable|date|after:today',
            'national_id_issue_place' => 'required_if:type,saudi|nullable|string|max:255',
            
            // Identity Information - Expat
            'iqama_number' => 'required_if:type,expat|nullable|string|max:255|unique:employees,iqama_number,' . $employeeId,
            'iqama_issue_date' => 'required_if:type,expat|nullable|date',
            'iqama_expiry_date' => 'required_if:type,expat|nullable|date|after:today',
            'border_number' => 'nullable|string|max:255',
            'passport_number' => 'required_if:type,expat|nullable|string|max:255|unique:employees,passport_number,' . $employeeId,
            'passport_issue_date' => 'required_if:type,expat|nullable|date',
            'passport_expiry_date' => 'required_if:type,expat|nullable|date|after:today',
            'passport_issue_place' => 'required_if:type,expat|nullable|string|max:255',
            
            // Contact Information
            'primary_mobile' => 'required|string|max:255',
            'secondary_mobile' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            
            // Address Information
            'region' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'street' => 'required|string|max:255',
            'building_number' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:255',
            'pobox' => 'nullable|string|max:255',
            
            // Job Information
            'job_title' => 'required|string|max:255',
            'hire_date' => 'required|date',
            'contract_type' => 'required|in:permanent,temporary,part_time,contract',
            'basic_salary' => 'required|numeric|min:0',
            'allowances' => 'nullable|numeric|min:0',
            
            // Social Insurance Information
            'gosi_number' => 'nullable|string|max:255',
            'medical_insurance_number' => 'nullable|string|max:255',
            'saned_number' => 'nullable|string|max:255',
            
            'status' => 'nullable|in:active,inactive,terminated,on_leave'
        ];
    }

    /**
     * Get custom error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'full_name_ar.required' => 'الاسم بالعربية مطلوب',
            'full_name_en.required' => 'Name in English is required',
            'type.required' => 'نوع الموظف مطلوب',
            'nationality.required' => 'الجنسية مطلوبة',
            'dob_greg.required' => 'تاريخ الميلاد مطلوب',
            'national_id.required_if' => 'رقم الهوية مطلوب للمواطنين السعوديين',
            'national_id.unique' => 'رقم الهوية موجود مسبقاً',
            'iqama_number.required_if' => 'رقم الإقامة مطلوب للمقيمين',
            'iqama_number.unique' => 'رقم الإقامة موجود مسبقاً',
            'passport_number.required_if' => 'رقم جواز السفر مطلوب للمقيمين',
            'passport_number.unique' => 'رقم جواز السفر موجود مسبقاً',
            'primary_mobile.required' => 'رقم الجوال الأساسي مطلوب',
            'job_title.required' => 'المسمى الوظيفي مطلوب',
            'hire_date.required' => 'تاريخ التعيين مطلوب',
            'basic_salary.required' => 'الراتب الأساسي مطلوب'
        ];
    }
}

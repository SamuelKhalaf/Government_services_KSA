<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMunicipalityLicenseRequest extends FormRequest
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
            // Basic License Information
            'license_number' => 'required|string|max:255',
            'municipality_name' => 'required|string|max:255',
            'license_type' => 'required|in:commercial,industrial,residential,construction,demolition,advertising,event,other',
            'activity_desc' => 'required|string|max:2000',
            'land_use_type' => 'required|in:commercial,industrial,residential,mixed,administrative,educational,health,recreational',
            
            // Location and Area Information
            'location_code' => 'required|string|max:255',
            'area' => 'required|numeric|min:0',
            'zone_classification' => 'required|string|max:255',
            'building_permit_number' => 'nullable|string|max:255',
            
            // Dates
            'issue_date' => 'required|date',
            'expiry_date' => 'required|date|after:issue_date',
            
            // Financial Information
            'license_fees' => 'nullable|numeric|min:0',
            
            // Additional Information
            'conditions' => 'nullable|string|max:2000',
            'notes' => 'nullable|string|max:2000',
            
            // File Upload
            'certificate_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240', // 10MB max
            
            // Status
            'status' => 'nullable|in:active,expired,suspended,cancelled'
        ];
    }

    /**
     * Get custom error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'license_number.required' => 'رقم الترخيص مطلوب',
            'license_number.max' => 'رقم الترخيص يجب ألا يزيد عن 255 حرف',
            
            'municipality_name.required' => 'اسم البلدية مطلوب',
            'municipality_name.max' => 'اسم البلدية يجب ألا يزيد عن 255 حرف',
            
            'license_type.required' => 'نوع الترخيص مطلوب',
            'license_type.in' => 'نوع الترخيص المحدد غير صحيح',
            
            'activity_desc.required' => 'وصف النشاط مطلوب',
            'activity_desc.max' => 'وصف النشاط يجب ألا يزيد عن 2000 حرف',
            
            'land_use_type.required' => 'نوع استخدام الأرض مطلوب',
            'land_use_type.in' => 'نوع استخدام الأرض المحدد غير صحيح',
            
            'location_code.required' => 'رمز الموقع مطلوب',
            'location_code.max' => 'رمز الموقع يجب ألا يزيد عن 255 حرف',
            
            'area.required' => 'المساحة مطلوبة',
            'area.numeric' => 'المساحة يجب أن تكون رقماً',
            'area.min' => 'المساحة يجب أن تكون أكبر من صفر',
            
            'zone_classification.required' => 'تصنيف المنطقة مطلوب',
            'zone_classification.max' => 'تصنيف المنطقة يجب ألا يزيد عن 255 حرف',
            
            'building_permit_number.max' => 'رقم تصريح البناء يجب ألا يزيد عن 255 حرف',
            
            'issue_date.required' => 'تاريخ الإصدار مطلوب',
            'issue_date.date' => 'تاريخ الإصدار يجب أن يكون تاريخاً صحيحاً',
            
            'expiry_date.required' => 'تاريخ الانتهاء مطلوب',
            'expiry_date.date' => 'تاريخ الانتهاء يجب أن يكون تاريخاً صحيحاً',
            'expiry_date.after' => 'تاريخ الانتهاء يجب أن يكون بعد تاريخ الإصدار',
            
            'license_fees.numeric' => 'رسوم الترخيص يجب أن تكون رقماً',
            'license_fees.min' => 'رسوم الترخيص يجب أن تكون أكبر من أو تساوي صفر',
            
            'conditions.max' => 'الشروط والمتطلبات يجب ألا تزيد عن 2000 حرف',
            'notes.max' => 'الملاحظات يجب ألا تزيد عن 2000 حرف',
            
            'certificate_file.file' => 'يجب أن يكون الملف المرفوع صحيحاً',
            'certificate_file.mimes' => 'يجب أن يكون الملف من نوع: PDF, JPG, JPEG, PNG',
            'certificate_file.max' => 'حجم الملف يجب ألا يزيد عن 10 ميجابايت',
            
            'status.in' => 'حالة الترخيص المحددة غير صحيحة'
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'license_number' => 'رقم الترخيص',
            'municipality_name' => 'اسم البلدية',
            'license_type' => 'نوع الترخيص',
            'activity_desc' => 'وصف النشاط',
            'land_use_type' => 'نوع استخدام الأرض',
            'location_code' => 'رمز الموقع',
            'area' => 'المساحة',
            'zone_classification' => 'تصنيف المنطقة',
            'building_permit_number' => 'رقم تصريح البناء',
            'issue_date' => 'تاريخ الإصدار',
            'expiry_date' => 'تاريخ الانتهاء',
            'license_fees' => 'رسوم الترخيص',
            'conditions' => 'الشروط والمتطلبات',
            'certificate_file' => 'ملف الشهادة',
            'notes' => 'الملاحظات'
        ];
    }
}

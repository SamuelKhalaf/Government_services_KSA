<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCivilDefenseLicenseRequest extends FormRequest
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
            'authority' => 'required|string|max:255',
            'activity_classification' => 'required|string|max:255',
            'issue_date' => 'required|date',
            'expiry_date' => 'required|date|after:issue_date',
            
            // Facility Information
            'total_area' => 'required|numeric|min:0',
            'floors' => 'required|integer|min:1|max:200',
            'facility_type' => 'required|in:warehouse,factory,office,retail,restaurant,hotel,hospital,school,residential,mixed_use,other',
            
            // Safety & Inspection
            'safety_status' => 'required|in:compliant,non_compliant,partial_compliance,under_review',
            'inspection_status' => 'required|in:passed,failed,pending,scheduled,overdue',
            'last_inspection_date' => 'nullable|date|before_or_equal:today',
            'next_inspection_date' => 'nullable|date|after:last_inspection_date',
            
            // Additional Information
            'issuing_authority' => 'nullable|string|max:255',
            'location_details' => 'nullable|string|max:1000',
            'safety_requirements' => 'nullable|string|max:2000',
            'inspection_notes' => 'nullable|string|max:2000',
            'notes' => 'nullable|string|max:2000',
            
            // File Upload
            'certificate_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240', // 10MB max
            
            // Status
            'status' => 'nullable|in:active,expired,suspended,cancelled',

            // Reminder Settings
            'enable_reminder' => 'nullable|boolean',
            'reminder_days' => 'nullable|integer|min:1|max:365'
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
            
            'authority.required' => 'الجهة المصدرة مطلوبة',
            'authority.max' => 'الجهة المصدرة يجب ألا تزيد عن 255 حرف',
            
            'activity_classification.required' => 'تصنيف النشاط مطلوب',
            'activity_classification.max' => 'تصنيف النشاط يجب ألا يزيد عن 255 حرف',
            
            'issue_date.required' => 'تاريخ الإصدار مطلوب',
            'issue_date.date' => 'تاريخ الإصدار يجب أن يكون تاريخاً صحيحاً',
            
            'expiry_date.required' => 'تاريخ الانتهاء مطلوب',
            'expiry_date.date' => 'تاريخ الانتهاء يجب أن يكون تاريخاً صحيحاً',
            'expiry_date.after' => 'تاريخ الانتهاء يجب أن يكون بعد تاريخ الإصدار',
            
            'total_area.required' => 'المساحة الإجمالية مطلوبة',
            'total_area.numeric' => 'المساحة الإجمالية يجب أن تكون رقماً',
            'total_area.min' => 'المساحة الإجمالية يجب أن تكون أكبر من صفر',
            
            'floors.required' => 'عدد الطوابق مطلوب',
            'floors.integer' => 'عدد الطوابق يجب أن يكون رقماً صحيحاً',
            'floors.min' => 'عدد الطوابق يجب أن يكون على الأقل 1',
            'floors.max' => 'عدد الطوابق يجب ألا يزيد عن 200',
            
            'facility_type.required' => 'نوع المنشأة مطلوب',
            'facility_type.in' => 'نوع المنشأة المحدد غير صحيح',
            
            'safety_status.required' => 'حالة السلامة مطلوبة',
            'safety_status.in' => 'حالة السلامة المحددة غير صحيحة',
            
            'inspection_status.required' => 'حالة التفتيش مطلوبة',
            'inspection_status.in' => 'حالة التفتيش المحددة غير صحيحة',
            
            'last_inspection_date.date' => 'تاريخ آخر تفتيش يجب أن يكون تاريخاً صحيحاً',
            'last_inspection_date.before_or_equal' => 'تاريخ آخر تفتيش يجب ألا يكون في المستقبل',
            
            'next_inspection_date.date' => 'تاريخ التفتيش القادم يجب أن يكون تاريخاً صحيحاً',
            'next_inspection_date.after' => 'تاريخ التفتيش القادم يجب أن يكون بعد آخر تفتيش',
            
            'certificate_file.file' => 'يجب أن يكون الملف المرفوع صحيحاً',
            'certificate_file.mimes' => 'يجب أن يكون الملف من نوع: PDF, JPG, JPEG, PNG',
            'certificate_file.max' => 'حجم الملف يجب ألا يزيد عن 10 ميجابايت',
            
            'status.in' => 'حالة الترخيص المحددة غير صحيحة',

            'enable_reminder.boolean' => 'تفعيل التذكير يجب أن يكون صحيح أو خطأ',
            'reminder_days.integer' => 'أيام التذكير يجب أن تكون رقماً صحيحاً',
            'reminder_days.min' => 'أيام التذكير يجب أن تكون على الأقل 1',
            'reminder_days.max' => 'أيام التذكير يجب ألا تزيد عن 365'
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'license_number' => 'رقم الترخيص',
            'authority' => 'الجهة المصدرة',
            'activity_classification' => 'تصنيف النشاط',
            'issue_date' => 'تاريخ الإصدار',
            'expiry_date' => 'تاريخ الانتهاء',
            'total_area' => 'المساحة الإجمالية',
            'floors' => 'عدد الطوابق',
            'facility_type' => 'نوع المنشأة',
            'safety_status' => 'حالة السلامة',
            'inspection_status' => 'حالة التفتيش',
            'last_inspection_date' => 'تاريخ آخر تفتيش',
            'next_inspection_date' => 'تاريخ التفتيش القادم',
            'certificate_file' => 'ملف الشهادة',
            'notes' => 'الملاحظات',
            'enable_reminder' => 'تفعيل التذكير',
            'reminder_days' => 'أيام التذكير'
        ];
    }
}

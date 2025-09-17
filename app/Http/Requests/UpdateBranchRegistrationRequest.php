<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBranchRegistrationRequest extends FormRequest
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
            // Basic Registration Information
            'branch_reg_number' => 'required|string|max:255',
            'parent_cr_number' => 'required|string|max:255',
            'branch_type' => 'required|in:main_branch,sub_branch,regional_office,representative_office,sales_office,warehouse,other',
            'legal_form' => 'required|in:LLC,JSC,Partnership,Sole_Proprietorship,Branch_Office,Representative_Office',
            'registration_date' => 'required|date',
            'authorized_capital' => 'required|numeric|min:0',

            // Dates
            'issue_date' => 'nullable|date',
            'expiry_date' => 'nullable|date|after:issue_date',

            // Authority Information
            'issuing_authority' => 'nullable|string|max:255',

            // Manager Information
            'manager_name' => 'required|string|max:255',
            'manager_id_number' => 'required|string|max:255',
            'manager_nationality' => 'required|string|max:255',
            'manager_position' => 'required|string|max:255',

            // Activity Information
            'branch_activity' => 'required|string|max:2000',
            'activities_list' => 'nullable|string|max:3000',

            // Additional Information
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
            'branch_reg_number.required' => 'رقم تسجيل الفرع مطلوب',
            'branch_reg_number.max' => 'رقم تسجيل الفرع يجب ألا يزيد عن 255 حرف',

            'parent_cr_number.required' => 'رقم السجل التجاري للمنشأة الأم مطلوب',
            'parent_cr_number.max' => 'رقم السجل التجاري للمنشأة الأم يجب ألا يزيد عن 255 حرف',

            'branch_type.required' => 'نوع الفرع مطلوب',
            'branch_type.in' => 'نوع الفرع المحدد غير صحيح',

            'legal_form.required' => 'الشكل القانوني مطلوب',
            'legal_form.in' => 'الشكل القانوني المحدد غير صحيح',

            'registration_date.required' => 'تاريخ التسجيل مطلوب',
            'registration_date.date' => 'تاريخ التسجيل يجب أن يكون تاريخاً صحيحاً',

            'authorized_capital.required' => 'رأس المال المصرح مطلوب',
            'authorized_capital.numeric' => 'رأس المال المصرح يجب أن يكون رقماً',
            'authorized_capital.min' => 'رأس المال المصرح يجب أن يكون أكبر من أو يساوي صفر',

            'issue_date.date' => 'تاريخ الإصدار يجب أن يكون تاريخاً صحيحاً',

            'expiry_date.date' => 'تاريخ الانتهاء يجب أن يكون تاريخاً صحيحاً',
            'expiry_date.after' => 'تاريخ الانتهاء يجب أن يكون بعد تاريخ الإصدار',

            'issuing_authority.max' => 'الجهة المصدرة يجب ألا تزيد عن 255 حرف',

            'manager_name.required' => 'اسم المدير مطلوب',
            'manager_name.max' => 'اسم المدير يجب ألا يزيد عن 255 حرف',

            'manager_id_number.required' => 'رقم هوية المدير مطلوب',
            'manager_id_number.max' => 'رقم هوية المدير يجب ألا يزيد عن 255 حرف',

            'manager_nationality.required' => 'جنسية المدير مطلوبة',
            'manager_nationality.max' => 'جنسية المدير يجب ألا تزيد عن 255 حرف',

            'manager_position.required' => 'منصب المدير مطلوب',
            'manager_position.max' => 'منصب المدير يجب ألا يزيد عن 255 حرف',

            'branch_activity.required' => 'نشاط الفرع مطلوب',
            'branch_activity.max' => 'نشاط الفرع يجب ألا يزيد عن 2000 حرف',

            'activities_list.max' => 'قائمة الأنشطة يجب ألا تزيد عن 3000 حرف',

            'notes.max' => 'الملاحظات يجب ألا تزيد عن 2000 حرف',

            'certificate_file.file' => 'يجب أن يكون الملف المرفوع صحيحاً',
            'certificate_file.mimes' => 'يجب أن يكون الملف من نوع: PDF, JPG, JPEG, PNG',
            'certificate_file.max' => 'حجم الملف يجب ألا يزيد عن 10 ميجابايت',

            'status.in' => 'حالة التسجيل المحددة غير صحيحة',

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
            'branch_reg_number' => 'رقم تسجيل الفرع',
            'parent_cr_number' => 'رقم السجل التجاري للمنشأة الأم',
            'branch_type' => 'نوع الفرع',
            'legal_form' => 'الشكل القانوني',
            'registration_date' => 'تاريخ التسجيل',
            'authorized_capital' => 'رأس المال المصرح',
            'issue_date' => 'تاريخ الإصدار',
            'expiry_date' => 'تاريخ الانتهاء',
            'issuing_authority' => 'الجهة المصدرة',
            'manager_name' => 'اسم المدير',
            'manager_id_number' => 'رقم هوية المدير',
            'manager_nationality' => 'جنسية المدير',
            'manager_position' => 'منصب المدير',
            'branch_activity' => 'نشاط الفرع',
            'activities_list' => 'قائمة الأنشطة',
            'certificate_file' => 'ملف الشهادة',
            'notes' => 'الملاحظات',
            'enable_reminder' => 'تفعيل التذكير',
            'reminder_days' => 'أيام التذكير'
        ];
    }
}

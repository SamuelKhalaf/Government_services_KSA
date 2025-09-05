<?php

namespace App\Http\Requests;

use App\Models\DocumentType;
use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeDocumentRequest extends FormRequest
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
        $rules = [
            // Basic Document Information
            'document_type_id' => 'required|exists:document_types,id',
            'document_number' => 'nullable|string|max:255',
            'issue_date' => 'nullable|date',
            'issuing_authority' => 'nullable|string|max:255',
            'place_of_issue' => 'nullable|string|max:255',
            
            // Visa specific fields
            'visa_type' => 'nullable|string|max:255',
            'sponsor_name' => 'nullable|string|max:255',
            'sponsor_id' => 'nullable|string|max:255',
            'visa_purpose' => 'nullable|string|max:255',
            'duration_days' => 'nullable|integer|min:1',
            
            // Exit/Re-entry specific fields
            'travel_type' => 'nullable|in:single,multiple',
            'travel_date' => 'nullable|date',
            'return_date' => 'nullable|date|after:travel_date',
            'destination_country' => 'nullable|string|max:255',
            
            // Financial Information
            'fees_paid' => 'nullable|numeric|min:0',
            'payment_method' => 'nullable|string|max:255',
            'receipt_number' => 'nullable|string|max:255',
            
            // Status Information
            'status' => 'nullable|in:active,expired,cancelled,pending,under_process',
            'document_status' => 'nullable|in:original,copy,certified_copy',
            
            // Additional Information
            'notes' => 'nullable|string',
            'renewal_notes' => 'nullable|string',
            'reminder_date' => 'nullable|date',
            'auto_reminder' => 'nullable|boolean'
        ];

        // Get document type to apply dynamic validation
        $documentTypeId = $this->input('document_type_id');
        if ($documentTypeId) {
            $documentType = DocumentType::find($documentTypeId);
            
            if ($documentType) {
                // Apply expiry date validation if required
                if ($documentType->requires_expiry_date) {
                    $rules['expiry_date'] = 'required|date|after:today';
                } else {
                    $rules['expiry_date'] = 'nullable|date|after:today';
                }
                
                // Apply file upload validation if required
                if ($documentType->requires_file_upload) {
                    $rules['document_file'] = 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240'; // 10MB max
                } else {
                    $rules['document_file'] = 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240';
                }
                
                // Apply custom field validation based on required_fields
                if ($documentType->required_fields && is_array($documentType->required_fields)) {
                    foreach ($documentType->required_fields as $field) {
                        if (!isset($rules[$field])) {
                            $rules[$field] = 'required|string|max:255';
                        }
                    }
                }
            }
        } else {
            // Default validation if no document type selected
            $rules['expiry_date'] = 'nullable|date|after:today';
            $rules['document_file'] = 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240';
        }

        return $rules;
    }

    /**
     * Get custom error messages for validation rules.
     */
    public function messages(): array
    {
        $messages = [
            'document_type_id.required' => 'نوع الوثيقة مطلوب',
            'document_type_id.exists' => 'نوع الوثيقة غير موجود',
            'expiry_date.required' => 'تاريخ انتهاء الصلاحية مطلوب لهذا النوع من الوثائق',
            'expiry_date.after' => 'تاريخ انتهاء الصلاحية يجب أن يكون في المستقبل',
            'return_date.after' => 'تاريخ العودة يجب أن يكون بعد تاريخ السفر',
            'fees_paid.numeric' => 'الرسوم يجب أن تكون رقماً',
            'fees_paid.min' => 'الرسوم يجب أن تكون أكبر من أو تساوي صفر',
            'document_file.file' => 'يجب أن يكون المرفق ملفاً',
            'document_file.mimes' => 'يجب أن يكون الملف من نوع: PDF, JPG, JPEG, PNG',
            'document_file.max' => 'حجم الملف يجب ألا يتجاوز 10 ميجابايت'
        ];

        // Get document type to apply dynamic error messages
        $documentTypeId = $this->input('document_type_id');
        if ($documentTypeId) {
            $documentType = DocumentType::find($documentTypeId);
            
            if ($documentType && $documentType->required_fields && is_array($documentType->required_fields)) {
                foreach ($documentType->required_fields as $field) {
                    $fieldName = $this->getFieldDisplayName($field);
                    $messages[$field . '.required'] = "حقل {$fieldName} مطلوب لهذا النوع من الوثائق";
                }
            }
        }

        return $messages;
    }

    /**
     * Get custom validation attributes.
     */
    public function attributes(): array
    {
        $attributes = [
            'document_type_id' => 'نوع الوثيقة',
            'document_number' => 'رقم الوثيقة',
            'issue_date' => 'تاريخ الإصدار',
            'expiry_date' => 'تاريخ انتهاء الصلاحية',
            'issuing_authority' => 'جهة الإصدار',
            'place_of_issue' => 'مكان الإصدار',
            'document_file' => 'ملف الوثيقة'
        ];

        // Get document type to apply dynamic attributes
        $documentTypeId = $this->input('document_type_id');
        if ($documentTypeId) {
            $documentType = DocumentType::find($documentTypeId);
            
            if ($documentType && $documentType->required_fields && is_array($documentType->required_fields)) {
                foreach ($documentType->required_fields as $field) {
                    $attributes[$field] = $this->getFieldDisplayName($field);
                }
            }
        }

        return $attributes;
    }

    /**
     * Get display name for custom fields
     */
    private function getFieldDisplayName(string $field): string
    {
        $fieldNames = [
            'visa_type' => 'نوع التأشيرة',
            'sponsor_name' => 'اسم الكفيل',
            'sponsor_id' => 'رقم الكفيل',
            'visa_purpose' => 'غرض التأشيرة',
            'duration_days' => 'مدة التأشيرة',
            'travel_type' => 'نوع السفر',
            'travel_date' => 'تاريخ السفر',
            'return_date' => 'تاريخ العودة',
            'destination_country' => 'بلد الوجهة',
            'fees_paid' => 'الرسوم المدفوعة',
            'payment_method' => 'طريقة الدفع',
            'receipt_number' => 'رقم الإيصال'
        ];

        return $fieldNames[$field] ?? $field;
    }
}

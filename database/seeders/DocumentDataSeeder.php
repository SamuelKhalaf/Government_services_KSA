<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocumentDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Seeding Document Types and Documents...');

        // Seed document types
        $this->seedDocumentTypes();
        
        // Seed company documents
        $this->seedCompanyDocuments();
        
        // Seed employee documents
        $this->seedEmployeeDocuments();

        $this->command->info('Document Types and Documents seeded successfully!');
    }

    private function seedDocumentTypes()
    {
        $documentTypes = [
            [
                'id' => 9, 'name_en' => 'National ID', 'name_ar' => 'الهوية الوطنية', 'code' => 'NAT_ID',
                'category' => 'employee', 'entity_type' => 'saudi', 'reminder_days_before' => 90,
                'custom_fields' => '{"issue_date": {"key": "issue_date", "type": "date", "name_ar": "تاريخ الإصدار", "name_en": "Issue Date", "required": true, "placeholder_ar": "اختر تاريخ الإصدار", "placeholder_en": "Select issue date"}, "expiry_date": {"key": "expiry_date", "type": "date", "name_ar": "تاريخ الانتهاء", "name_en": "Expiry Date", "required": true, "placeholder_ar": "اختر تاريخ الانتهاء", "placeholder_en": "Select expiry date"}, "document_file": {"key": "document_file", "type": "file", "name_ar": "ملف الوثيقة", "name_en": "Document File", "required": false, "placeholder_ar": "رفع ملف الوثيقة", "placeholder_en": "Upload document file"}, "place_of_issue": {"key": "place_of_issue", "type": "text", "name_ar": "مكان الإصدار", "name_en": "Place of Issue", "required": false, "placeholder_ar": "أدخل مكان الإصدار", "placeholder_en": "Enter place of issue"}, "document_number": {"key": "document_number", "type": "text", "name_ar": "رقم الوثيقة", "name_en": "Document Number", "required": true, "placeholder_ar": "أدخل رقم الوثيقة", "placeholder_en": "Enter document number"}}',
                'description_ar' => 'الهوية الوطنية للمواطنين السعوديين', 'description_en' => 'National Identity Card for Saudi Citizens',
                'is_active' => 1, 'created_at' => '2025-08-29 13:55:28', 'updated_at' => '2025-09-05 20:11:40'
            ],
            [
                'id' => 10, 'name_en' => 'Iqama (Residence Permit)', 'name_ar' => 'الإقامة', 'code' => 'IQAMA',
                'category' => 'employee', 'entity_type' => 'expat', 'reminder_days_before' => 60,
                'custom_fields' => '{"issue_date": {"key": "issue_date", "type": "date", "name_ar": "تاريخ الإصدار", "name_en": "Issue Date", "required": true, "placeholder_ar": "اختر تاريخ الإصدار", "placeholder_en": "Select issue date"}, "expiry_date": {"key": "expiry_date", "type": "date", "name_ar": "تاريخ الانتهاء", "name_en": "Expiry Date", "required": true, "placeholder_ar": "اختر تاريخ الانتهاء", "placeholder_en": "Select expiry date"}, "document_file": {"key": "document_file", "type": "file", "name_ar": "ملف الوثيقة", "name_en": "Document File", "required": false, "placeholder_ar": "رفع ملف الوثيقة", "placeholder_en": "Upload document file"}, "place_of_issue": {"key": "place_of_issue", "type": "text", "name_ar": "مكان الإصدار", "name_en": "Place of Issue", "required": false, "placeholder_ar": "أدخل مكان الإصدار", "placeholder_en": "Enter place of issue"}, "document_number": {"key": "document_number", "type": "text", "name_ar": "رقم الوثيقة", "name_en": "Document Number", "required": true, "placeholder_ar": "أدخل رقم الوثيقة", "placeholder_en": "Enter document number"}}',
                'description_ar' => 'إقامة للوافدين المقيمين', 'description_en' => 'Residence Permit for Expatriate Workers',
                'is_active' => 1, 'created_at' => '2025-08-29 13:55:28', 'updated_at' => '2025-09-05 20:11:29'
            ],
            [
                'id' => 11, 'name_en' => 'Passport', 'name_ar' => 'جواز السفر', 'code' => 'PASSPORT',
                'category' => 'employee', 'entity_type' => 'expat', 'reminder_days_before' => 180,
                'custom_fields' => '{"0": {"key": "number_passportnumber_u6gc", "type": "number", "name_ar": "رقم الجواز", "name_en": "passport_number", "options": {"value": [null], "label_ar": [null], "label_en": [null]}, "placeholder_ar": null, "placeholder_en": null}, "issue_date": {"key": "issue_date", "type": "date", "name_ar": "تاريخ الإصدار", "name_en": "Issue Date", "required": true, "placeholder_ar": "اختر تاريخ الإصدار", "placeholder_en": "Select issue date"}, "expiry_date": {"key": "expiry_date", "type": "date", "name_ar": "تاريخ الانتهاء", "name_en": "Expiry Date", "required": true, "placeholder_ar": "اختر تاريخ الانتهاء", "placeholder_en": "Select expiry date"}, "document_file": {"key": "document_file", "type": "file", "name_ar": "ملف الوثيقة", "name_en": "Document File", "required": false, "placeholder_ar": "رفع ملف الوثيقة", "placeholder_en": "Upload document file"}, "document_number": {"key": "document_number", "type": "text", "name_ar": "رقم الوثيقة", "name_en": "Document Number", "required": true, "placeholder_ar": "أدخل رقم الوثيقة", "placeholder_en": "Enter document number"}}',
                'description_ar' => 'جواز سفر للموظفين الوافدين', 'description_en' => 'Passport for Expatriate Employees',
                'is_active' => 1, 'created_at' => '2025-08-29 13:55:28', 'updated_at' => '2025-09-06 01:23:42'
            ],
            [
                'id' => 12, 'name_en' => 'Visa', 'name_ar' => 'التأشيرة', 'code' => 'VISA',
                'category' => 'employee', 'entity_type' => 'expat', 'reminder_days_before' => 30,
                'custom_fields' => '{"notes": {"key": "notes", "type": "textarea", "name_ar": "ملاحظات", "name_en": "Notes", "required": false, "placeholder_ar": "أدخل الملاحظات", "placeholder_en": "Enter notes"}, "issue_date": {"key": "issue_date", "type": "date", "name_ar": "تاريخ الإصدار", "name_en": "Issue Date", "required": true, "placeholder_ar": "اختر تاريخ الإصدار", "placeholder_en": "Select issue date"}, "expiry_date": {"key": "expiry_date", "type": "date", "name_ar": "تاريخ الانتهاء", "name_en": "Expiry Date", "required": true, "placeholder_ar": "اختر تاريخ الانتهاء", "placeholder_en": "Select expiry date"}, "document_file": {"key": "document_file", "type": "file", "name_ar": "ملف الوثيقة", "name_en": "Document File", "required": false, "placeholder_ar": "رفع ملف الوثيقة", "placeholder_en": "Upload document file"}, "renewal_notes": {"key": "renewal_notes", "type": "textarea", "name_ar": "ملاحظات التجديد", "name_en": "Renewal Notes", "required": false, "placeholder_ar": "أدخل ملاحظات التجديد", "placeholder_en": "Enter renewal notes"}, "place_of_issue": {"key": "place_of_issue", "type": "text", "name_ar": "مكان الإصدار", "name_en": "Place of Issue", "required": false, "placeholder_ar": "أدخل مكان الإصدار", "placeholder_en": "Enter place of issue"}, "document_number": {"key": "document_number", "type": "text", "name_ar": "رقم الوثيقة", "name_en": "Document Number", "required": true, "placeholder_ar": "أدخل رقم الوثيقة", "placeholder_en": "Enter document number"}}',
                'description_ar' => 'تأشيرة دخول للموظفين الوافدين', 'description_en' => 'Entry Visa for Expatriate Employees',
                'is_active' => 1, 'created_at' => '2025-08-29 13:55:28', 'updated_at' => '2025-09-05 20:12:29'
            ],
            [
                'id' => 13, 'name_en' => 'Exit/Re-entry Permit', 'name_ar' => 'تأشيرة خروج وعودة', 'code' => 'EXIT_REENTRY',
                'category' => 'employee', 'entity_type' => 'expat', 'reminder_days_before' => 15,
                'custom_fields' => '{"notes": {"key": "notes", "type": "textarea", "name_ar": "ملاحظات", "name_en": "Notes", "required": false, "placeholder_ar": "أدخل الملاحظات", "placeholder_en": "Enter notes"}, "issue_date": {"key": "issue_date", "type": "date", "name_ar": "تاريخ الإصدار", "name_en": "Issue Date", "required": true, "placeholder_ar": "اختر تاريخ الإصدار", "placeholder_en": "Select issue date"}, "expiry_date": {"key": "expiry_date", "type": "date", "name_ar": "تاريخ الانتهاء", "name_en": "Expiry Date", "required": true, "placeholder_ar": "اختر تاريخ الانتهاء", "placeholder_en": "Select expiry date"}, "document_file": {"key": "document_file", "type": "file", "name_ar": "ملف الوثيقة", "name_en": "Document File", "required": false, "placeholder_ar": "رفع ملف الوثيقة", "placeholder_en": "Upload document file"}, "renewal_notes": {"key": "renewal_notes", "type": "textarea", "name_ar": "ملاحظات التجديد", "name_en": "Renewal Notes", "required": false, "placeholder_ar": "أدخل ملاحظات التجديد", "placeholder_en": "Enter renewal notes"}, "place_of_issue": {"key": "place_of_issue", "type": "text", "name_ar": "مكان الإصدار", "name_en": "Place of Issue", "required": false, "placeholder_ar": "أدخل مكان الإصدار", "placeholder_en": "Enter place of issue"}, "document_number": {"key": "document_number", "type": "text", "name_ar": "رقم الوثيقة", "name_en": "Document Number", "required": true, "placeholder_ar": "أدخل رقم الوثيقة", "placeholder_en": "Enter document number"}}',
                'description_ar' => 'تأشيرة خروج وعودة للموظفين الوافدين', 'description_en' => 'Exit and Re-entry Permit for Expatriate Employees',
                'is_active' => 1, 'created_at' => '2025-08-29 13:55:28', 'updated_at' => '2025-09-05 19:44:32'
            ],
            [
                'id' => 14, 'name_en' => 'Work Contract', 'name_ar' => 'عقد العمل', 'code' => 'WORK_CONTRACT',
                'category' => 'employee', 'entity_type' => 'both', 'reminder_days_before' => 90,
                'custom_fields' => '{"issue_date": {"key": "issue_date", "type": "date", "name_ar": "تاريخ الإصدار", "name_en": "Issue Date", "required": true, "placeholder_ar": "اختر تاريخ الإصدار", "placeholder_en": "Select issue date"}, "expiry_date": {"key": "expiry_date", "type": "date", "name_ar": "تاريخ الانتهاء", "name_en": "Expiry Date", "required": true, "placeholder_ar": "اختر تاريخ الانتهاء", "placeholder_en": "Select expiry date"}, "document_file": {"key": "document_file", "type": "file", "name_ar": "ملف الوثيقة", "name_en": "Document File", "required": false, "placeholder_ar": "رفع ملف الوثيقة", "placeholder_en": "Upload document file"}, "place_of_issue": {"key": "place_of_issue", "type": "text", "name_ar": "مكان الإصدار", "name_en": "Place of Issue", "required": false, "placeholder_ar": "أدخل مكان الإصدار", "placeholder_en": "Enter place of issue"}, "document_number": {"key": "document_number", "type": "text", "name_ar": "رقم الوثيقة", "name_en": "Document Number", "required": true, "placeholder_ar": "أدخل رقم الوثيقة", "placeholder_en": "Enter document number"}}',
                'description_ar' => 'عقد العمل للموظفين', 'description_en' => 'Employment Contract for Employees',
                'is_active' => 1, 'created_at' => '2025-08-29 13:55:28', 'updated_at' => '2025-09-05 20:12:39'
            ],
            [
                'id' => 15, 'name_en' => 'Health Insurance', 'name_ar' => 'التأمين الصحي', 'code' => 'HEALTH_INSURANCE',
                'category' => 'employee', 'entity_type' => 'both', 'reminder_days_before' => 30,
                'custom_fields' => '{"issue_date": {"key": "issue_date", "type": "date", "name_ar": "تاريخ الإصدار", "name_en": "Issue Date", "required": true, "placeholder_ar": "اختر تاريخ الإصدار", "placeholder_en": "Select issue date"}, "expiry_date": {"key": "expiry_date", "type": "date", "name_ar": "تاريخ الانتهاء", "name_en": "Expiry Date", "required": true, "placeholder_ar": "اختر تاريخ الانتهاء", "placeholder_en": "Select expiry date"}, "document_file": {"key": "document_file", "type": "file", "name_ar": "ملف الوثيقة", "name_en": "Document File", "required": false, "placeholder_ar": "رفع ملف الوثيقة", "placeholder_en": "Upload document file"}, "renewal_notes": {"key": "renewal_notes", "type": "textarea", "name_ar": "ملاحظات التجديد", "name_en": "Renewal Notes", "required": false, "placeholder_ar": "أدخل ملاحظات التجديد", "placeholder_en": "Enter renewal notes"}, "place_of_issue": {"key": "place_of_issue", "type": "text", "name_ar": "مكان الإصدار", "name_en": "Place of Issue", "required": false, "placeholder_ar": "أدخل مكان الإصدار", "placeholder_en": "Enter place of issue"}, "document_number": {"key": "document_number", "type": "text", "name_ar": "رقم الوثيقة", "name_en": "Document Number", "required": true, "placeholder_ar": "أدخل رقم الوثيقة", "placeholder_en": "Enter document number"}}',
                'description_ar' => 'بوليصة التأمين الصحي', 'description_en' => 'Health Insurance Policy',
                'is_active' => 1, 'created_at' => '2025-08-29 13:55:28', 'updated_at' => '2025-09-05 21:35:14'
            ],
            [
                'id' => 19, 'name_en' => 'VAT Registration', 'name_ar' => 'شهادة التسجيل في ضريبة القيمة المضافة', 'code' => 'VAT_REG',
                'category' => 'company', 'entity_type' => 'both', 'reminder_days_before' => 20,
                'custom_fields' => '{"issue_date": {"key": "issue_date", "type": "date", "name_ar": "تاريخ الإصدار", "name_en": "Issue Date", "required": true, "placeholder_ar": "اختر تاريخ الإصدار", "placeholder_en": "Select issue date"}, "expiry_date": {"key": "expiry_date", "type": "date", "name_ar": "تاريخ الانتهاء", "name_en": "Expiry Date", "required": true, "placeholder_ar": "اختر تاريخ الانتهاء", "placeholder_en": "Select expiry date"}, "document_file": {"key": "document_file", "type": "file", "name_ar": "ملف الوثيقة", "name_en": "Document File", "required": false, "placeholder_ar": "رفع ملف الوثيقة", "placeholder_en": "Upload document file"}, "document_number": {"key": "document_number", "type": "text", "name_ar": "رقم الوثيقة", "name_en": "Document Number", "required": true, "placeholder_ar": "أدخل رقم الوثيقة", "placeholder_en": "Enter document number"}}',
                'description_ar' => 'شهادة التسجيل في ضريبة القيمة المضافة', 'description_en' => 'VAT Registration Certificate',
                'is_active' => 1, 'created_at' => '2025-08-29 13:55:28', 'updated_at' => '2025-09-05 23:49:15'
            ],
            [
                'id' => 20, 'name_en' => 'GOSI Registration', 'name_ar' => 'شهادة التسجيل في التأمينات الاجتماعية', 'code' => 'GOSI_REG',
                'category' => 'company', 'entity_type' => 'both', 'reminder_days_before' => 10,
                'custom_fields' => '{"issue_date": {"key": "issue_date", "type": "date", "name_ar": "تاريخ الإصدار", "name_en": "Issue Date", "required": true, "placeholder_ar": "اختر تاريخ الإصدار", "placeholder_en": "Select issue date"}, "expiry_date": {"key": "expiry_date", "type": "date", "name_ar": "تاريخ الانتهاء", "name_en": "Expiry Date", "required": true, "placeholder_ar": "اختر تاريخ الانتهاء", "placeholder_en": "Select expiry date"}, "document_file": {"key": "document_file", "type": "file", "name_ar": "ملف الوثيقة", "name_en": "Document File", "required": false, "placeholder_ar": "رفع ملف الوثيقة", "placeholder_en": "Upload document file"}, "renewal_notes": {"key": "renewal_notes", "type": "textarea", "name_ar": "ملاحظات التجديد", "name_en": "Renewal Notes", "required": false, "placeholder_ar": "أدخل ملاحظات التجديد", "placeholder_en": "Enter renewal notes"}, "place_of_issue": {"key": "place_of_issue", "type": "text", "name_ar": "مكان الإصدار", "name_en": "Place of Issue", "required": false, "placeholder_ar": "أدخل مكان الإصدار", "placeholder_en": "Enter place of issue"}, "document_number": {"key": "document_number", "type": "text", "name_ar": "رقم الوثيقة", "name_en": "Document Number", "required": true, "placeholder_ar": "أدخل رقم الوثيقة", "placeholder_en": "Enter document number"}}',
                'description_ar' => 'شهادة التسجيل في المؤسسة العامة للتأمينات الاجتماعية', 'description_en' => 'General Organization for Social Insurance Registration',
                'is_active' => 1, 'created_at' => '2025-08-29 13:55:28', 'updated_at' => '2025-09-05 23:48:56'
            ],
            [
                'id' => 24, 'name_en' => 'Commercial Registration', 'name_ar' => 'سجل تجاري', 'code' => 'COMP_COMMERCIAL_REGISTRAT_0964',
                'category' => 'company', 'entity_type' => 'both', 'reminder_days_before' => 30,
                'custom_fields' => '{"0": {"key": "number_passportnumber_ajz0", "type": "number", "name_ar": "رقم الجواز", "name_en": "passport_number", "options": {"value": [null], "label_ar": [null], "label_en": [null]}, "placeholder_ar": null, "placeholder_en": null}, "notes": {"key": "notes", "type": "textarea", "name_ar": "ملاحظات", "name_en": "Notes", "required": false, "placeholder_ar": "أدخل الملاحظات", "placeholder_en": "Enter notes"}, "issue_date": {"key": "issue_date", "type": "date", "name_ar": "تاريخ الإصدار", "name_en": "Issue Date", "required": true, "placeholder_ar": "اختر تاريخ الإصدار", "placeholder_en": "Select issue date"}, "expiry_date": {"key": "expiry_date", "type": "date", "name_ar": "تاريخ الانتهاء", "name_en": "Expiry Date", "required": true, "placeholder_ar": "اختر تاريخ الانتهاء", "placeholder_en": "Select expiry date"}, "document_file": {"key": "document_file", "type": "file", "name_ar": "ملف الوثيقة", "name_en": "Document File", "required": false, "placeholder_ar": "رفع ملف الوثيقة", "placeholder_en": "Upload document file"}, "renewal_notes": {"key": "renewal_notes", "type": "textarea", "name_ar": "ملاحظات التجديد", "name_en": "Renewal Notes", "required": false, "placeholder_ar": "أدخل ملاحظات التجديد", "placeholder_en": "Enter renewal notes"}, "place_of_issue": {"key": "place_of_issue", "type": "text", "name_ar": "مكان الإصدار", "name_en": "Place of Issue", "required": false, "placeholder_ar": "أدخل مكان الإصدار", "placeholder_en": "Enter place of issue"}, "document_number": {"key": "document_number", "type": "text", "name_ar": "رقم الوثيقة", "name_en": "Document Number", "required": true, "placeholder_ar": "أدخل رقم الوثيقة", "placeholder_en": "Enter document number"}}',
                'description_ar' => 'Suscipit quam sed ex', 'description_en' => 'Doloremque unde quid',
                'is_active' => 1, 'created_at' => '2025-09-06 01:23:01', 'updated_at' => '2025-09-06 01:23:01'
            ],
        ];

        foreach ($documentTypes as $documentType) {
            DB::table('document_types')->updateOrInsert(
                ['id' => $documentType['id']],
                $documentType
            );
        }
    }

    private function seedCompanyDocuments()
    {
        $companyDocuments = [
            [
                'id' => 1, 'company_id' => 1, 'document_type_id' => 20, 'status' => 'active', 'enable_reminder' => 1,
                'reminder_days' => 10, 'custom_fields' => '{"issue_date": "2025-08-31", "expiry_date": "2025-09-19", "document_file": {"file_path": "company-documents/1757126541_file.pdf", "file_size": 1032205, "file_type": "application/pdf", "original_filename": "file.pdf"}, "document_number": "1243234534"}',
                'created_at' => '2025-09-05 23:42:21', 'updated_at' => '2025-09-05 23:42:21'
            ],
            [
                'id' => 2, 'company_id' => 4, 'document_type_id' => 19, 'status' => 'active', 'enable_reminder' => 1,
                'reminder_days' => 20, 'custom_fields' => '{"issue_date": "2025-09-01", "expiry_date": "2025-09-17", "document_file": {"file_path": "company-documents/1757131880_laravel.jpg", "file_size": 62515, "file_type": "image/jpeg", "original_filename": "laravel.jpg"}, "document_number": "21342134"}',
                'created_at' => '2025-09-05 23:58:28', 'updated_at' => '2025-09-06 01:11:20'
            ],
            [
                'id' => 3, 'company_id' => 4, 'document_type_id' => 19, 'status' => 'active', 'enable_reminder' => 1,
                'reminder_days' => 20, 'custom_fields' => '{"issue_date": "2025-08-31", "expiry_date": "2025-09-04", "document_number": "21342134"}',
                'created_at' => '2025-09-06 00:35:38', 'updated_at' => '2025-09-06 00:36:48'
            ],
            [
                'id' => 4, 'company_id' => 2, 'document_type_id' => 24, 'status' => 'active', 'enable_reminder' => 1,
                'reminder_days' => 30, 'custom_fields' => '{"issue_date": "2025-09-17", "expiry_date": "2025-09-17", "document_file": {"file_path": "company-documents/1758061265_3910.jpg", "file_size": 722264, "file_type": "image/jpeg", "original_filename": "3910.jpg"}, "document_number": "213421343245"}',
                'created_at' => '2025-09-16 19:10:12', 'updated_at' => '2025-09-16 19:21:05'
            ],
        ];

        foreach ($companyDocuments as $companyDocument) {
            DB::table('company_documents')->updateOrInsert(
                ['id' => $companyDocument['id']],
                $companyDocument
            );
        }
    }

    private function seedEmployeeDocuments()
    {
        $employeeDocuments = [
            [
                'id' => 1, 'employee_id' => 1, 'document_type_id' => 15, 'status' => 'pending', 'enable_reminder' => 1,
                'reminder_days' => 25, 'custom_fields' => '{"issue_date": "2024-02-06", "expiry_date": "2023-02-06", "document_file": {"file_path": "employee_documents/1/1757118451_laravel.jpg", "file_size": 62515, "file_type": "jpg", "original_filename": "laravel.jpg"}, "document_number": "123412324"}',
                'created_at' => '2025-09-05 20:54:29', 'updated_at' => '2025-09-05 21:50:59'
            ],
            [
                'id' => 2, 'employee_id' => 1, 'document_type_id' => 9, 'status' => 'active', 'enable_reminder' => 1,
                'reminder_days' => 90, 'custom_fields' => '{"issue_date": "2024-02-06", "expiry_date": "2025-09-19", "document_file": {"file_path": "employee_documents/1/1757118993_images.png", "file_size": 4225, "file_type": "png", "original_filename": "images.png"}, "document_number": "213412324124"}',
                'created_at' => '2025-09-05 21:36:33', 'updated_at' => '2025-09-05 21:36:33'
            ],
        ];

        foreach ($employeeDocuments as $employeeDocument) {
            DB::table('employee_documents')->updateOrInsert(
                ['id' => $employeeDocument['id']],
                $employeeDocument
            );
        }
    }
}

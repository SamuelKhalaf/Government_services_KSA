<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocumentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Seeding document types...');

        // Clear existing document types
        DB::table('document_types')->delete();

        // Employee Document Types
        $employeeDocuments = [
            // Saudi Employee Documents
            [
                'name_en' => 'National ID',
                'name_ar' => 'الهوية الوطنية',
                'code' => 'NAT_ID',
                'category' => 'employee',
                'entity_type' => 'saudi',
                'requires_expiry_date' => true,
                'requires_file_upload' => true,
                'has_auto_reminder' => true,
                'reminder_days_before' => 90,
                'required_fields' => json_encode(['issue_date', 'issue_place']),
                'optional_fields' => json_encode(['notes']),
                'icon' => 'fas fa-id-card',
                'color' => '#28a745',
                'description_ar' => 'الهوية الوطنية للمواطنين السعوديين',
                'description_en' => 'National Identity Card for Saudi Citizens',
                'sort_order' => 1,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            // Expat Employee Documents
            [
                'name_en' => 'Iqama (Residence Permit)',
                'name_ar' => 'الإقامة',
                'code' => 'IQAMA',
                'category' => 'employee',
                'entity_type' => 'expat',
                'requires_expiry_date' => true,
                'requires_file_upload' => true,
                'has_auto_reminder' => true,
                'reminder_days_before' => 60,
                'required_fields' => json_encode(['issue_date', 'border_number']),
                'optional_fields' => json_encode(['profession', 'sponsor']),
                'icon' => 'fas fa-passport',
                'color' => '#007bff',
                'description_ar' => 'إقامة للوافدين المقيمين',
                'description_en' => 'Residence Permit for Expatriate Workers',
                'sort_order' => 2,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name_en' => 'Passport',
                'name_ar' => 'جواز السفر',
                'code' => 'PASSPORT',
                'category' => 'employee',
                'entity_type' => 'expat',
                'requires_expiry_date' => true,
                'requires_file_upload' => true,
                'has_auto_reminder' => true,
                'reminder_days_before' => 180,
                'required_fields' => json_encode(['issue_date', 'issue_place', 'passport_number']),
                'optional_fields' => json_encode(['nationality']),
                'icon' => 'fas fa-passport',
                'color' => '#6f42c1',
                'description_ar' => 'جواز سفر للموظفين الوافدين',
                'description_en' => 'Passport for Expatriate Employees',
                'sort_order' => 3,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name_en' => 'Visa',
                'name_ar' => 'التأشيرة',
                'code' => 'VISA',
                'category' => 'employee',
                'entity_type' => 'expat',
                'requires_expiry_date' => true,
                'requires_file_upload' => true,
                'has_auto_reminder' => true,
                'reminder_days_before' => 30,
                'required_fields' => json_encode(['visa_type', 'issue_date']),
                'optional_fields' => json_encode(['entry_date', 'sponsor']),
                'icon' => 'fas fa-plane',
                'color' => '#fd7e14',
                'description_ar' => 'تأشيرة دخول للموظفين الوافدين',
                'description_en' => 'Entry Visa for Expatriate Employees',
                'sort_order' => 4,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name_en' => 'Exit/Re-entry Permit',
                'name_ar' => 'تأشيرة خروج وعودة',
                'code' => 'EXIT_REENTRY',
                'category' => 'employee',
                'entity_type' => 'expat',
                'requires_expiry_date' => true,
                'requires_file_upload' => true,
                'has_auto_reminder' => true,
                'reminder_days_before' => 15,
                'required_fields' => json_encode(['issue_date', 'trip_purpose']),
                'optional_fields' => json_encode(['destination', 'duration']),
                'icon' => 'fas fa-route',
                'color' => '#20c997',
                'description_ar' => 'تأشيرة خروج وعودة للموظفين الوافدين',
                'description_en' => 'Exit and Re-entry Permit for Expatriate Employees',
                'sort_order' => 5,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            // Common Employee Documents
            [
                'name_en' => 'Work Contract',
                'name_ar' => 'عقد العمل',
                'code' => 'WORK_CONTRACT',
                'category' => 'employee',
                'entity_type' => 'both',
                'requires_expiry_date' => true,
                'requires_file_upload' => true,
                'has_auto_reminder' => true,
                'reminder_days_before' => 90,
                'required_fields' => json_encode(['contract_type', 'start_date']),
                'optional_fields' => json_encode(['salary', 'benefits']),
                'icon' => 'fas fa-file-contract',
                'color' => '#6c757d',
                'description_ar' => 'عقد العمل للموظفين',
                'description_en' => 'Employment Contract for Employees',
                'sort_order' => 6,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name_en' => 'Health Insurance',
                'name_ar' => 'التأمين الصحي',
                'code' => 'HEALTH_INSURANCE',
                'category' => 'employee',
                'entity_type' => 'both',
                'requires_expiry_date' => true,
                'requires_file_upload' => true,
                'has_auto_reminder' => true,
                'reminder_days_before' => 30,
                'required_fields' => json_encode(['policy_number', 'provider']),
                'optional_fields' => json_encode(['coverage_amount', 'family_covered']),
                'icon' => 'fas fa-heart',
                'color' => '#dc3545',
                'description_ar' => 'بوليصة التأمين الصحي',
                'description_en' => 'Health Insurance Policy',
                'sort_order' => 7,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        // Company Document Types
        $companyDocuments = [
            [
                'name_en' => 'Commercial Registration',
                'name_ar' => 'السجل التجاري',
                'code' => 'COMMERCIAL_REG',
                'category' => 'company',
                'entity_type' => 'both',
                'requires_expiry_date' => true,
                'requires_file_upload' => true,
                'has_auto_reminder' => true,
                'reminder_days_before' => 60,
                'required_fields' => json_encode(['registration_number', 'issue_authority']),
                'optional_fields' => json_encode(['capital_amount', 'business_type']),
                'icon' => 'fas fa-building',
                'color' => '#495057',
                'description_ar' => 'السجل التجاري للمنشأة',
                'description_en' => 'Company Commercial Registration',
                'sort_order' => 1,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name_en' => 'Civil Defense License',
                'name_ar' => 'ترخيص الدفاع المدني',
                'code' => 'CIVIL_DEFENSE',
                'category' => 'company',
                'entity_type' => 'both',
                'requires_expiry_date' => true,
                'requires_file_upload' => true,
                'has_auto_reminder' => true,
                'reminder_days_before' => 30,
                'required_fields' => json_encode(['license_number', 'facility_type', 'safety_status']),
                'optional_fields' => json_encode(['inspection_notes', 'total_area']),
                'icon' => 'fas fa-shield-alt',
                'color' => '#dc3545',
                'description_ar' => 'ترخيص الدفاع المدني للمنشأة',
                'description_en' => 'Civil Defense License for Facility',
                'sort_order' => 2,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name_en' => 'Municipality License',
                'name_ar' => 'رخصة البلدية',
                'code' => 'MUNICIPALITY',
                'category' => 'company',
                'entity_type' => 'both',
                'requires_expiry_date' => true,
                'requires_file_upload' => true,
                'has_auto_reminder' => true,
                'reminder_days_before' => 30,
                'required_fields' => json_encode(['license_number', 'municipality_name', 'activity_type']),
                'optional_fields' => json_encode(['area', 'zone_classification']),
                'icon' => 'fas fa-city',
                'color' => '#28a745',
                'description_ar' => 'رخصة البلدية للنشاط التجاري',
                'description_en' => 'Municipality License for Business Activity',
                'sort_order' => 3,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name_en' => 'VAT Registration',
                'name_ar' => 'شهادة التسجيل في ضريبة القيمة المضافة',
                'code' => 'VAT_REG',
                'category' => 'company',
                'entity_type' => 'both',
                'requires_expiry_date' => false,
                'requires_file_upload' => true,
                'has_auto_reminder' => false,
                'reminder_days_before' => 0,
                'required_fields' => json_encode(['vat_number', 'registration_date']),
                'optional_fields' => json_encode(['turnover_threshold']),
                'icon' => 'fas fa-percentage',
                'color' => '#ffc107',
                'description_ar' => 'شهادة التسجيل في ضريبة القيمة المضافة',
                'description_en' => 'VAT Registration Certificate',
                'sort_order' => 4,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name_en' => 'GOSI Registration',
                'name_ar' => 'شهادة التسجيل في التأمينات الاجتماعية',
                'code' => 'GOSI_REG',
                'category' => 'company',
                'entity_type' => 'both',
                'requires_expiry_date' => false,
                'requires_file_upload' => true,
                'has_auto_reminder' => false,
                'reminder_days_before' => 0,
                'required_fields' => json_encode(['gosi_number', 'registration_date']),
                'optional_fields' => json_encode(['branch_code']),
                'icon' => 'fas fa-users',
                'color' => '#17a2b8',
                'description_ar' => 'شهادة التسجيل في المؤسسة العامة للتأمينات الاجتماعية',
                'description_en' => 'General Organization for Social Insurance Registration',
                'sort_order' => 5,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        // Insert all document types
        $allDocuments = array_merge($employeeDocuments, $companyDocuments);

        foreach ($allDocuments as $document) {
            DB::table('document_types')->insert($document);
        }

        $this->command->info('Successfully seeded ' . count($allDocuments) . ' document types:');
        $this->command->info('- ' . count($employeeDocuments) . ' employee document types');
        $this->command->info('- ' . count($companyDocuments) . ' company document types');
    }
}

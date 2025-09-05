<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('document_types', function (Blueprint $table) {
            $table->id();

            // Basic Information
            $table->string('name_en'); // visa, national_id, iqama, etc.
            $table->string('name_ar'); // فيزا، هوية وطنية، إقامة، إلخ
            $table->string('code')->unique(); // VISA, NAT_ID, IQAMA, etc.

            // Category
            $table->enum('category', ['employee', 'company']); // للموظفين أو المنشأت
            $table->enum('entity_type', ['saudi', 'expat', 'both'])->default('both'); // للسعوديين، المقيمين، أو الكل

            // Configuration
            $table->boolean('requires_expiry_date')->default(true); // يتطلب تاريخ انتهاء
            $table->boolean('requires_file_upload')->default(true); // يتطلب رفع ملف
            $table->boolean('has_auto_reminder')->default(true); // له تذكير تلقائي
            $table->integer('reminder_days_before')->default(30); // عدد أيام التذكير قبل الانتهاء

            // Additional Fields Configuration (JSON)
            $table->json('required_fields')->nullable(); // الحقول المطلوبة الإضافية
            $table->json('optional_fields')->nullable(); // الحقول الاختيارية الإضافية

            // Display and Validation
            $table->string('icon')->nullable(); // أيقونة الوثيقة
            $table->string('color')->nullable(); // لون الوثيقة في الواجهة
            $table->text('description_ar')->nullable(); // وصف بالعربية
            $table->text('description_en')->nullable(); // وصف بالإنجليزية
            $table->integer('sort_order')->default(0); // ترتيب العرض

            // Status
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            // Indexes
            $table->index(['category', 'entity_type']);
            $table->index('code');
            $table->index(['is_active', 'sort_order']);
        });

        // Insert default document types
        DB::table('document_types')->insert([
            // Employee Documents
            [
                'name_en' => 'National ID',
                'name_ar' => 'الهوية الوطنية',
                'code' => 'NAT_ID',
                'category' => 'employee',
                'entity_type' => 'saudi',
                'requires_expiry_date' => true,
                'required_fields' => json_encode(['issue_date', 'issue_place']),
                'optional_fields' => json_encode(['notes']),
                'icon' => 'fas fa-id-card',
                'color' => '#28a745',
                'description_ar' => 'الهوية الوطنية للمواطنين السعوديين',
                'description_en' => 'National Identity Card for Saudi Citizens',
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name_en' => 'Iqama (Residence Permit)',
                'name_ar' => 'الإقامة',
                'code' => 'IQAMA',
                'category' => 'employee',
                'entity_type' => 'expat',
                'requires_expiry_date' => true,
                'required_fields' => json_encode(['issue_date', 'border_number']),
                'optional_fields' => json_encode(['sponsor_name', 'sponsor_id']),
                'icon' => 'fas fa-id-badge',
                'color' => '#007bff',
                'description_ar' => 'إقامة المقيمين في المملكة العربية السعودية',
                'description_en' => 'Residence Permit for Expats in Saudi Arabia',
                'sort_order' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name_en' => 'Passport',
                'name_ar' => 'جواز السفر',
                'code' => 'PASSPORT',
                'category' => 'employee',
                'entity_type' => 'both',
                'requires_expiry_date' => true,
                'required_fields' => json_encode(['issue_date', 'issue_place']),
                'optional_fields' => json_encode(['passport_type']),
                'icon' => 'fas fa-passport',
                'color' => '#6610f2',
                'description_ar' => 'جواز السفر',
                'description_en' => 'Passport Document',
                'sort_order' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name_en' => 'Visa',
                'name_ar' => 'الفيزا',
                'code' => 'VISA',
                'category' => 'employee',
                'entity_type' => 'expat',
                'requires_expiry_date' => true,
                'required_fields' => json_encode(['visa_type', 'sponsor_name', 'visa_purpose']),
                'optional_fields' => json_encode(['duration_days', 'fees_paid']),
                'icon' => 'fas fa-plane',
                'color' => '#fd7e14',
                'description_ar' => 'فيزا الدخول والإقامة',
                'description_en' => 'Entry and Residence Visa',
                'sort_order' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name_en' => 'Exit Re-entry Permit',
                'name_ar' => 'تأشيرة خروج وعودة',
                'code' => 'EXIT_REENTRY',
                'category' => 'employee',
                'entity_type' => 'expat',
                'requires_expiry_date' => true,
                'required_fields' => json_encode(['travel_type', 'destination_country']),
                'optional_fields' => json_encode(['travel_date', 'return_date', 'fees_paid']),
                'icon' => 'fas fa-sign-out-alt',
                'color' => '#dc3545',
                'description_ar' => 'تأشيرة الخروج والعودة للمقيمين',
                'description_en' => 'Exit and Re-entry Permit for Residents',
                'sort_order' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],

            // Company Documents
            [
                'name_en' => 'Civil Defense License',
                'name_ar' => 'ترخيص الدفاع المدني',
                'code' => 'CIVIL_DEFENSE',
                'category' => 'company',
                'entity_type' => 'both',
                'requires_expiry_date' => true,
                'required_fields' => json_encode(['authority', 'activity_classification', 'total_area']),
                'optional_fields' => json_encode(['floors', 'facility_type', 'safety_status']),
                'icon' => 'fas fa-shield-alt',
                'color' => '#e83e8c',
                'description_ar' => 'ترخيص السلامة من الدفاع المدني',
                'description_en' => 'Civil Defense Safety License',
                'sort_order' => 10,
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
                'required_fields' => json_encode(['municipality_name', 'license_type', 'activity_desc']),
                'optional_fields' => json_encode(['location_code', 'area', 'zone_classification']),
                'icon' => 'fas fa-building',
                'color' => '#20c997',
                'description_ar' => 'ترخيص مزاولة النشاط من البلدية',
                'description_en' => 'Municipality Business License',
                'sort_order' => 11,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name_en' => 'Commercial Registration',
                'name_ar' => 'السجل التجاري',
                'code' => 'COMMERCIAL_REG',
                'category' => 'company',
                'entity_type' => 'both',
                'requires_expiry_date' => true,
                'required_fields' => json_encode(['branch_reg_number', 'branch_type', 'authorized_capital']),
                'optional_fields' => json_encode(['manager_name', 'branch_activity', 'legal_form']),
                'icon' => 'fas fa-file-contract',
                'color' => '#6f42c1',
                'description_ar' => 'السجل التجاري أو شهادة الفرع',
                'description_en' => 'Commercial Registration or Branch Certificate',
                'sort_order' => 12,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_types');
    }
};

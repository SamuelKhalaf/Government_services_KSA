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
        Schema::create('employee_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees')->onDelete('cascade');
            $table->enum('document_type', ['visa', 'national_id', 'iqama', 'exit_reentry', 'passport']);
            
            // Document Information
            $table->string('document_number')->nullable();
            $table->date('issue_date')->nullable();
            $table->date('expiry_date')->nullable();
            $table->string('issuing_authority')->nullable();
            $table->string('place_of_issue')->nullable();
            
            // Visa specific fields
            $table->string('visa_type')->nullable(); // نوع الفيزا
            $table->string('sponsor_name')->nullable(); // اسم الكفيل
            $table->string('sponsor_id')->nullable(); // رقم هوية الكفيل
            $table->string('visa_purpose')->nullable(); // غرض الفيزا
            $table->integer('duration_days')->nullable(); // مدة الفيزا بالأيام
            
            // Exit/Re-entry specific fields
            $table->enum('travel_type', ['single', 'multiple'])->nullable(); // نوع السفر
            $table->date('travel_date')->nullable(); // تاريخ السفر
            $table->date('return_date')->nullable(); // تاريخ العودة
            $table->string('destination_country')->nullable(); // البلد المقصود
            
            // Financial Information
            $table->decimal('fees_paid', 8, 2)->nullable(); // الرسوم المدفوعة
            $table->string('payment_method')->nullable(); // طريقة الدفع
            $table->string('receipt_number')->nullable(); // رقم الإيصال
            
            // Status Information
            $table->enum('status', ['active', 'expired', 'cancelled', 'pending', 'under_process'])->default('active');
            $table->enum('document_status', ['original', 'copy', 'certified_copy'])->default('original');
            
            // File Information
            $table->string('file_path')->nullable(); // مسار الملف المرفوع
            $table->string('original_filename')->nullable();
            $table->string('file_type')->nullable(); // pdf, jpg, png, etc
            $table->integer('file_size')->nullable(); // بالبايت
            
            // Additional Information
            $table->text('notes')->nullable();
            $table->text('renewal_notes')->nullable(); // ملاحظات التجديد
            $table->date('reminder_date')->nullable(); // تاريخ التذكير
            $table->boolean('auto_reminder')->default(true); // تفعيل التذكير التلقائي
            
            $table->timestamps();
            
            // Indexes
            $table->index(['employee_id', 'document_type']);
            $table->index('document_number');
            $table->index('expiry_date');
            $table->index(['status', 'expiry_date']);
            $table->index('reminder_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_documents');
    }
};
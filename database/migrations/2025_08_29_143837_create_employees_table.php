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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');
            
            // Personal Information
            $table->string('full_name_ar');
            $table->string('full_name_en');
            $table->enum('type', ['saudi', 'expat']);
            $table->string('nationality');
            $table->date('dob_hijri')->nullable();
            $table->date('dob_greg');
            $table->string('pob'); // place of birth
            $table->enum('gender', ['male', 'female']);
            $table->enum('marital_status', ['single', 'married', 'divorced', 'widowed']);
            $table->string('religion')->nullable();
            $table->string('education')->nullable();
            $table->string('specialization')->nullable();
            
            // Identity Information
            // For Saudi employees
            $table->string('national_id')->nullable(); // رقم الهوية للسعوديين
            $table->date('national_id_issue_date')->nullable();
            $table->date('national_id_expiry_date')->nullable();
            $table->string('national_id_issue_place')->nullable();
            
            // For Expat employees
            $table->string('iqama_number')->nullable(); // رقم الإقامة
            $table->date('iqama_issue_date')->nullable();
            $table->date('iqama_expiry_date')->nullable();
            $table->string('border_number')->nullable(); // رقم الحدود
            $table->string('passport_number')->nullable();
            $table->date('passport_issue_date')->nullable();
            $table->date('passport_expiry_date')->nullable();
            $table->string('passport_issue_place')->nullable();
            
            // Contact Information
            $table->string('primary_mobile');
            $table->string('secondary_mobile')->nullable();
            $table->string('email')->nullable();
            
            // Address Information
            $table->string('region');
            $table->string('city');
            $table->string('district');
            $table->string('street');
            $table->string('building_number')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('pobox')->nullable();
            
            // Job Information
            $table->string('job_title');
            $table->date('hire_date');
            $table->enum('contract_type', ['permanent', 'temporary', 'part_time', 'contract']);
            $table->decimal('basic_salary', 10, 2);
            $table->decimal('allowances', 10, 2)->default(0);
            
            // Social Insurance Information
            $table->string('gosi_number')->nullable(); // رقم التأمينات الاجتماعية
            $table->string('medical_insurance_number')->nullable();
            $table->string('saned_number')->nullable(); // رقم ساند
            
            // Status and metadata
            $table->enum('status', ['active', 'inactive', 'terminated', 'on_leave'])->default('active');
            $table->timestamps();
            
            // Indexes
            $table->index(['company_id', 'status']);
            $table->index('national_id');
            $table->index('iqama_number');
            $table->index('passport_number');
            $table->index(['full_name_ar', 'full_name_en']);
            $table->index('hire_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
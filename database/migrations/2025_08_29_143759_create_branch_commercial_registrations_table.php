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
        Schema::create('branch_commercial_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');
            
            // Registration Information
            $table->string('branch_reg_number')->unique();
            $table->string('parent_cr_number'); // رقم السجل الأساسي
            $table->string('branch_type'); // فرع، مكتب، وكالة
            $table->decimal('authorized_capital', 15, 2);
            
            // Manager Information
            $table->string('manager_name');
            $table->string('manager_id_number');
            $table->string('manager_nationality');
            $table->string('manager_position');
            
            // Business Information
            $table->text('branch_activity');
            $table->date('registration_date');
            $table->string('legal_form'); // شكل قانوني
            
            // Additional Information
            $table->string('issuing_authority'); // الجهة المصدرة
            $table->date('issue_date');
            $table->date('expiry_date');
            $table->text('activities_list')->nullable(); // قائمة الأنشطة المصرح بها
            $table->text('notes')->nullable();
            $table->string('certificate_file_path')->nullable(); // Path to uploaded certificate
            
            // Status and metadata
            $table->enum('status', ['active', 'expired', 'suspended', 'cancelled'])->default('active');
            $table->timestamps();
            
            // Indexes
            $table->index('branch_reg_number');
            $table->index('parent_cr_number');
            $table->index('company_id');
            $table->index('manager_id_number');
            $table->index('expiry_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branch_commercial_registrations');
    }
};
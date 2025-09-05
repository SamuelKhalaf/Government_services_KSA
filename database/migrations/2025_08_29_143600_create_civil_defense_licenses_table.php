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
        Schema::create('civil_defense_licenses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');
            
            // License Information
            $table->string('license_number')->unique();
            $table->date('issue_date');
            $table->date('expiry_date');
            $table->string('authority'); // الجهة المصدرة
            $table->string('activity_classification');
            
            // Facility Information
            $table->decimal('total_area', 10, 2); // متر مربع
            $table->integer('floors');
            $table->string('facility_type');
            
            // Status Information
            $table->enum('safety_status', ['compliant', 'non_compliant', 'pending', 'under_review'])->default('pending');
            $table->enum('inspection_status', ['passed', 'failed', 'pending', 'not_required'])->default('pending');
            $table->date('last_inspection_date')->nullable();
            $table->date('next_inspection_date')->nullable();
            
            // Additional Information
            $table->text('notes')->nullable();
            $table->string('certificate_file_path')->nullable(); // Path to uploaded certificate
            
            // Status and metadata
            $table->enum('status', ['active', 'expired', 'suspended', 'cancelled'])->default('active');
            $table->timestamps();
            
            // Indexes
            $table->index('license_number');
            $table->index('company_id');
            $table->index('expiry_date');
            $table->index(['safety_status', 'inspection_status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('civil_defense_licenses');
    }
};
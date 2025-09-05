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
        Schema::create('municipality_licenses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');
            
            // License Information
            $table->string('license_number')->unique();
            $table->string('municipality_name');
            $table->string('license_type');
            $table->text('activity_desc');
            
            // Location Information
            $table->string('location_code');
            $table->decimal('area', 10, 2); // متر مربع
            $table->string('zone_classification');
            $table->string('building_permit_number')->nullable();
            $table->string('land_use_type');
            
            // Dates
            $table->date('issue_date');
            $table->date('expiry_date');
            
            // Additional Information
            $table->text('conditions')->nullable(); // شروط الترخيص
            $table->decimal('license_fees', 10, 2)->nullable();
            $table->text('notes')->nullable();
            $table->string('certificate_file_path')->nullable(); // Path to uploaded certificate
            
            // Status and metadata
            $table->enum('status', ['active', 'expired', 'suspended', 'cancelled', 'under_renewal'])->default('active');
            $table->timestamps();
            
            // Indexes
            $table->index('license_number');
            $table->index('company_id');
            $table->index('municipality_name');
            $table->index('expiry_date');
            $table->index('license_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('municipality_licenses');
    }
};
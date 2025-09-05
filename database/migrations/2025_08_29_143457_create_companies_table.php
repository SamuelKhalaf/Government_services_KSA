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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            
            // Basic Company Information
            $table->string('company_name_ar');
            $table->string('company_name_en');
            $table->string('cr_number')->unique();
            $table->string('establishment_number')->nullable();
            $table->string('license_number')->nullable();
            $table->string('tax_number')->nullable();
            $table->string('company_type');
            $table->string('isic_code')->nullable();
            
            // Contact Information
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            
            // Address Information
            $table->string('region');
            $table->string('city');
            $table->string('district');
            $table->string('street');
            $table->string('building_number')->nullable();
            $table->string('postal_code')->nullable();
            $table->text('additional_location')->nullable();
            
            // Legal Information
            $table->string('owner_name');
            $table->string('owner_id_number');
            $table->string('owner_nationality');
            $table->string('legal_status');
            $table->date('establishment_date');
            $table->decimal('capital_amount', 15, 2)->nullable();
            
            // Status and metadata
            $table->enum('status', ['active', 'inactive', 'suspended'])->default('active');
            $table->timestamps();
            
            // Indexes
            $table->index(['company_name_ar', 'company_name_en']);
            $table->index('cr_number');
            $table->index('tax_number');
            $table->index(['region', 'city']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
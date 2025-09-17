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
        Schema::table('packages', function (Blueprint $table) {
            // Add new columns for separate document types
            $table->integer('max_employee_documents')->nullable()->after('max_employees');
            $table->integer('max_company_documents')->nullable()->after('max_employee_documents');
            
            // Drop the old max_documents column
            $table->dropColumn('max_documents');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('packages', function (Blueprint $table) {
            // Add back the old max_documents column
            $table->integer('max_documents')->nullable()->after('max_employees');
            
            // Drop the new columns
            $table->dropColumn(['max_employee_documents', 'max_company_documents']);
        });
    }
};
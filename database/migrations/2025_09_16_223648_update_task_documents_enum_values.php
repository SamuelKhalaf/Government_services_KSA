<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update the document_type enum to include all document types
        DB::statement("ALTER TABLE task_documents MODIFY COLUMN document_type ENUM('company_document', 'employee_document', 'civil_defense', 'municipality', 'branch_registration') NOT NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert back to original enum values
        DB::statement("ALTER TABLE task_documents MODIFY COLUMN document_type ENUM('company_document', 'employee_document') NOT NULL");
    }
};
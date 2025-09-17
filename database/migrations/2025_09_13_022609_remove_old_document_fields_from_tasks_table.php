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
        Schema::table('tasks', function (Blueprint $table) {
            // Drop indexes first
            $table->dropIndex(['document_type', 'document_id']);
            $table->dropIndex(['document_type']);
            
            // Remove old single document columns since we now use task_documents pivot table
            $table->dropColumn(['document_type', 'document_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            // Re-add the old document fields if migration is rolled back
            $table->enum('document_type', ['company_document', 'employee_document'])->after('description');
            $table->unsignedBigInteger('document_id')->after('document_type');
            
            // Re-add indexes
            $table->index(['document_type', 'document_id']);
            $table->index('document_type');
        });
    }
};

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
            // Add document-related fields
            $table->enum('document_type', ['company_document', 'employee_document'])->after('client_id');
            $table->unsignedBigInteger('document_id')->after('document_type');
            
            // Add indexes for better performance
            $table->index(['document_type', 'document_id']);
            $table->index('document_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropIndex(['document_type', 'document_id']);
            $table->dropIndex(['document_type']);
            $table->dropColumn(['document_type', 'document_id']);
        });
    }
};
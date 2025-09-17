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
        Schema::create('task_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_id')->constrained('tasks')->onDelete('cascade');
            $table->enum('document_type', ['company_document', 'employee_document']);
            $table->unsignedBigInteger('document_id');
            $table->timestamps();
            
            // Composite unique index to prevent duplicate assignments
            $table->unique(['task_id', 'document_type', 'document_id']);
            
            // Indexes for better performance
            $table->index(['task_id']);
            $table->index(['document_type', 'document_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_documents');
    }
};

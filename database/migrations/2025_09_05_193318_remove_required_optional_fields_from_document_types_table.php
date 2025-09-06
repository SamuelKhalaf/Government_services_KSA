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
        Schema::table('document_types', function (Blueprint $table) {
            // Remove required_fields and optional_fields columns as they are now handled by custom_fields
            $table->dropColumn([
                'required_fields',
                'optional_fields'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('document_types', function (Blueprint $table) {
            // Add back the columns if migration is rolled back
            $table->json('required_fields')->nullable();
            $table->json('optional_fields')->nullable();
        });
    }
};

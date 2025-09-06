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
            // Remove columns that are no longer needed after implementing custom fields
            $table->dropColumn([
                'requires_expiry_date',
                'requires_file_upload', 
                'has_auto_reminder',
                'icon',
                'color',
                'sort_order'
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
            $table->boolean('requires_expiry_date')->default(true);
            $table->boolean('requires_file_upload')->default(true);
            $table->boolean('has_auto_reminder')->default(true);
            $table->string('icon')->nullable();
            $table->string('color')->nullable();
            $table->integer('sort_order')->default(0);
        });
    }
};

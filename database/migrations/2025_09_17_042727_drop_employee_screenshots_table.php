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
        Schema::dropIfExists('employee_screenshots');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('employee_screenshots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('file_path'); // Path to screenshot file
            $table->string('file_name'); // Original filename
            $table->string('mime_type')->default('image/png');
            $table->integer('file_size'); // File size in bytes
            $table->integer('width')->nullable(); // Screenshot width
            $table->integer('height')->nullable(); // Screenshot height
            $table->string('page_url')->nullable(); // URL where screenshot was taken
            $table->string('page_title')->nullable(); // Page title
            $table->timestamp('captured_at');
            $table->timestamps();

            $table->index(['user_id', 'captured_at']);
            $table->index(['captured_at']);
        });
    }
};
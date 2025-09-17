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
        Schema::create('employee_click_tracking', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('element_type'); // button, link, input, etc.
            $table->string('element_id')->nullable(); // HTML element ID
            $table->string('element_class')->nullable(); // HTML element class
            $table->string('element_text')->nullable(); // Text content of element
            $table->string('page_url'); // URL where click occurred
            $table->integer('x_position')->nullable(); // Mouse X position
            $table->integer('y_position')->nullable(); // Mouse Y position
            $table->timestamp('clicked_at');
            $table->timestamps();

            $table->index(['user_id', 'clicked_at']);
            $table->index(['page_url', 'clicked_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_click_tracking');
    }
};
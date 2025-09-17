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
        Schema::create('employee_active_screen_time', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('date'); // Date for the session
            $table->timestamp('session_start');
            $table->timestamp('session_end')->nullable();
            $table->integer('total_seconds'); // Total active time in seconds
            $table->integer('idle_seconds')->default(0); // Idle time in seconds
            $table->integer('click_count')->default(0); // Number of clicks during session
            $table->integer('keypress_count')->default(0); // Number of keypresses during session
            $table->integer('scroll_count')->default(0); // Number of scrolls during session
            $table->json('activity_breaks')->nullable(); // Array of idle periods
            $table->timestamps();

            $table->index(['user_id', 'date']);
            $table->index(['date', 'total_seconds']);
            $table->unique(['user_id', 'date', 'session_start']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_active_screen_time');
    }
};
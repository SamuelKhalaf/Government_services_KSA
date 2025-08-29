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
        Schema::table('users', function (Blueprint $table) {
            // User status and login tracking
            $table->enum('status', ['active', 'inactive'])->default('active')->after('password');
            $table->timestamp('last_login_at')->nullable()->after('status');
            
            // Saudi Arabia specific fields
            $table->string('national_id', 20)->unique()->nullable()->after('last_login_at')->comment('Saudi National ID');
            
            // Localization and UI
            $table->enum('preferred_language', ['ar', 'en'])->default('ar')->after('national_id');
            $table->string('avatar')->nullable()->after('preferred_language');
            
            // Additional information
            $table->text('address')->nullable()->after('avatar');
            $table->unsignedBigInteger('created_by')->nullable()->after('address');
            
            // Foreign key for created_by (references users table)
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            
            // Indexes for better performance
            $table->index('status');
            $table->index('preferred_language');
            $table->index('last_login_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop foreign key first
            $table->dropForeign(['created_by']);
            
            // Drop indexes
            $table->dropIndex(['status']);
            $table->dropIndex(['preferred_language']);
            $table->dropIndex(['last_login_at']);
            
            // Drop columns
            $table->dropColumn([
                'status',
                'last_login_at',
                'national_id',
                'preferred_language',
                'avatar',
                'address',
                'created_by'
            ]);
        });
    }
};

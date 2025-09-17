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
        // Add reminder fields to branch_commercial_registrations table
        Schema::table('branch_commercial_registrations', function (Blueprint $table) {
            $table->boolean('enable_reminder')->default(false)->after('status');
            $table->integer('reminder_days')->nullable()->after('enable_reminder');
            $table->index('enable_reminder');
            $table->index('reminder_days');
        });

        // Add reminder fields to civil_defense_licenses table
        Schema::table('civil_defense_licenses', function (Blueprint $table) {
            $table->boolean('enable_reminder')->default(false)->after('status');
            $table->integer('reminder_days')->nullable()->after('enable_reminder');
            $table->index('enable_reminder');
            $table->index('reminder_days');
        });

        // Add reminder fields to municipality_licenses table
        Schema::table('municipality_licenses', function (Blueprint $table) {
            $table->boolean('enable_reminder')->default(false)->after('status');
            $table->integer('reminder_days')->nullable()->after('enable_reminder');
            $table->index('enable_reminder');
            $table->index('reminder_days');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove reminder fields from branch_commercial_registrations table
        Schema::table('branch_commercial_registrations', function (Blueprint $table) {
            $table->dropIndex(['enable_reminder']);
            $table->dropIndex(['reminder_days']);
            $table->dropColumn(['enable_reminder', 'reminder_days']);
        });

        // Remove reminder fields from civil_defense_licenses table
        Schema::table('civil_defense_licenses', function (Blueprint $table) {
            $table->dropIndex(['enable_reminder']);
            $table->dropIndex(['reminder_days']);
            $table->dropColumn(['enable_reminder', 'reminder_days']);
        });

        // Remove reminder fields from municipality_licenses table
        Schema::table('municipality_licenses', function (Blueprint $table) {
            $table->dropIndex(['enable_reminder']);
            $table->dropIndex(['reminder_days']);
            $table->dropColumn(['enable_reminder', 'reminder_days']);
        });
    }
};

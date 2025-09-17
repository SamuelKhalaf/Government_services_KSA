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
        Schema::table('employee_documents', function (Blueprint $table) {
            // Add new columns for the simplified structure
            if (!Schema::hasColumn('employee_documents', 'enable_reminder')) {
                $table->boolean('enable_reminder')->default(false)->after('status');
            }
            if (!Schema::hasColumn('employee_documents', 'reminder_days')) {
                $table->integer('reminder_days')->nullable()->after('enable_reminder');
            }
            if (!Schema::hasColumn('employee_documents', 'custom_fields')) {
                $table->json('custom_fields')->nullable()->after('status');
            }

            // Remove legacy columns that are now handled by custom_fields
            $table->dropColumn([
                'document_number',
                'issue_date',
                'expiry_date',
                'issuing_authority',
                'place_of_issue',
                'visa_type',
                'sponsor_name',
                'sponsor_id',
                'visa_purpose',
                'duration_days',
                'travel_type',
                'travel_date',
                'return_date',
                'destination_country',
                'fees_paid',
                'payment_method',
                'receipt_number',
                'document_status',
                'file_path',
                'original_filename',
                'file_type',
                'file_size',
                'notes',
                'renewal_notes',
                'reminder_date',
                'auto_reminder'
            ]);
        });

        // Update indexes to reflect new structure
        Schema::table('employee_documents', function (Blueprint $table) {
            // Remove old indexes if they exist
            if (Schema::hasIndex('employee_documents', 'employee_documents_document_number_index')) {
                $table->dropIndex(['document_number']);
            }
            if (Schema::hasIndex('employee_documents', 'employee_documents_expiry_date_index')) {
                $table->dropIndex(['expiry_date']);
            }
            if (Schema::hasIndex('employee_documents', 'employee_documents_status_expiry_date_index')) {
                $table->dropIndex(['status', 'expiry_date']);
            }
            if (Schema::hasIndex('employee_documents', 'employee_documents_reminder_date_index')) {
                $table->dropIndex(['reminder_date']);
            }

            // Add new indexes only if columns exist
            if (Schema::hasColumn('employee_documents', 'enable_reminder')) {
                $table->index(['status', 'enable_reminder']);
            }
            if (Schema::hasColumn('employee_documents', 'reminder_days')) {
                $table->index('reminder_days');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employee_documents', function (Blueprint $table) {
            // Add back the legacy columns
            $table->string('document_number')->nullable()->after('document_type');
            $table->date('issue_date')->nullable()->after('document_number');
            $table->date('expiry_date')->nullable()->after('issue_date');
            $table->string('issuing_authority')->nullable()->after('expiry_date');
            $table->string('place_of_issue')->nullable()->after('issuing_authority');

            // Visa specific fields
            $table->string('visa_type')->nullable()->after('place_of_issue');
            $table->string('sponsor_name')->nullable()->after('visa_type');
            $table->string('sponsor_id')->nullable()->after('sponsor_name');
            $table->string('visa_purpose')->nullable()->after('sponsor_id');
            $table->integer('duration_days')->nullable()->after('visa_purpose');

            // Exit/Re-entry specific fields
            $table->enum('travel_type', ['single', 'multiple'])->nullable()->after('duration_days');
            $table->date('travel_date')->nullable()->after('travel_type');
            $table->date('return_date')->nullable()->after('travel_date');
            $table->string('destination_country')->nullable()->after('return_date');

            // Financial Information
            $table->decimal('fees_paid', 8, 2)->nullable()->after('destination_country');
            $table->string('payment_method')->nullable()->after('fees_paid');
            $table->string('receipt_number')->nullable()->after('payment_method');

            // Status Information
            $table->enum('document_status', ['original', 'copy', 'certified_copy'])->default('original')->after('status');

            // File Information
            $table->string('file_path')->nullable()->after('document_status');
            $table->string('original_filename')->nullable()->after('file_path');
            $table->string('file_type')->nullable()->after('original_filename');
            $table->integer('file_size')->nullable()->after('file_type');

            // Additional Information
            $table->text('notes')->nullable()->after('file_size');
            $table->text('renewal_notes')->nullable()->after('notes');
            $table->date('reminder_date')->nullable()->after('renewal_notes');
            $table->boolean('auto_reminder')->default(true)->after('reminder_date');

            // Remove new columns
            $table->dropColumn(['enable_reminder', 'reminder_days', 'custom_fields']);
        });

        // Restore old indexes
        Schema::table('employee_documents', function (Blueprint $table) {
            // Drop new indexes if they exist
            if (Schema::hasIndex('employee_documents', 'employee_documents_status_enable_reminder_index')) {
                $table->dropIndex(['status', 'enable_reminder']);
            }
            if (Schema::hasIndex('employee_documents', 'employee_documents_reminder_days_index')) {
                $table->dropIndex(['reminder_days']);
            }

            // Add back old indexes
            $table->index(['document_number']);
            $table->index(['expiry_date']);
            $table->index(['status', 'expiry_date']);
            $table->index(['reminder_date']);
        });
    }
};

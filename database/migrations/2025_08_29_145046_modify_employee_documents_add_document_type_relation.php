<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // First, add the new document_type_id column
        Schema::table('employee_documents', function (Blueprint $table) {
            $table->foreignId('document_type_id')->nullable()->after('employee_id')->constrained('document_types')->onDelete('restrict');
        });
        
        // Update existing records to map enum values to document_type_id
        $mappings = [
            'visa' => 'VISA',
            'national_id' => 'NAT_ID', 
            'iqama' => 'IQAMA',
            'exit_reentry' => 'EXIT_REENTRY',
            'passport' => 'PASSPORT'
        ];
        
        foreach ($mappings as $enumValue => $code) {
            $documentType = DB::table('document_types')->where('code', $code)->first();
            if ($documentType) {
                DB::table('employee_documents')
                    ->where('document_type', $enumValue)
                    ->update(['document_type_id' => $documentType->id]);
            }
        }
        
        // Make document_type_id required and remove the old enum column
        Schema::table('employee_documents', function (Blueprint $table) {
            $table->foreignId('document_type_id')->nullable(false)->change();
            $table->dropColumn('document_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Add back the enum column
        Schema::table('employee_documents', function (Blueprint $table) {
            $table->enum('document_type', ['visa', 'national_id', 'iqama', 'exit_reentry', 'passport'])->after('employee_id');
        });
        
        // Map back from document_type_id to enum values
        $mappings = [
            'VISA' => 'visa',
            'NAT_ID' => 'national_id',
            'IQAMA' => 'iqama', 
            'EXIT_REENTRY' => 'exit_reentry',
            'PASSPORT' => 'passport'
        ];
        
        foreach ($mappings as $code => $enumValue) {
            $documentType = DB::table('document_types')->where('code', $code)->first();
            if ($documentType) {
                DB::table('employee_documents')
                    ->where('document_type_id', $documentType->id)
                    ->update(['document_type' => $enumValue]);
            }
        }
        
        // Remove the foreign key column
        Schema::table('employee_documents', function (Blueprint $table) {
            $table->dropForeign(['document_type_id']);
            $table->dropColumn('document_type_id');
        });
    }
};
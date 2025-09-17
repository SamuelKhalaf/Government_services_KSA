<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SystemDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Seeding System Data...');

        // Seed migrations
        $this->seedMigrations();
        
        // Seed password reset tokens
        $this->seedPasswordResetTokens();
        
        // Seed personal access tokens
        $this->seedPersonalAccessTokens();

        $this->command->info('System Data seeded successfully!');
    }

    private function seedMigrations()
    {
        $migrations = [
            ['id' => 1, 'migration' => '2014_10_12_000000_create_users_table', 'batch' => 1],
            ['id' => 2, 'migration' => '2014_10_12_100000_create_password_reset_tokens_table', 'batch' => 1],
            ['id' => 3, 'migration' => '2014_10_12_100000_create_password_resets_table', 'batch' => 1],
            ['id' => 4, 'migration' => '2019_08_19_000000_create_failed_jobs_table', 'batch' => 1],
            ['id' => 5, 'migration' => '2019_12_14_000001_create_personal_access_tokens_table', 'batch' => 1],
            ['id' => 6, 'migration' => '2025_03_26_115531_create_permission_tables', 'batch' => 1],
            ['id' => 7, 'migration' => '2025_08_27_015832_add_additional_fields_to_users_table', 'batch' => 2],
            ['id' => 8, 'migration' => '2025_08_29_143457_create_companies_table', 'batch' => 3],
            ['id' => 9, 'migration' => '2025_08_29_143600_create_civil_defense_licenses_table', 'batch' => 3],
            ['id' => 10, 'migration' => '2025_08_29_143707_create_municipality_licenses_table', 'batch' => 3],
            ['id' => 11, 'migration' => '2025_08_29_143759_create_branch_commercial_registrations_table', 'batch' => 3],
            ['id' => 12, 'migration' => '2025_08_29_143837_create_employees_table', 'batch' => 3],
            ['id' => 13, 'migration' => '2025_08_29_143942_create_employee_documents_table', 'batch' => 3],
            ['id' => 14, 'migration' => '2025_08_29_144627_create_document_types_table', 'batch' => 4],
            ['id' => 15, 'migration' => '2025_08_29_145046_modify_employee_documents_add_document_type_relation', 'batch' => 5],
            ['id' => 16, 'migration' => '2025_09_05_184203_add_custom_fields_to_document_types_table', 'batch' => 6],
            ['id' => 17, 'migration' => '2025_09_05_193134_remove_unused_columns_from_document_types_table', 'batch' => 7],
            ['id' => 19, 'migration' => '2025_09_05_193318_remove_required_optional_fields_from_document_types_table', 'batch' => 8],
            ['id' => 20, 'migration' => '2025_09_05_234222_update_employee_documents_table_structure', 'batch' => 9],
            ['id' => 21, 'migration' => '2025_09_06_012945_create_company_documents_table', 'batch' => 10],
            ['id' => 22, 'migration' => '2025_09_07_144739_create_tasks_table', 'batch' => 11],
            ['id' => 23, 'migration' => '2025_09_07_144744_create_task_histories_table', 'batch' => 11],
            ['id' => 24, 'migration' => '2025_09_08_004144_create_notifications_table', 'batch' => 12],
            ['id' => 26, 'migration' => '2025_09_08_020202_create_packages_table', 'batch' => 13],
            ['id' => 27, 'migration' => '2025_09_08_020208_create_client_packages_table', 'batch' => 14],
            ['id' => 28, 'migration' => '2025_09_08_020212_create_invoices_table', 'batch' => 14],
            ['id' => 29, 'migration' => '2025_09_12_230025_modify_packages_table_separate_document_types', 'batch' => 15],
            ['id' => 30, 'migration' => '2025_09_13_002836_add_document_fields_to_tasks_table', 'batch' => 16],
            ['id' => 31, 'migration' => '2025_09_13_120000_create_task_documents_table', 'batch' => 17],
            ['id' => 32, 'migration' => '2025_09_13_013212_remove_client_id_from_tasks_table', 'batch' => 18],
            ['id' => 33, 'migration' => '2025_09_13_022609_remove_old_document_fields_from_tasks_table', 'batch' => 19],
            ['id' => 34, 'migration' => '2025_09_16_223648_update_task_documents_enum_values', 'batch' => 20],
            ['id' => 35, 'migration' => '2025_01_27_000000_add_reminder_fields_to_company_document_models', 'batch' => 21],
            ['id' => 36, 'migration' => '2025_09_17_025235_remove_unused_permissions', 'batch' => 22],
            ['id' => 37, 'migration' => '2025_09_17_025724_consolidate_document_permissions', 'batch' => 23],
            ['id' => 38, 'migration' => '2025_09_17_030400_create_employee_login_logs_table', 'batch' => 23],
            ['id' => 39, 'migration' => '2025_09_17_030440_create_employee_activity_logs_table', 'batch' => 23],
            ['id' => 40, 'migration' => '2025_09_17_030556_create_employee_click_tracking_table', 'batch' => 23],
            ['id' => 41, 'migration' => '2025_09_17_030604_create_employee_active_screen_time_table', 'batch' => 23],
            ['id' => 42, 'migration' => '2025_09_17_030611_create_employee_screenshots_table', 'batch' => 23],
            ['id' => 43, 'migration' => '2025_09_17_042727_drop_employee_screenshots_table', 'batch' => 24],
        ];

        foreach ($migrations as $migration) {
            DB::table('migrations')->updateOrInsert(
                ['id' => $migration['id']],
                $migration
            );
        }
    }

    private function seedPasswordResetTokens()
    {
        $passwordResetTokens = [
            [
                'email' => 'admin@example.com',
                'token' => '$2y$12$FwpKak2YqIuWG4YRTFzTHObZkDOT6IhecL5jnruTVHptN4/4iOQIG',
                'created_at' => '2025-08-29 05:19:46'
            ],
        ];

        foreach ($passwordResetTokens as $token) {
            DB::table('password_reset_tokens')->updateOrInsert(
                ['email' => $token['email']],
                $token
            );
        }
    }

    private function seedPersonalAccessTokens()
    {
        $personalAccessTokens = [
            [
                'id' => 1,
                'tokenable_type' => 'App\\Models\\User',
                'tokenable_id' => 13,
                'name' => 'test-token',
                'token' => '69c9dbbf611adc03149b47cceabcef9c467feac75a0bf35a81ff64b6c5168d2b',
                'abilities' => '["*"]',
                'last_used_at' => null,
                'expires_at' => null,
                'created_at' => '2025-09-17 00:50:51',
                'updated_at' => '2025-09-17 00:50:51'
            ],
        ];

        foreach ($personalAccessTokens as $token) {
            DB::table('personal_access_tokens')->updateOrInsert(
                ['id' => $token['id']],
                $token
            );
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeMonitoringDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Seeding Employee Monitoring Data...');

        // Seed employee login logs
        $this->seedEmployeeLoginLogs();
        
        // Seed employee activity logs
        $this->seedEmployeeActivityLogs();
        
        // Seed employee click tracking
        $this->seedEmployeeClickTracking();
        
        // Seed employee active screen time
        $this->seedEmployeeActiveScreenTime();

        $this->command->info('Employee Monitoring Data seeded successfully!');
    }

    private function seedEmployeeLoginLogs()
    {
        $loginLogs = [
            [
                'id' => 18, 'user_id' => 13, 'login_at' => '2025-09-17 01:11:25', 'logout_at' => null,
                'ip_address' => '127.0.0.1', 'user_agent' => 'Symfony', 'session_id' => 'EIT0xHxvsSbxaNIgQ8Xugpe8JQjRMRxYtJ2Sj8VW',
                'status' => 'active', 'duration_minutes' => null,
                'created_at' => '2025-09-17 01:11:25', 'updated_at' => '2025-09-17 01:11:25'
            ],
        ];

        foreach ($loginLogs as $loginLog) {
            DB::table('employee_login_logs')->updateOrInsert(
                ['id' => $loginLog['id']],
                $loginLog
            );
        }
    }

    private function seedEmployeeActivityLogs()
    {
        $activityLogs = [
            [
                'id' => 1, 'user_id' => 13, 'action_type' => 'test', 'model_type' => 'Test', 'model_id' => null,
                'description' => 'Test activity', 'old_values' => null, 'new_values' => null,
                'ip_address' => '127.0.0.1', 'user_agent' => 'test', 'url' => 'http://test.com',
                'created_at' => '2025-09-17 00:57:57', 'updated_at' => '2025-09-17 00:57:57'
            ],
            [
                'id' => 2, 'user_id' => 44, 'action_type' => 'view', 'model_type' => 'App\\Models\\Company', 'model_id' => null,
                'description' => 'Viewed Company page', 'old_values' => null, 'new_values' => null,
                'ip_address' => '127.0.0.1', 'user_agent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'url' => 'http://127.0.0.1:8000/admin/companies',
                'created_at' => '2025-09-17 01:05:39', 'updated_at' => '2025-09-17 01:05:39'
            ],
            [
                'id' => 3, 'user_id' => 44, 'action_type' => 'view', 'model_type' => 'App\\Models\\Company', 'model_id' => null,
                'description' => 'Viewed Company page', 'old_values' => null, 'new_values' => null,
                'ip_address' => '127.0.0.1', 'user_agent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'url' => 'http://127.0.0.1:8000/admin/companies',
                'created_at' => '2025-09-17 01:08:03', 'updated_at' => '2025-09-17 01:08:03'
            ],
            [
                'id' => 4, 'user_id' => 44, 'action_type' => 'view', 'model_type' => 'App\\Models\\Company', 'model_id' => null,
                'description' => 'Viewed Company page', 'old_values' => null, 'new_values' => null,
                'ip_address' => '127.0.0.1', 'user_agent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'url' => 'http://127.0.0.1:8000/admin/companies?search=asd',
                'created_at' => '2025-09-17 01:08:15', 'updated_at' => '2025-09-17 01:08:15'
            ],
            [
                'id' => 5, 'user_id' => 44, 'action_type' => 'view', 'model_type' => 'App\\Models\\Company', 'model_id' => null,
                'description' => 'Viewed Company page', 'old_values' => null, 'new_values' => null,
                'ip_address' => '127.0.0.1', 'user_agent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'url' => 'http://127.0.0.1:8000/admin/companies?search=asd',
                'created_at' => '2025-09-17 01:08:15', 'updated_at' => '2025-09-17 01:08:15'
            ],
            [
                'id' => 6, 'user_id' => 44, 'action_type' => 'view', 'model_type' => 'App\\Models\\Company', 'model_id' => null,
                'description' => 'Viewed Company page', 'old_values' => null, 'new_values' => null,
                'ip_address' => '127.0.0.1', 'user_agent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'url' => 'http://127.0.0.1:8000/admin/companies?search=asd',
                'created_at' => '2025-09-17 01:08:15', 'updated_at' => '2025-09-17 01:08:15'
            ],
            [
                'id' => 7, 'user_id' => 44, 'action_type' => 'view', 'model_type' => 'App\\Models\\Company', 'model_id' => null,
                'description' => 'Viewed Company page', 'old_values' => null, 'new_values' => null,
                'ip_address' => '127.0.0.1', 'user_agent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'url' => 'http://127.0.0.1:8000/admin/companies',
                'created_at' => '2025-09-17 01:08:19', 'updated_at' => '2025-09-17 01:08:19'
            ],
            [
                'id' => 8, 'user_id' => 44, 'action_type' => 'view', 'model_type' => 'App\\Models\\CompanyDocument', 'model_id' => null,
                'description' => 'Viewed CompanyDocument page', 'old_values' => null, 'new_values' => null,
                'ip_address' => '127.0.0.1', 'user_agent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'url' => 'http://127.0.0.1:8000/admin/company-documents',
                'created_at' => '2025-09-17 01:09:03', 'updated_at' => '2025-09-17 01:09:03'
            ],
            [
                'id' => 9, 'user_id' => 44, 'action_type' => 'view', 'model_type' => 'App\\Models\\Employee', 'model_id' => null,
                'description' => 'Viewed Employee page', 'old_values' => null, 'new_values' => null,
                'ip_address' => '127.0.0.1', 'user_agent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'url' => 'http://127.0.0.1:8000/admin/employees',
                'created_at' => '2025-09-17 01:09:05', 'updated_at' => '2025-09-17 01:09:05'
            ],
            [
                'id' => 10, 'user_id' => 44, 'action_type' => 'view', 'model_type' => 'App\\Models\\Document', 'model_id' => null,
                'description' => 'Viewed Document page', 'old_values' => null, 'new_values' => null,
                'ip_address' => '127.0.0.1', 'user_agent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'url' => 'http://127.0.0.1:8000/admin/documents',
                'created_at' => '2025-09-17 01:09:07', 'updated_at' => '2025-09-17 01:09:07'
            ],
        ];

        foreach ($activityLogs as $activityLog) {
            DB::table('employee_activity_logs')->updateOrInsert(
                ['id' => $activityLog['id']],
                $activityLog
            );
        }
    }

    private function seedEmployeeClickTracking()
    {
        $clickTracking = [
            [
                'id' => 1, 'user_id' => 13, 'element_type' => 'button', 'element_id' => null, 'element_class' => null,
                'element_text' => null, 'page_url' => 'http://test.com', 'x_position' => null, 'y_position' => null,
                'clicked_at' => '2025-09-17 00:50:43', 'created_at' => '2025-09-17 00:50:43', 'updated_at' => '2025-09-17 00:50:43'
            ],
            [
                'id' => 2, 'user_id' => 44, 'element_type' => 'div', 'element_id' => null, 'element_class' => 'text-gray-600 fs-6',
                'element_text' => 'عليك بتجديد هذه الوثائق فى اسرع وقت', 'page_url' => 'http://127.0.0.1:8000/admin/tasks/14', 'x_position' => 631, 'y_position' => 288,
                'clicked_at' => '2025-09-17 00:54:30', 'created_at' => '2025-09-17 00:54:30', 'updated_at' => '2025-09-17 00:54:30'
            ],
            [
                'id' => 3, 'user_id' => 44, 'element_type' => 'h2', 'element_id' => null, 'element_class' => null,
                'element_text' => 'تفاصيل المهمة', 'page_url' => 'http://127.0.0.1:8000/admin/tasks/14', 'x_position' => 840, 'y_position' => 189,
                'clicked_at' => '2025-09-17 00:54:31', 'created_at' => '2025-09-17 00:54:31', 'updated_at' => '2025-09-17 00:54:31'
            ],
            [
                'id' => 4, 'user_id' => 44, 'element_type' => 'a', 'element_id' => null, 'element_class' => 'btn btn-sm btn-light-info',
                'element_text' => 'عرض', 'page_url' => 'http://127.0.0.1:8000/admin/tasks/14', 'x_position' => 609, 'y_position' => 449,
                'clicked_at' => '2025-09-17 00:55:08', 'created_at' => '2025-09-17 00:55:08', 'updated_at' => '2025-09-17 00:55:08'
            ],
            [
                'id' => 5, 'user_id' => 44, 'element_type' => 'a', 'element_id' => null, 'element_class' => 'menu-link px-5',
                'element_text' => 'تسجيل الخروج', 'page_url' => 'http://127.0.0.1:8000/admin/employees/1/documents/1', 'x_position' => 136, 'y_position' => 223,
                'clicked_at' => '2025-09-17 00:55:12', 'created_at' => '2025-09-17 00:55:12', 'updated_at' => '2025-09-17 00:55:12'
            ],
        ];

        foreach ($clickTracking as $click) {
            DB::table('employee_click_tracking')->updateOrInsert(
                ['id' => $click['id']],
                $click
            );
        }
    }

    private function seedEmployeeActiveScreenTime()
    {
        $screenTime = [
            [
                'id' => 1, 'user_id' => 44, 'date' => '2025-09-17', 'session_start' => '2025-09-17 00:55:08',
                'session_end' => null, 'total_seconds' => 68, 'idle_seconds' => 2493, 'click_count' => 29,
                'keypress_count' => 10, 'scroll_count' => 43, 'activity_breaks' => '[[], [], [], [], [], [], [], [], [], [], [], [], [], [], [], [], [], [], [], [], [], [], []]',
                'created_at' => '2025-09-17 00:55:08', 'updated_at' => '2025-09-17 01:35:04'
            ],
        ];

        foreach ($screenTime as $screen) {
            DB::table('employee_active_screen_time')->updateOrInsert(
                ['id' => $screen['id']],
                $screen
            );
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NotificationDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Seeding Notifications...');

        // Seed notifications
        $this->seedNotifications();

        $this->command->info('Notifications seeded successfully!');
    }

    private function seedNotifications()
    {
        $notifications = [
            [
                'id' => 10, 'type' => 'task_status_changed', 'title' => 'تم تحديث حالة المهمة',
                'message' => 'تم تغيير حالة المهمة "تسجيل الشركة في الضرائب" من "قيد التنفيذ" إلى "مكتملة" من قبل موظف وثائق.',
                'data' => '{"task_id": 9, "changed_by": "موظف وثائق", "new_status": "completed", "old_status": "in_progress", "task_title": "تسجيل الشركة في الضرائب", "new_status_name": "مكتملة", "old_status_name": "قيد التنفيذ"}',
                'user_id' => 43, 'created_by' => 44, 'is_read' => 0, 'read_at' => null,
                'created_at' => '2025-09-07 22:44:52', 'updated_at' => '2025-09-16 23:12:09'
            ],
            [
                'id' => 12, 'type' => 'task_assigned', 'title' => 'تكليف مهمة',
                'message' => 'تم تكليفك بمهمة "تسجيل الشركة في الضرائب" من قبل مدير النظام.',
                'data' => '{"task_id": 9, "task_title": "تسجيل الشركة في الضرائب", "assigned_by": "مدير النظام"}',
                'user_id' => 45, 'created_by' => 43, 'is_read' => 0, 'read_at' => null,
                'created_at' => '2025-09-12 21:16:39', 'updated_at' => '2025-09-12 21:16:39'
            ],
            [
                'id' => 15, 'type' => 'task_assigned', 'title' => 'تكليف مهمة',
                'message' => 'تم تكليفك بمهمة "وثائق شركه سعودية" من قبل مدير النظام.',
                'data' => '{"task_id": 14, "task_title": "وثائق شركه سعودية", "assigned_by": "مدير النظام"}',
                'user_id' => 44, 'created_by' => 43, 'is_read' => 1, 'read_at' => '2025-09-12 23:48:27',
                'created_at' => '2025-09-12 23:37:30', 'updated_at' => '2025-09-12 23:48:27'
            ],
            [
                'id' => 16, 'type' => 'task_status_changed', 'title' => 'تم تحديث حالة المهمة',
                'message' => 'تم تغيير حالة المهمة "وثائق شركه سعودية" من "جديدة" إلى "قيد التنفيذ" من قبل موظف وثائق.',
                'data' => '{"task_id": 14, "changed_by": "موظف وثائق", "new_status": "in_progress", "old_status": "new", "task_title": "وثائق شركه سعودية", "new_status_name": "قيد التنفيذ", "old_status_name": "جديدة"}',
                'user_id' => 43, 'created_by' => 44, 'is_read' => 0, 'read_at' => null,
                'created_at' => '2025-09-12 23:49:27', 'updated_at' => '2025-09-16 23:12:07'
            ],
            [
                'id' => 17, 'type' => 'task_created', 'title' => 'مهمة جديدة مُكلفة',
                'message' => 'تم تكليفك بمهمة جديدة "{title}".',
                'data' => '{"task_id": 15, "task_title": "asdfs", "assigned_by": "مدير النظام"}',
                'user_id' => 32, 'created_by' => 43, 'is_read' => 0, 'read_at' => null,
                'created_at' => '2025-09-16 17:37:18', 'updated_at' => '2025-09-16 17:37:18'
            ],
            [
                'id' => 18, 'type' => 'task_assigned', 'title' => 'تكليف مهمة',
                'message' => 'تم تكليفك بمهمة "وثائق شركه سعودية" من قبل مدير النظام.',
                'data' => '{"task_id": 14, "task_title": "وثائق شركه سعودية", "assigned_by": "مدير النظام"}',
                'user_id' => 44, 'created_by' => 43, 'is_read' => 0, 'read_at' => null,
                'created_at' => '2025-09-16 18:22:52', 'updated_at' => '2025-09-16 18:22:52'
            ],
            [
                'id' => 19, 'type' => 'task_assigned', 'title' => 'تكليف مهمة',
                'message' => 'تم تكليفك بمهمة "وثائق شركه سعودية" من قبل مدير النظام.',
                'data' => '{"task_id": 14, "task_title": "وثائق شركه سعودية", "assigned_by": "مدير النظام"}',
                'user_id' => 44, 'created_by' => 43, 'is_read' => 0, 'read_at' => null,
                'created_at' => '2025-09-16 19:19:10', 'updated_at' => '2025-09-16 19:19:10'
            ],
            [
                'id' => 20, 'type' => 'task_assigned', 'title' => 'تكليف مهمة',
                'message' => 'تم تكليفك بمهمة "وثائق شركه سعودية" من قبل مدير النظام.',
                'data' => '{"task_id": 14, "task_title": "وثائق شركه سعودية", "assigned_by": "مدير النظام"}',
                'user_id' => 44, 'created_by' => 43, 'is_read' => 0, 'read_at' => null,
                'created_at' => '2025-09-16 19:23:14', 'updated_at' => '2025-09-16 19:23:14'
            ],
            [
                'id' => 21, 'type' => 'task_assigned', 'title' => 'تكليف مهمة',
                'message' => 'تم تكليفك بمهمة "وثائق شركه سعودية" من قبل مدير النظام.',
                'data' => '{"task_id": 14, "task_title": "وثائق شركه سعودية", "assigned_by": "مدير النظام"}',
                'user_id' => 44, 'created_by' => 43, 'is_read' => 0, 'read_at' => null,
                'created_at' => '2025-09-16 19:56:57', 'updated_at' => '2025-09-16 19:56:57'
            ],
            [
                'id' => 22, 'type' => 'task_assigned', 'title' => 'تكليف مهمة',
                'message' => 'تم تكليفك بمهمة "وثائق شركه سعودية" من قبل مدير النظام.',
                'data' => '{"task_id": 14, "task_title": "وثائق شركه سعودية", "assigned_by": "مدير النظام"}',
                'user_id' => 44, 'created_by' => 43, 'is_read' => 0, 'read_at' => null,
                'created_at' => '2025-09-16 20:55:35', 'updated_at' => '2025-09-16 20:55:35'
            ],
            // Document expiry notifications
            [
                'id' => 75, 'type' => 'admin_document_expiring_soon', 'title' => 'تنبيه وثيقة ستنتهي قريباً',
                'message' => 'الوثيقة "GOSI Registration" لـ "Mccall Clarke LLC" ستنتهي خلال 1 أيام في 2025-09-19.',
                'data' => '{"document_id": 1, "entity_name": "Mccall Clarke LLC", "expiry_date": "2025-09-19", "document_type": "GOSI Registration", "days_until_expiry": 1, "document_category": "company"}',
                'user_id' => 22, 'created_by' => null, 'is_read' => 0, 'read_at' => null,
                'created_at' => '2025-09-16 22:31:11', 'updated_at' => '2025-09-16 22:31:11'
            ],
            [
                'id' => 76, 'type' => 'admin_document_expiring_soon', 'title' => 'تنبيه وثيقة ستنتهي قريباً',
                'message' => 'الوثيقة "VAT Registration" لـ "Rojas Bean Trading" ستنتهي خلال 0 أيام في 2025-09-17.',
                'data' => '{"document_id": 2, "entity_name": "Rojas Bean Trading", "expiry_date": "2025-09-17", "document_type": "VAT Registration", "days_until_expiry": 0, "document_category": "company"}',
                'user_id' => 22, 'created_by' => null, 'is_read' => 0, 'read_at' => null,
                'created_at' => '2025-09-16 22:31:11', 'updated_at' => '2025-09-16 22:31:11'
            ],
            [
                'id' => 77, 'type' => 'admin_document_expiring_soon', 'title' => 'تنبيه وثيقة ستنتهي قريباً',
                'message' => 'الوثيقة "Commercial Registration" لـ "Hubbard Dotson Plc" ستنتهي خلال 0 أيام في 2025-09-17.',
                'data' => '{"document_id": 4, "entity_name": "Hubbard Dotson Plc", "expiry_date": "2025-09-17", "document_type": "Commercial Registration", "days_until_expiry": 0, "document_category": "company"}',
                'user_id' => 22, 'created_by' => null, 'is_read' => 0, 'read_at' => null,
                'created_at' => '2025-09-16 22:31:11', 'updated_at' => '2025-09-16 22:31:11'
            ],
            [
                'id' => 78, 'type' => 'admin_document_expiring_soon', 'title' => 'تنبيه وثيقة ستنتهي قريباً',
                'message' => 'الوثيقة "National ID" لـ "Yetta Lyons (Hubbard Dotson Plc)" ستنتهي خلال 1 أيام في 2025-09-19.',
                'data' => '{"document_id": 2, "entity_name": "Yetta Lyons (Hubbard Dotson Plc)", "expiry_date": "2025-09-19", "document_type": "National ID", "days_until_expiry": 1, "document_category": "employee"}',
                'user_id' => 22, 'created_by' => null, 'is_read' => 0, 'read_at' => null,
                'created_at' => '2025-09-16 22:31:11', 'updated_at' => '2025-09-16 22:31:11'
            ],
            [
                'id' => 79, 'type' => 'expiring_documents_summary', 'title' => 'ملخص الوثائق المنتهية الصلاحية',
                'message' => 'يوجد 4 وثيقة ستنتهي خلال 30 أيام القادمة. وثائق الموظفين: 1، وثائق الشركات: 3.',
                'data' => '{"days_ahead": 30, "total_expiring": 4, "company_documents": 3, "employee_documents": 1}',
                'user_id' => 22, 'created_by' => null, 'is_read' => 0, 'read_at' => null,
                'created_at' => '2025-09-16 22:31:11', 'updated_at' => '2025-09-16 22:31:11'
            ],
            [
                'id' => 100, 'type' => 'document_expiring_soon', 'title' => 'وثيقة ستنتهي قريباً',
                'message' => 'الوثيقة "GOSI Registration" ستنتهي خلال 1 أيام في 2025-09-19. يرجى اتخاذ الإجراءات اللازمة.',
                'data' => '{"document_id": 1, "expiry_date": "2025-09-19", "document_type": "GOSI Registration", "days_until_expiry": 1, "document_category": "employee"}',
                'user_id' => 44, 'created_by' => null, 'is_read' => 0, 'read_at' => null,
                'created_at' => '2025-09-16 22:31:11', 'updated_at' => '2025-09-16 22:31:11'
            ],
            [
                'id' => 126, 'type' => 'document_expiring_soon', 'title' => 'وثيقة ستنتهي قريباً',
                'message' => 'الوثيقة "GOSI Registration" ستنتهي خلال 1 أيام في 2025-09-19. يرجى اتخاذ الإجراءات اللازمة.',
                'data' => '{"document_id": 1, "expiry_date": "2025-09-19", "document_type": "GOSI Registration", "days_until_expiry": 1, "document_category": "employee"}',
                'user_id' => 44, 'created_by' => null, 'is_read' => 0, 'read_at' => null,
                'created_at' => '2025-09-16 22:42:50', 'updated_at' => '2025-09-16 22:42:50'
            ],
        ];

        foreach ($notifications as $notification) {
            DB::table('notifications')->updateOrInsert(
                ['id' => $notification['id']],
                $notification
            );
        }
    }
}

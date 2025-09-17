<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Seeding Tasks and Related Data...');

        // Seed tasks
        $this->seedTasks();
        
        // Seed task documents
        $this->seedTaskDocuments();
        
        // Seed task histories
        $this->seedTaskHistories();

        $this->command->info('Tasks and Related Data seeded successfully!');
    }

    private function seedTasks()
    {
        $tasks = [
            [
                'id' => 14, 'title' => 'وثائق شركه سعودية', 'description' => 'عليك بتجديد هذه الوثائق فى اسرع وقت',
                'assigned_to' => 44, 'status' => 'in_progress', 'due_date' => '2025-09-14',
                'created_by' => 43, 'created_at' => '2025-09-12 23:33:44', 'updated_at' => '2025-09-12 23:49:27'
            ],
        ];

        foreach ($tasks as $task) {
            DB::table('tasks')->updateOrInsert(
                ['id' => $task['id']],
                $task
            );
        }
    }

    private function seedTaskDocuments()
    {
        $taskDocuments = [
            [
                'id' => 14, 'task_id' => 14, 'document_type' => 'company_document', 'document_id' => 1,
                'created_at' => '2025-09-16 20:55:35', 'updated_at' => '2025-09-16 20:55:35'
            ],
            [
                'id' => 15, 'task_id' => 14, 'document_type' => 'employee_document', 'document_id' => 1,
                'created_at' => '2025-09-16 20:55:35', 'updated_at' => '2025-09-16 20:55:35'
            ],
            [
                'id' => 16, 'task_id' => 14, 'document_type' => 'civil_defense', 'document_id' => 1,
                'created_at' => '2025-09-16 20:55:35', 'updated_at' => '2025-09-16 20:55:35'
            ],
            [
                'id' => 17, 'task_id' => 14, 'document_type' => 'branch_registration', 'document_id' => 1,
                'created_at' => '2025-09-16 20:55:35', 'updated_at' => '2025-09-16 20:55:35'
            ],
            [
                'id' => 18, 'task_id' => 14, 'document_type' => 'municipality', 'document_id' => 1,
                'created_at' => '2025-09-16 20:55:35', 'updated_at' => '2025-09-16 20:55:35'
            ],
        ];

        foreach ($taskDocuments as $taskDocument) {
            DB::table('task_documents')->updateOrInsert(
                ['id' => $taskDocument['id']],
                $taskDocument
            );
        }
    }

    private function seedTaskHistories()
    {
        $taskHistories = [
            [
                'id' => 41, 'task_id' => 14, 'action' => 'created', 'old_value' => null,
                'new_value' => '{"title": "asddsadfdf", "status": "new", "due_date": "2025-09-13", "assigned_to": "موظف وثائق", "client_name": "Hubbard Dotson Plc", "description": "asdfasdsf", "documents_count": 2}',
                'changed_by' => 43, 'created_at' => '2025-09-12 23:33:44', 'updated_at' => '2025-09-12 23:33:44'
            ],
            [
                'id' => 42, 'task_id' => 14, 'action' => 'updated', 'old_value' => '{"due_date": "2025-09-13T00:00:00.000000Z"}',
                'new_value' => '{"due_date": "2025-09-14T00:00:00.000000Z"}',
                'changed_by' => 43, 'created_at' => '2025-09-12 23:35:59', 'updated_at' => '2025-09-12 23:35:59'
            ],
            [
                'id' => 43, 'task_id' => 14, 'action' => 'updated', 'old_value' => '{"title": "asddsadfdf", "description": "asdfasdsf"}',
                'new_value' => '{"title": "وثائق شركه سعودية", "description": "عليك بتجديد هذه الوثائق فى اسرع وقت"}',
                'changed_by' => 43, 'created_at' => '2025-09-12 23:37:30', 'updated_at' => '2025-09-12 23:37:30'
            ],
            [
                'id' => 44, 'task_id' => 14, 'action' => 'updated', 'old_value' => '{"status": "new"}',
                'new_value' => '{"status": "in_progress"}',
                'changed_by' => 44, 'created_at' => '2025-09-12 23:49:27', 'updated_at' => '2025-09-12 23:49:27'
            ],
            [
                'id' => 45, 'task_id' => 14, 'action' => 'status_changed', 'old_value' => '{"status": "new"}',
                'new_value' => '{"status": "in_progress"}',
                'changed_by' => 44, 'created_at' => '2025-09-12 23:49:27', 'updated_at' => '2025-09-12 23:49:27'
            ],
        ];

        foreach ($taskHistories as $taskHistory) {
            DB::table('task_histories')->updateOrInsert(
                ['id' => $taskHistory['id']],
                $taskHistory
            );
        }
    }
}

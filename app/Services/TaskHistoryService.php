<?php

namespace App\Services;

use App\Models\Task;
use App\Models\TaskHistory;
use Illuminate\Database\Eloquent\Model;

class TaskHistoryService
{
    /**
     * Log task creation
     */
    public static function logCreated(Task $task, int $changedBy): void
    {
        TaskHistory::create([
            'task_id' => $task->id,
            'action' => TaskHistory::ACTION_CREATED,
            'old_value' => null,
            'new_value' => [
                'title' => $task->title,
                'description' => $task->description,
                'status' => $task->status,
                'assigned_to' => $task->assignedUser?->name ?? 'Unknown User',
                'client_name' => $task->getClientName(),
                'due_date' => $task->due_date?->format('Y-m-d'),
                'documents_count' => $task->taskDocuments()->count(),
            ],
            'changed_by' => $changedBy,
        ]);
    }

    /**
     * Log task update
     */
    public static function logUpdated(Task $task, array $oldData, int $changedBy): void
    {
        $changes = [];
        $oldValues = [];
        $newValues = [];

        foreach ($oldData as $field => $oldValue) {
            if ($task->$field != $oldValue) {
                $changes[$field] = [
                    'old' => $oldValue,
                    'new' => $task->$field,
                ];
                $oldValues[$field] = $oldValue;
                $newValues[$field] = $task->$field;
            }
        }

        if (!empty($changes)) {
            TaskHistory::create([
                'task_id' => $task->id,
                'action' => TaskHistory::ACTION_UPDATED,
                'old_value' => $oldValues,
                'new_value' => $newValues,
                'changed_by' => $changedBy,
            ]);
        }
    }

    /**
     * Log status change specifically
     */
    public static function logStatusChanged(Task $task, string $oldStatus, int $changedBy): void
    {
        TaskHistory::create([
            'task_id' => $task->id,
            'action' => TaskHistory::ACTION_STATUS_CHANGED,
            'old_value' => ['status' => $oldStatus],
            'new_value' => ['status' => $task->status],
            'changed_by' => $changedBy,
        ]);
    }

    /**
     * Log note addition
     */
    public static function logNoteAdded(Task $task, string $note, int $changedBy): void
    {
        TaskHistory::create([
            'task_id' => $task->id,
            'action' => TaskHistory::ACTION_NOTE_ADDED,
            'old_value' => null,
            'new_value' => ['note' => $note],
            'changed_by' => $changedBy,
        ]);
    }

    /**
     * Log task deletion
     */
    public static function logDeleted(Task $task, int $changedBy): void
    {
        TaskHistory::create([
            'task_id' => $task->id,
            'action' => 'deleted',
            'old_value' => [
                'title' => $task->title,
                'description' => $task->description,
                'status' => $task->status,
                'assigned_to' => $task->assignedUser?->name ?? 'Unknown User',
                'client_name' => $task->getClientName(),
                'due_date' => $task->due_date?->format('Y-m-d'),
                'documents_count' => $task->taskDocuments()->count(),
            ],
            'new_value' => null,
            'changed_by' => $changedBy,
        ]);
    }

    /**
     * Get old data for comparison
     */
    public static function getOldData(Task $task): array
    {
        // Get fresh data from database to avoid race conditions
        $fresh = $task->fresh();
        
        return [
            'title' => $fresh->title,
            'description' => $fresh->description,
            'assigned_to' => $fresh->assigned_to,
            'status' => $fresh->status,
            'due_date' => $fresh->due_date,
        ];
    }
}

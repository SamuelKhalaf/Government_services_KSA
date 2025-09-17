<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class NotificationService
{
    /**
     * Send notification for task creation
     */
    public static function notifyTaskCreated(Task $task, int $createdBy): void
    {
        // Notify the assigned user
        if ($task->assigned_to && $task->assigned_to !== $createdBy) {
            self::createNotification(
                $task->assigned_to,
                $createdBy,
                Notification::TYPE_TASK_CREATED,
                __('notifications.task_created_title'),
                __('notifications.task_created_message', ['title' => $task->title]),
                [
                    'task_id' => $task->id,
                    'task_title' => $task->title,
                    'assigned_by' => User::find($createdBy)?->name,
                ]
            );
        }
    }

    /**
     * Send notification for task assignment
     */
    public static function notifyTaskAssigned(Task $task, int $assignedTo, int $assignedBy): void
    {
        if ($assignedTo !== $assignedBy) {
            $assignedByUser = User::find($assignedBy);
            $assignedByName = $assignedByUser ? $assignedByUser->name : 'System';
            
            self::createNotification(
                $assignedTo,
                $assignedBy,
                Notification::TYPE_TASK_ASSIGNED,
                __('notifications.task_assigned_title'),
                str_replace(
                    ['{title}', '{assigned_by}'],
                    [$task->title, $assignedByName],
                    __('notifications.task_assigned_message')
                ),
                [
                    'task_id' => $task->id,
                    'task_title' => $task->title,
                    'assigned_by' => $assignedByName,
                ]
            );
        }
    }

    /**
     * Send notification for task status change
     */
    public static function notifyTaskStatusChanged(Task $task, string $oldStatus, string $newStatus, int $changedBy): void
    {
        $statuses = Task::getStatuses();
        $oldStatusName = $statuses[$oldStatus] ?? $oldStatus;
        $newStatusName = $statuses[$newStatus] ?? $newStatus;
        $changedByUser = User::find($changedBy);
        $changedByName = $changedByUser ? $changedByUser->name : 'System';

        // Notify the assigned user
        if ($task->assigned_to && $task->assigned_to !== $changedBy) {
            self::createNotification(
                $task->assigned_to,
                $changedBy,
                Notification::TYPE_TASK_STATUS_CHANGED,
                __('notifications.task_status_changed_title'),
                str_replace(
                    ['{title}', '{old_status}', '{new_status}', '{changed_by}'],
                    [$task->title, $oldStatusName, $newStatusName, $changedByName],
                    __('notifications.task_status_changed_message')
                ),
                [
                    'task_id' => $task->id,
                    'task_title' => $task->title,
                    'old_status' => $oldStatus,
                    'new_status' => $newStatus,
                    'old_status_name' => $oldStatusName,
                    'new_status_name' => $newStatusName,
                    'changed_by' => $changedByName,
                ]
            );
        }

        // Notify the creator if different from assigned user and changed by
        if ($task->created_by && $task->created_by !== $task->assigned_to && $task->created_by !== $changedBy) {
            self::createNotification(
                $task->created_by,
                $changedBy,
                Notification::TYPE_TASK_STATUS_CHANGED,
                __('notifications.task_status_changed_title'),
                str_replace(
                    ['{title}', '{old_status}', '{new_status}', '{changed_by}'],
                    [$task->title, $oldStatusName, $newStatusName, $changedByName],
                    __('notifications.task_status_changed_message')
                ),
                [
                    'task_id' => $task->id,
                    'task_title' => $task->title,
                    'old_status' => $oldStatus,
                    'new_status' => $newStatus,
                    'old_status_name' => $oldStatusName,
                    'new_status_name' => $newStatusName,
                    'changed_by' => $changedByName,
                ]
            );
        }
    }

    /**
     * Send notification for task update
     */
    public static function notifyTaskUpdated(Task $task, int $updatedBy): void
    {
        // Notify the assigned user
        if ($task->assigned_to && $task->assigned_to !== $updatedBy) {
            self::createNotification(
                $task->assigned_to,
                $updatedBy,
                Notification::TYPE_TASK_UPDATED,
                __('notifications.task_updated_title'),
                __('notifications.task_updated_message', [
                    'title' => $task->title,
                    'updated_by' => User::find($updatedBy)?->name
                ]),
                [
                    'task_id' => $task->id,
                    'task_title' => $task->title,
                    'updated_by' => User::find($updatedBy)?->name,
                ]
            );
        }
    }

    /**
     * Send notification for task due soon
     */
    public static function notifyTaskDueSoon(Task $task): void
    {
        if ($task->assigned_to) {
            self::createNotification(
                $task->assigned_to,
                null,
                Notification::TYPE_TASK_DUE_SOON,
                __('notifications.task_due_soon_title'),
                __('notifications.task_due_soon_message', [
                    'title' => $task->title,
                    'due_date' => $task->due_date->format('Y-m-d')
                ]),
                [
                    'task_id' => $task->id,
                    'task_title' => $task->title,
                    'due_date' => $task->due_date->toDateString(),
                ]
            );
        }
    }

    /**
     * Send notification for overdue task
     */
    public static function notifyTaskOverdue(Task $task): void
    {
        if ($task->assigned_to) {
            self::createNotification(
                $task->assigned_to,
                null,
                Notification::TYPE_TASK_OVERDUE,
                __('notifications.task_overdue_title'),
                __('notifications.task_overdue_message', [
                    'title' => $task->title,
                    'due_date' => $task->due_date->format('Y-m-d')
                ]),
                [
                    'task_id' => $task->id,
                    'task_title' => $task->title,
                    'due_date' => $task->due_date->toDateString(),
                ]
            );
        }
    }

    /**
     * Create a notification
     */
    private static function createNotification(
        int $userId,
        ?int $createdBy,
        string $type,
        string $title,
        string $message,
        array $data = []
    ): void {
        try {
            Notification::create([
                'type' => $type,
                'title' => $title,
                'message' => $message,
                'data' => $data,
                'user_id' => $userId,
                'created_by' => $createdBy,
            ]);
        } catch (\Exception $e) {
            // Log error but don't break the main flow
            \Log::error('Failed to create notification: ' . $e->getMessage(), [
                'user_id' => $userId,
                'type' => $type,
                'title' => $title,
            ]);
        }
    }

    /**
     * Mark all notifications as read for a user
     */
    public static function markAllAsRead(int $userId): int
    {
        return Notification::forUser($userId)
            ->unread()
            ->update([
                'is_read' => true,
                'read_at' => now(),
            ]);
    }

    /**
     * Mark a specific notification as read
     */
    public static function markAsRead(int $notificationId, int $userId): bool
    {
        $notification = Notification::where('id', $notificationId)
            ->where('user_id', $userId)
            ->first();

        if ($notification) {
            return $notification->markAsRead();
        }

        return false;
    }

    /**
     * Get unread notification count for a user
     */
    public static function getUnreadCount(int $userId): int
    {
        return Notification::forUser($userId)->unread()->count();
    }

    /**
     * Get recent notifications for a user
     */
    public static function getRecentNotifications(int $userId, int $limit = 10)
    {
        return Notification::forUser($userId)
            ->with('creator')
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Send notification to employee about document expiring soon
     */
    public static function notifyDocumentExpiringSoon($document, int $userId, int $daysUntilExpiry): void
    {
        $documentType = $document->documentType->name_en ?? 'Document';
        $expiryDate = self::getDocumentExpiryDate($document);
        
        $title = __('notifications.document_expiring_soon_title');
        $message = __('notifications.document_expiring_soon_message', [
            'document_type' => $documentType,
            'days' => $daysUntilExpiry,
            'expiry_date' => $expiryDate
        ]);

        self::createNotification(
            $userId,
            null,
            Notification::TYPE_DOCUMENT_EXPIRING_SOON,
            $title,
            $message,
            [
                'document_id' => $document->id,
                'document_type' => $documentType,
                'days_until_expiry' => $daysUntilExpiry,
                'expiry_date' => $expiryDate,
                'document_category' => 'employee'
            ]
        );
    }

    /**
     * Send notification to admin about individual document expiring soon
     */
    public static function notifyAdminDocumentExpiringSoon($document, int $adminId, int $daysUntilExpiry, string $type): void
    {
        $documentType = self::getDocumentTypeName($document);
        $expiryDate = self::getDocumentExpiryDate($document);
        $entityName = self::getEntityName($document, $type);

        $title = __('notifications.admin_document_expiring_soon_title');
        $message = __('notifications.admin_document_expiring_soon_message', [
            'document_type' => $documentType,
            'entity_name' => $entityName,
            'days' => $daysUntilExpiry,
            'expiry_date' => $expiryDate
        ]);

        self::createNotification(
            $adminId,
            null,
            Notification::TYPE_ADMIN_DOCUMENT_EXPIRING_SOON,
            $title,
            $message,
            [
                'document_id' => $document->id,
                'document_type' => $documentType,
                'entity_name' => $entityName,
                'days_until_expiry' => $daysUntilExpiry,
                'expiry_date' => $expiryDate,
                'document_category' => $type
            ]
        );
    }

    /**
     * Send summary notification to admin about all expiring documents
     */
    public static function notifyAdminExpiringDocumentsSummary(
        int $adminId, 
        int $totalExpiring, 
        int $employeeDocs, 
        int $companyDocs, 
        int $daysAhead
    ): void {
        $title = __('notifications.expiring_documents_summary_title');
        $message = __('notifications.expiring_documents_summary_message', [
            'total' => $totalExpiring,
            'employee_docs' => $employeeDocs,
            'company_docs' => $companyDocs,
            'days' => $daysAhead
        ]);

        self::createNotification(
            $adminId,
            null,
            Notification::TYPE_EXPIRING_DOCUMENTS_SUMMARY,
            $title,
            $message,
            [
                'total_expiring' => $totalExpiring,
                'employee_documents' => $employeeDocs,
                'company_documents' => $companyDocs,
                'days_ahead' => $daysAhead
            ]
        );
    }

    /**
     * Get document expiry date based on document type
     */
    private static function getDocumentExpiryDate($document): string
    {
        if (method_exists($document, 'getCustomFieldValue')) {
            // For CompanyDocument and EmployeeDocument
            $expiryDate = $document->getCustomFieldValue('expiry_date');
            return $expiryDate ? \Carbon\Carbon::parse($expiryDate)->format('Y-m-d') : 'N/A';
        } else {
            // For basic company documents
            return $document->expiry_date ? $document->expiry_date->format('Y-m-d') : 'N/A';
        }
    }

    /**
     * Get document type name based on document type
     */
    private static function getDocumentTypeName($document): string
    {
        if (method_exists($document, 'documentType')) {
            return $document->documentType->name_en ?? 'Document';
        } else {
            // For basic company documents, return class name
            $className = class_basename($document);
            return match($className) {
                'BranchCommercialRegistration' => 'Branch Commercial Registration',
                'CivilDefenseLicense' => 'Civil Defense License',
                'MunicipalityLicense' => 'Municipality License',
                default => $className
            };
        }
    }

    /**
     * Get entity name (company or employee) for the document
     */
    private static function getEntityName($document, string $type): string
    {
        switch ($type) {
            case 'employee':
                return $document->employee->full_name_en . ' (' . $document->employee->company->company_name_en . ')';
            case 'company':
            case 'branch_registration':
            case 'civil_defense':
            case 'municipality':
                return $document->company->company_name_en;
            default:
                return 'Unknown Entity';
        }
    }
}

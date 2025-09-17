<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'type',
        'title',
        'message',
        'data',
        'user_id',
        'created_by',
        'is_read',
        'read_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'data' => 'array',
        'is_read' => 'boolean',
        'read_at' => 'datetime',
    ];

    /**
     * Notification type constants
     */
    const TYPE_TASK_CREATED = 'task_created';
    const TYPE_TASK_ASSIGNED = 'task_assigned';
    const TYPE_TASK_STATUS_CHANGED = 'task_status_changed';
    const TYPE_TASK_UPDATED = 'task_updated';
    const TYPE_TASK_DUE_SOON = 'task_due_soon';
    const TYPE_TASK_OVERDUE = 'task_overdue';
    
    // Document expiration notification types
    const TYPE_DOCUMENT_EXPIRING_SOON = 'document_expiring_soon';
    const TYPE_ADMIN_DOCUMENT_EXPIRING_SOON = 'admin_document_expiring_soon';
    const TYPE_EXPIRING_DOCUMENTS_SUMMARY = 'expiring_documents_summary';

    /**
     * Get all available notification types
     */
    public static function getTypes(): array
    {
        return [
            self::TYPE_TASK_CREATED => __('notifications.task_created'),
            self::TYPE_TASK_ASSIGNED => __('notifications.task_assigned'),
            self::TYPE_TASK_STATUS_CHANGED => __('notifications.task_status_changed'),
            self::TYPE_TASK_UPDATED => __('notifications.task_updated'),
            self::TYPE_TASK_DUE_SOON => __('notifications.task_due_soon'),
            self::TYPE_TASK_OVERDUE => __('notifications.task_overdue'),
            self::TYPE_DOCUMENT_EXPIRING_SOON => __('notifications.document_expiring_soon'),
            self::TYPE_ADMIN_DOCUMENT_EXPIRING_SOON => __('notifications.admin_document_expiring_soon'),
            self::TYPE_EXPIRING_DOCUMENTS_SUMMARY => __('notifications.expiring_documents_summary'),
        ];
    }

    /**
     * Get the user who receives the notification
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the user who created the notification
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the task associated with this notification
     */
    public function task()
    {
        if ($this->data && isset($this->data['task_id'])) {
            return Task::find($this->data['task_id']);
        }
        return null;
    }

    /**
     * Mark notification as read
     */
    public function markAsRead(): bool
    {
        if (!$this->is_read) {
            $this->update([
                'is_read' => true,
                'read_at' => now(),
            ]);
            return true;
        }
        return false;
    }

    /**
     * Mark notification as unread
     */
    public function markAsUnread(): bool
    {
        if ($this->is_read) {
            $this->update([
                'is_read' => false,
                'read_at' => null,
            ]);
            return true;
        }
        return false;
    }

    /**
     * Get notification icon based on type
     */
    public function getIcon(): string
    {
        return match($this->type) {
            self::TYPE_TASK_CREATED => 'fas fa-plus-circle',
            self::TYPE_TASK_ASSIGNED => 'fas fa-user-plus',
            self::TYPE_TASK_STATUS_CHANGED => 'fas fa-arrows-rotate', // Updated for FA6
            self::TYPE_TASK_UPDATED => 'fas fa-pen-to-square', // Updated for FA6
            self::TYPE_TASK_DUE_SOON => 'fas fa-clock',
            self::TYPE_TASK_OVERDUE => 'fas fa-triangle-exclamation', // Updated for FA6
            self::TYPE_DOCUMENT_EXPIRING_SOON => 'fas fa-file-circle-exclamation', // Updated for FA6
            self::TYPE_ADMIN_DOCUMENT_EXPIRING_SOON => 'fas fa-file-circle-exclamation', // Updated for FA6
            self::TYPE_EXPIRING_DOCUMENTS_SUMMARY => 'fas fa-list', // Updated for FA6
            default => 'fas fa-bell',
        };
    }

    /**
     * Get notification color based on type
     */
    public function getColor(): string
    {
        return match($this->type) {
            self::TYPE_TASK_CREATED => 'success',
            self::TYPE_TASK_ASSIGNED => 'primary',
            self::TYPE_TASK_STATUS_CHANGED => 'warning',
            self::TYPE_TASK_UPDATED => 'info',
            self::TYPE_TASK_DUE_SOON => 'warning',
            self::TYPE_TASK_OVERDUE => 'danger',
            self::TYPE_DOCUMENT_EXPIRING_SOON => 'warning',
            self::TYPE_ADMIN_DOCUMENT_EXPIRING_SOON => 'warning',
            self::TYPE_EXPIRING_DOCUMENTS_SUMMARY => 'info',
            default => 'secondary',
        };
    }

    /**
     * Scope for unread notifications
     */
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    /**
     * Scope for read notifications
     */
    public function scopeRead($query)
    {
        return $query->where('is_read', true);
    }

    /**
     * Scope for recent notifications
     */
    public function scopeRecent($query, $days = 7)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }

    /**
     * Scope for specific user
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Scope for specific type
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }
}

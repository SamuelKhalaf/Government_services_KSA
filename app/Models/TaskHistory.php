<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TaskHistory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'task_id',
        'action',
        'old_value',
        'new_value',
        'changed_by',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'old_value' => 'array',
        'new_value' => 'array',
    ];

    /**
     * Task history action constants
     */
    const ACTION_CREATED = 'created';
    const ACTION_UPDATED = 'updated';
    const ACTION_STATUS_CHANGED = 'status_changed';
    const ACTION_NOTE_ADDED = 'note_added';

    /**
     * Get all available task history actions
     */
    public static function getActions(): array
    {
        return [
            self::ACTION_CREATED => __('tasks.created'),
            self::ACTION_UPDATED => __('tasks.updated'),
            self::ACTION_STATUS_CHANGED => __('tasks.status_changed'),
            self::ACTION_NOTE_ADDED => __('tasks.note_added'),
        ];
    }

    /**
     * Get the task that owns the history
     */
    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }

    /**
     * Get the user who made the change
     */
    public function changedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'changed_by');
    }

    /**
     * Get formatted old value for display
     */
    public function getFormattedOldValue(): string
    {
        if (!$this->old_value) {
            return 'N/A';
        }

        return $this->formatValue($this->old_value);
    }

    /**
     * Get formatted new value for display
     */
    public function getFormattedNewValue(): string
    {
        if (!$this->new_value) {
            return 'N/A';
        }

        return $this->formatValue($this->new_value);
    }

    /**
     * Format value for display based on action type
     */
    private function formatValue($value): string
    {
        if (!is_array($value)) {
            return (string) $value;
        }

        switch ($this->action) {
            case self::ACTION_CREATED:
                return $this->formatCreatedValue($value);
            case self::ACTION_UPDATED:
                return $this->formatUpdatedValue($value);
            case self::ACTION_STATUS_CHANGED:
                return $this->formatStatusValue($value);
            case self::ACTION_NOTE_ADDED:
                return $this->formatNoteValue($value);
            default:
                return json_encode($value, JSON_PRETTY_PRINT);
        }
    }

    /**
     * Format created value for display
     */
    private function formatCreatedValue($value): string
    {
        $formatted = [];
        
        if (isset($value['title'])) {
            $formatted[] = __('tasks.title') . ': ' . $value['title'];
        }
        if (isset($value['status'])) {
            $statuses = (new Task())->getStatuses();
            $formatted[] = __('tasks.status') . ': ' . ($statuses[$value['status']] ?? $value['status']);
        }
        if (isset($value['due_date'])) {
            $formatted[] = __('tasks.due_date') . ': ' . $value['due_date'];
        }
        if (isset($value['assigned_to'])) {
            $userName = $this->getUserNameById($value['assigned_to']);
            $formatted[] = __('tasks.assigned_to') . ': ' . $userName;
        }
        if (isset($value['description'])) {
            $formatted[] = __('tasks.description') . ': ' . $value['description'];
        }

        return implode('<br>', $formatted);
    }

    /**
     * Format updated value for display
     */
    private function formatUpdatedValue($value): string
    {
        $formatted = [];
        
        foreach ($value as $key => $val) {
            switch ($key) {
                case 'status':
                    $statuses = (new Task())->getStatuses();
                    $formatted[] = __('tasks.status') . ': ' . ($statuses[$val] ?? $val);
                    break;
                case 'assigned_to':
                    $userName = $this->getUserNameById($val);
                    $formatted[] = __('tasks.assigned_to') . ': ' . $userName;
                    break;
                case 'title':
                    $formatted[] = __('tasks.title') . ': ' . $val;
                    break;
                case 'description':
                    $formatted[] = __('tasks.description') . ': ' . $val;
                    break;
                case 'due_date':
                    $formatted[] = __('tasks.due_date') . ': ' . $val;
                    break;
                default:
                    $formatted[] = ucfirst($key) . ': ' . $val;
            }
        }

        return implode('<br>', $formatted);
    }

    /**
     * Format status value for display
     */
    private function formatStatusValue($value): string
    {
        if (isset($value['status'])) {
            $statuses = (new Task())->getStatuses();
            return $statuses[$value['status']] ?? $value['status'];
        }
        return json_encode($value, JSON_PRETTY_PRINT);
    }

    /**
     * Format note value for display
     */
    private function formatNoteValue($value): string
    {
        if (isset($value['note'])) {
            return $value['note'];
        }
        return json_encode($value, JSON_PRETTY_PRINT);
    }

    /**
     * Get action description for display
     */
    public function getActionDescription(): string
    {
        return self::getActions()[$this->action] ?? $this->action;
    }

    /**
     * Get action icon for UI
     */
    public function getActionIcon(): string
    {
        return match ($this->action) {
            self::ACTION_CREATED => 'fas fa-plus-circle',
            self::ACTION_UPDATED => 'fas fa-edit',
            self::ACTION_STATUS_CHANGED => 'fas fa-exchange-alt',
            self::ACTION_NOTE_ADDED => 'fas fa-sticky-note',
            default => 'fas fa-info-circle',
        };
    }

    /**
     * Get action color for UI display
     */
    public function getActionColor(): string
    {
        return match($this->action) {
            self::ACTION_CREATED => 'success',
            self::ACTION_UPDATED => 'primary',
            self::ACTION_STATUS_CHANGED => 'warning',
            self::ACTION_NOTE_ADDED => 'info',
            default => 'secondary',
        };
    }

    /**
     * Scope to filter by action
     */
    public function scopeByAction($query, $action)
    {
        return $query->where('action', $action);
    }

    /**
     * Scope to filter by user who made the change
     */
    public function scopeByChangedBy($query, $userId)
    {
        return $query->where('changed_by', $userId);
    }

    /**
     * Scope to get recent changes
     */
    public function scopeRecent($query, $days = 7)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }

    /**
     * Get user name by ID or name
     */
    private function getUserNameById($userId): string
    {
        if (!$userId) {
            return 'N/A';
        }

        // If it's already a name (string), return it directly
        if (is_string($userId) && !is_numeric($userId)) {
            return $userId;
        }

        // If it's a numeric ID, try to find the user
        try {
            $user = \App\Models\User::find($userId);
            return $user ? $user->name : "User ID: {$userId}";
        } catch (\Exception $e) {
            return "User ID: {$userId}";
        }
    }
}

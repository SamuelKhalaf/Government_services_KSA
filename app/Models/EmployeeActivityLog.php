<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class EmployeeActivityLog extends Model
{
    use HasFactory;

    protected $table = 'employee_activity_logs';

    protected $fillable = [
        'user_id',
        'action_type',
        'model_type',
        'model_id',
        'description',
        'old_values',
        'new_values',
        'ip_address',
        'user_agent',
        'url',
    ];

    protected $casts = [
        'old_values' => 'array',
        'new_values' => 'array',
    ];

    /**
     * Get the user that performed the activity
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the model that was affected
     */
    public function model(): MorphTo
    {
        return $this->morphTo('model', 'model_type', 'model_id');
    }

    /**
     * Scope to filter by action type
     */
    public function scopeActionType($query, $actionType)
    {
        return $query->where('action_type', $actionType);
    }

    /**
     * Scope to filter by model type
     */
    public function scopeModelType($query, $modelType)
    {
        return $query->where('model_type', $modelType);
    }

    /**
     * Scope to filter by date range
     */
    public function scopeDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('created_at', [$startDate, $endDate]);
    }

    /**
     * Get action type display name
     */
    public function getActionDisplayName(): string
    {
        return match($this->action_type) {
            'create' => 'Created',
            'update' => 'Updated',
            'delete' => 'Deleted',
            'view' => 'Viewed',
            'download' => 'Downloaded',
            'upload' => 'Uploaded',
            default => ucfirst($this->action_type),
        };
    }

    /**
     * Get model type display name
     */
    public function getModelDisplayName(): string
    {
        return match($this->model_type) {
            'App\\Models\\Company' => 'Company',
            'App\\Models\\Employee' => 'Employee',
            'App\\Models\\Task' => 'Task',
            'App\\Models\\CompanyDocument' => 'Company Document',
            'App\\Models\\EmployeeDocument' => 'Employee Document',
            'App\\Models\\TaskDocument' => 'Task Document',
            default => class_basename($this->model_type),
        };
    }
}
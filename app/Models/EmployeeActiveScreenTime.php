<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmployeeActiveScreenTime extends Model
{
    use HasFactory;

    protected $table = 'employee_active_screen_time';

    protected $fillable = [
        'user_id',
        'date',
        'session_start',
        'session_end',
        'total_seconds',
        'idle_seconds',
        'click_count',
        'keypress_count',
        'scroll_count',
        'activity_breaks',
    ];

    protected $casts = [
        'date' => 'date',
        'session_start' => 'datetime',
        'session_end' => 'datetime',
        'activity_breaks' => 'array',
    ];

    /**
     * Get the user that owns the screen time record
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope to filter by date range
     */
    public function scopeDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('date', [$startDate, $endDate]);
    }

    /**
     * Scope to filter by specific date
     */
    public function scopeOnDate($query, $date)
    {
        return $query->where('date', $date);
    }

    /**
     * Get total active time in hours
     */
    public function getTotalHoursAttribute(): float
    {
        return round($this->total_seconds / 3600, 2);
    }

    /**
     * Get total idle time in hours
     */
    public function getIdleHoursAttribute(): float
    {
        return round($this->idle_seconds / 3600, 2);
    }

    /**
     * Get productivity percentage
     */
    public function getProductivityPercentageAttribute(): float
    {
        $totalTime = $this->total_seconds + $this->idle_seconds;
        if ($totalTime === 0) {
            return 0;
        }
        return round(($this->total_seconds / $totalTime) * 100, 2);
    }

    /**
     * Check if session is currently active
     */
    public function isActive(): bool
    {
        return $this->session_end === null;
    }

    /**
     * Get formatted duration
     */
    public function getFormattedDuration(): string
    {
        $hours = floor($this->total_seconds / 3600);
        $minutes = floor(($this->total_seconds % 3600) / 60);
        $seconds = $this->total_seconds % 60;

        return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
    }
}
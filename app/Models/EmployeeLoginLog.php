<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmployeeLoginLog extends Model
{
    use HasFactory;

    protected $table = 'employee_login_logs';

    protected $fillable = [
        'user_id',
        'login_at',
        'logout_at',
        'ip_address',
        'user_agent',
        'session_id',
        'status',
        'duration_minutes',
    ];

    protected $casts = [
        'login_at' => 'datetime',
        'logout_at' => 'datetime',
    ];

    /**
     * Get the user that owns the login log
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope to filter by active sessions
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope to filter by logged out sessions
     */
    public function scopeLoggedOut($query)
    {
        return $query->where('status', 'logged_out');
    }

    /**
     * Scope to filter by date range
     */
    public function scopeDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('login_at', [$startDate, $endDate]);
    }

    /**
     * Calculate duration in minutes
     */
    public function calculateDuration(): ?int
    {
        if ($this->logout_at && $this->login_at) {
            return $this->login_at->diffInMinutes($this->logout_at);
        }
        return null;
    }

    /**
     * Check if session is currently active
     */
    public function isActive(): bool
    {
        return $this->status === 'active' && $this->logout_at === null;
    }
}
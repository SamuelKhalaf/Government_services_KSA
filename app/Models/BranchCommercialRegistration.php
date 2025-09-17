<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BranchCommercialRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'branch_reg_number',
        'parent_cr_number',
        'branch_type',
        'authorized_capital',
        'manager_name',
        'manager_id_number',
        'manager_nationality',
        'manager_position',
        'branch_activity',
        'registration_date',
        'legal_form',
        'issuing_authority',
        'issue_date',
        'expiry_date',
        'activities_list',
        'notes',
        'certificate_file_path',
        'status',
        'enable_reminder',
        'reminder_days'
    ];

    protected $casts = [
        'registration_date' => 'date',
        'issue_date' => 'date',
        'expiry_date' => 'date',
        'authorized_capital' => 'decimal:2',
        'enable_reminder' => 'boolean'
    ];

    /**
     * Get the company that owns the registration
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Get the task documents related to this registration
     */
    public function taskDocuments(): HasMany
    {
        return $this->hasMany(TaskDocument::class, 'document_id')->where('document_type', TaskDocument::TYPE_BRANCH_REGISTRATION);
    }

    /**
     * Check if registration is expired
     */
    public function getIsExpiredAttribute()
    {
        return $this->expiry_date < now();
    }

    /**
     * Check if registration is expiring soon (within 30 days)
     */
    public function getIsExpiringSoonAttribute()
    {
        $thirtyDaysFromNow = now()->addDays(30);
        return $this->expiry_date <= $thirtyDaysFromNow && $this->expiry_date >= now();
    }

    /**
     * Check if registration needs reminder based on its reminder_days setting
     */
    public function getNeedsReminderAttribute()
    {
        if (!$this->enable_reminder || !$this->reminder_days) {
            return false;
        }
        
        $daysUntilExpiry = now()->diffInDays($this->expiry_date, false);
        return $daysUntilExpiry <= $this->reminder_days && $daysUntilExpiry >= 0;
    }

    /**
     * Scope for active registrations
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope for expired registrations
     */
    public function scopeExpired($query)
    {
        return $query->where('expiry_date', '<', now());
    }

    /**
     * Scope for expiring soon registrations
     */
    public function scopeExpiringSoon($query, $days = 30)
    {
        $expiryDate = now()->addDays($days);
        return $query->where('expiry_date', '<=', $expiryDate)
                    ->where('expiry_date', '>=', now());
    }

    /**
     * Scope for specific branch type
     */
    public function scopeByBranchType($query, $type)
    {
        return $query->where('branch_type', $type);
    }

    /**
     * Scope for registrations needing reminder
     */
    public function scopeNeedingReminder($query)
    {
        return $query->where('enable_reminder', true)
                    ->whereNotNull('reminder_days')
                    ->whereRaw('expiry_date <= ?', [now()->addDays(30)->toDateString()])
                    ->whereRaw('expiry_date >= ?', [now()->toDateString()]);
    }
}

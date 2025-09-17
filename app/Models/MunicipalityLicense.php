<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MunicipalityLicense extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'license_number',
        'municipality_name',
        'license_type',
        'activity_desc',
        'location_code',
        'area',
        'zone_classification',
        'building_permit_number',
        'land_use_type',
        'issue_date',
        'expiry_date',
        'conditions',
        'license_fees',
        'notes',
        'certificate_file_path',
        'status',
        'enable_reminder',
        'reminder_days'
    ];

    protected $casts = [
        'issue_date' => 'date',
        'expiry_date' => 'date',
        'area' => 'decimal:2',
        'license_fees' => 'decimal:2',
        'enable_reminder' => 'boolean'
    ];

    /**
     * Get the company that owns the license
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Get the task documents related to this license
     */
    public function taskDocuments(): HasMany
    {
        return $this->hasMany(TaskDocument::class, 'document_id')->where('document_type', TaskDocument::TYPE_MUNICIPALITY);
    }

    /**
     * Check if license is expired
     */
    public function getIsExpiredAttribute()
    {
        return $this->expiry_date < now();
    }

    /**
     * Check if license is expiring soon (within 30 days)
     */
    public function getIsExpiringSoonAttribute()
    {
        $thirtyDaysFromNow = now()->addDays(30);
        return $this->expiry_date <= $thirtyDaysFromNow && $this->expiry_date >= now();
    }

    /**
     * Check if license needs reminder based on its reminder_days setting
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
     * Scope for active licenses
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope for expired licenses
     */
    public function scopeExpired($query)
    {
        return $query->where('expiry_date', '<', now());
    }

    /**
     * Scope for expiring soon licenses
     */
    public function scopeExpiringSoon($query, $days = 30)
    {
        $expiryDate = now()->addDays($days);
        return $query->where('expiry_date', '<=', $expiryDate)
                    ->where('expiry_date', '>=', now());
    }

    /**
     * Scope for specific municipality
     */
    public function scopeByMunicipality($query, $municipality)
    {
        return $query->where('municipality_name', $municipality);
    }

    /**
     * Scope for licenses needing reminder
     */
    public function scopeNeedingReminder($query)
    {
        return $query->where('enable_reminder', true)
                    ->whereNotNull('reminder_days')
                    ->whereRaw('expiry_date <= ?', [now()->addDays(30)->toDateString()])
                    ->whereRaw('expiry_date >= ?', [now()->toDateString()]);
    }
}

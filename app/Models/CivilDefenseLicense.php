<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CivilDefenseLicense extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'license_number',
        'issue_date',
        'expiry_date',
        'authority',
        'activity_classification',
        'total_area',
        'floors',
        'facility_type',
        'safety_status',
        'inspection_status',
        'last_inspection_date',
        'next_inspection_date',
        'notes',
        'certificate_file_path',
        'status'
    ];

    protected $casts = [
        'issue_date' => 'date',
        'expiry_date' => 'date',
        'last_inspection_date' => 'date',
        'next_inspection_date' => 'date',
        'total_area' => 'decimal:2'
    ];

    /**
     * Get the company that owns the license
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
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
}

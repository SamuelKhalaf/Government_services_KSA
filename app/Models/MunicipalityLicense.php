<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'status'
    ];

    protected $casts = [
        'issue_date' => 'date',
        'expiry_date' => 'date',
        'area' => 'decimal:2',
        'license_fees' => 'decimal:2'
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

    /**
     * Scope for specific municipality
     */
    public function scopeByMunicipality($query, $municipality)
    {
        return $query->where('municipality_name', $municipality);
    }
}

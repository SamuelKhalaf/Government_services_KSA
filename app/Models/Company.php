<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name_ar',
        'company_name_en',
        'cr_number',
        'establishment_number',
        'license_number',
        'tax_number',
        'company_type',
        'isic_code',
        'phone',
        'email',
        'website',
        'region',
        'city',
        'district',
        'street',
        'building_number',
        'postal_code',
        'additional_location',
        'owner_name',
        'owner_id_number',
        'owner_nationality',
        'legal_status',
        'establishment_date',
        'capital_amount',
        'status'
    ];

    protected $casts = [
        'establishment_date' => 'date',
        'capital_amount' => 'decimal:2'
    ];

    /**
     * Get all employees for this company
     */
    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }

    /**
     * Get all civil defense licenses for this company
     */
    public function civilDefenseLicenses(): HasMany
    {
        return $this->hasMany(CivilDefenseLicense::class);
    }

    /**
     * Get all municipality licenses for this company
     */
    public function municipalityLicenses(): HasMany
    {
        return $this->hasMany(MunicipalityLicense::class);
    }

    /**
     * Get all branch commercial registrations for this company
     */
    public function branchCommercialRegistrations(): HasMany
    {
        return $this->hasMany(BranchCommercialRegistration::class);
    }

    /**
     * Get active employees only
     */
    public function activeEmployees(): HasMany
    {
        return $this->employees()->where('status', 'active');
    }

    /**
     * Get all active licenses and registrations
     */
    public function getActiveDocumentsAttribute()
    {
        return [
            'civil_defense' => $this->civilDefenseLicenses()->where('status', 'active')->get(),
            'municipality' => $this->municipalityLicenses()->where('status', 'active')->get(),
            'branch_registrations' => $this->branchCommercialRegistrations()->where('status', 'active')->get(),
        ];
    }

    /**
     * Get documents expiring soon (within 30 days)
     */
    public function getExpiringSoonDocumentsAttribute()
    {
        $thirtyDaysFromNow = now()->addDays(30);
        
        return [
            'civil_defense' => $this->civilDefenseLicenses()
                ->where('status', 'active')
                ->where('expiry_date', '<=', $thirtyDaysFromNow)
                ->where('expiry_date', '>=', now())
                ->get(),
            'municipality' => $this->municipalityLicenses()
                ->where('status', 'active')
                ->where('expiry_date', '<=', $thirtyDaysFromNow)
                ->where('expiry_date', '>=', now())
                ->get(),
            'branch_registrations' => $this->branchCommercialRegistrations()
                ->where('status', 'active')
                ->where('expiry_date', '<=', $thirtyDaysFromNow)
                ->where('expiry_date', '>=', now())
                ->get(),
        ];
    }

    /**
     * Scope for active companies
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope for searching companies
     */
    public function scopeSearch($query, $term)
    {
        return $query->where(function ($q) use ($term) {
            $q->where('company_name_ar', 'like', "%{$term}%")
              ->orWhere('company_name_en', 'like', "%{$term}%")
              ->orWhere('cr_number', 'like', "%{$term}%")
              ->orWhere('tax_number', 'like', "%{$term}%");
        });
    }
}

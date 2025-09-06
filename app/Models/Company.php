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
     * Get all dynamic company documents for this company
     */
    public function companyDocuments(): HasMany
    {
        return $this->hasMany(CompanyDocument::class);
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
     * Get total documents count
     */
    public function getTotalDocumentsCountAttribute()
    {
        return $this->civilDefenseLicenses->count() + 
               $this->municipalityLicenses->count() + 
               $this->branchCommercialRegistrations->count() + 
               $this->companyDocuments->count();
    }

    /**
     * Get active documents count (not expired)
     */
    public function getActiveDocumentsCountAttribute()
    {
        $activeCivilDefense = $this->civilDefenseLicenses()
            ->where('status', 'active')
            ->where(function($query) {
                $query->whereNull('expiry_date')
                      ->orWhere('expiry_date', '>', now());
            })
            ->count();

        $activeMunicipality = $this->municipalityLicenses()
            ->where('status', 'active')
            ->where(function($query) {
                $query->whereNull('expiry_date')
                      ->orWhere('expiry_date', '>', now());
            })
            ->count();

        $activeBranchReg = $this->branchCommercialRegistrations()
            ->where('status', 'active')
            ->where(function($query) {
                $query->whereNull('expiry_date')
                      ->orWhere('expiry_date', '>', now());
            })
            ->count();

        $activeCompanyDocs = $this->companyDocuments()
            ->where('status', 'active')
            ->where(function($query) {
                $query->whereRaw("JSON_EXTRACT(custom_fields, '$.expiry_date') IS NULL")
                      ->orWhereRaw("JSON_EXTRACT(custom_fields, '$.expiry_date') > ?", [now()->toDateString()]);
            })
            ->count();

        return $activeCivilDefense + $activeMunicipality + $activeBranchReg + $activeCompanyDocs;
    }

    /**
     * Get expiring soon documents count (within 30 days)
     */
    public function getExpiringSoonDocumentsCountAttribute()
    {
        $thirtyDaysFromNow = now()->addDays(30);
        
        $expiringCivilDefense = $this->civilDefenseLicenses()
            ->where('status', 'active')
            ->whereNotNull('expiry_date')
            ->where('expiry_date', '<=', $thirtyDaysFromNow)
            ->where('expiry_date', '>=', now())
            ->count();

        $expiringMunicipality = $this->municipalityLicenses()
            ->where('status', 'active')
            ->whereNotNull('expiry_date')
            ->where('expiry_date', '<=', $thirtyDaysFromNow)
            ->where('expiry_date', '>=', now())
            ->count();

        $expiringBranchReg = $this->branchCommercialRegistrations()
            ->where('status', 'active')
            ->whereNotNull('expiry_date')
            ->where('expiry_date', '<=', $thirtyDaysFromNow)
            ->where('expiry_date', '>=', now())
            ->count();

        $expiringCompanyDocs = $this->companyDocuments()
            ->where('status', 'active')
            ->whereRaw("JSON_EXTRACT(custom_fields, '$.expiry_date') IS NOT NULL")
            ->whereRaw("JSON_EXTRACT(custom_fields, '$.expiry_date') <= ?", [$thirtyDaysFromNow->toDateString()])
            ->whereRaw("JSON_EXTRACT(custom_fields, '$.expiry_date') >= ?", [now()->toDateString()])
            ->count();

        return $expiringCivilDefense + $expiringMunicipality + $expiringBranchReg + $expiringCompanyDocs;
    }

    /**
     * Get expired documents count
     */
    public function getExpiredDocumentsCountAttribute()
    {
        $expiredCivilDefense = $this->civilDefenseLicenses()
            ->where('status', 'active')
            ->whereNotNull('expiry_date')
            ->where('expiry_date', '<', now())
            ->count();

        $expiredMunicipality = $this->municipalityLicenses()
            ->where('status', 'active')
            ->whereNotNull('expiry_date')
            ->where('expiry_date', '<', now())
            ->count();

        $expiredBranchReg = $this->branchCommercialRegistrations()
            ->where('status', 'active')
            ->whereNotNull('expiry_date')
            ->where('expiry_date', '<', now())
            ->count();

        $expiredCompanyDocs = $this->companyDocuments()
            ->where('status', 'active')
            ->whereRaw("JSON_EXTRACT(custom_fields, '$.expiry_date') IS NOT NULL")
            ->whereRaw("JSON_EXTRACT(custom_fields, '$.expiry_date') < ?", [now()->toDateString()])
            ->count();

        return $expiredCivilDefense + $expiredMunicipality + $expiredBranchReg + $expiredCompanyDocs;
    }

    /**
     * Get documents expiring soon (within 30 days) - detailed collection
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
     * Get document statistics
     */
    public function getDocumentStatistics(): array
    {
        return [
            'total_documents' => $this->total_documents_count,
            'active_documents' => $this->active_documents_count,
            'expiring_soon' => $this->expiring_soon_documents_count,
            'expired_documents' => $this->expired_documents_count,
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

    /**
     * Get compatible document types for this company
     */
    public function getCompatibleDocumentTypes()
    {
        return DocumentType::active()
            ->forCompanies()
            ->ordered()
            ->get();
    }
}

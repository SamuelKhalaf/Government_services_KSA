<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\DocumentType;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'full_name_ar',
        'full_name_en',
        'type',
        'nationality',
        'dob_hijri',
        'dob_greg',
        'pob',
        'gender',
        'marital_status',
        'religion',
        'education',
        'specialization',
        'national_id',
        'national_id_issue_date',
        'national_id_expiry_date',
        'national_id_issue_place',
        'iqama_number',
        'iqama_issue_date',
        'iqama_expiry_date',
        'border_number',
        'passport_number',
        'passport_issue_date',
        'passport_expiry_date',
        'passport_issue_place',
        'primary_mobile',
        'secondary_mobile',
        'email',
        'region',
        'city',
        'district',
        'street',
        'building_number',
        'postal_code',
        'pobox',
        'job_title',
        'hire_date',
        'contract_type',
        'basic_salary',
        'allowances',
        'gosi_number',
        'medical_insurance_number',
        'saned_number',
        'status'
    ];

    protected $casts = [
        'dob_hijri' => 'date',
        'dob_greg' => 'date',
        'national_id_issue_date' => 'date',
        'national_id_expiry_date' => 'date',
        'iqama_issue_date' => 'date',
        'iqama_expiry_date' => 'date',
        'passport_issue_date' => 'date',
        'passport_expiry_date' => 'date',
        'hire_date' => 'date',
        'basic_salary' => 'decimal:2',
        'allowances' => 'decimal:2'
    ];

    /**
     * Get the company that owns the employee
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Get all documents for this employee
     */
    public function documents(): HasMany
    {
        return $this->hasMany(EmployeeDocument::class);
    }

    /**
     * Get active documents only
     */
    public function activeDocuments(): HasMany
    {
        return $this->documents()->where('status', 'active');
    }

    /**
     * Get documents by type (by code)
     */
    public function documentsByType($typeCode): HasMany
    {
        return $this->documents()->whereHas('documentType', function ($q) use ($typeCode) {
            $q->where('code', $typeCode);
        });
    }

    /**
     * Get documents by type ID
     */
    public function documentsByTypeId($typeId): HasMany
    {
        return $this->documents()->where('document_type_id', $typeId);
    }

    /**
     * Get documents expiring soon (within 30 days)
     */
    public function getExpiringSoonDocumentsAttribute()
    {
        $thirtyDaysFromNow = now()->addDays(30);
        
        return $this->documents()
            ->where('status', 'active')
            ->whereRaw("JSON_EXTRACT(custom_fields, '$.expiry_date') <= ?", [$thirtyDaysFromNow->toDateString()])
            ->whereRaw("JSON_EXTRACT(custom_fields, '$.expiry_date') >= ?", [now()->toDateString()])
            ->get();
    }

    /**
     * Get expired documents
     */
    public function getExpiredDocumentsAttribute()
    {
        return $this->documents()
            ->whereRaw("JSON_EXTRACT(custom_fields, '$.expiry_date') < ?", [now()->toDateString()])
            ->get();
    }

    /**
     * Get active documents (not expired yet)
     */
    public function getActiveNotExpiredDocumentsAttribute()
    {
        return $this->documents()
            ->where('status', 'active')
            ->where(function($query) {
                $query->whereRaw("JSON_EXTRACT(custom_fields, '$.expiry_date') IS NULL")
                      ->orWhereRaw("JSON_EXTRACT(custom_fields, '$.expiry_date') >= ?", [now()->toDateString()]);
            })
            ->get();
    }

    /**
     * Get total salary (basic + allowances)
     */
    public function getTotalSalaryAttribute()
    {
        return $this->basic_salary + $this->allowances;
    }

    /**
     * Check if employee is Saudi or Expat
     */
    public function getIsSaudiAttribute()
    {
        return $this->type === 'saudi';
    }

    /**
     * Get main identification number based on type
     */
    public function getMainIdNumberAttribute()
    {
        return $this->type === 'saudi' ? $this->national_id : $this->iqama_number;
    }

    /**
     * Get main identification expiry date based on type
     */
    public function getMainIdExpiryAttribute()
    {
        return $this->type === 'saudi' ? $this->national_id_expiry_date : $this->iqama_expiry_date;
    }

    /**
     * Scope for active employees
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope for Saudi employees
     */
    public function scopeSaudi($query)
    {
        return $query->where('type', 'saudi');
    }

    /**
     * Scope for expat employees
     */
    public function scopeExpat($query)
    {
        return $query->where('type', 'expat');
    }

    /**
     * Scope for searching employees
     */
    public function scopeSearch($query, $term)
    {
        return $query->where(function ($q) use ($term) {
            $q->where('full_name_ar', 'like', "%{$term}%")
              ->orWhere('full_name_en', 'like', "%{$term}%")
              ->orWhere('national_id', 'like', "%{$term}%")
              ->orWhere('iqama_number', 'like', "%{$term}%")
              ->orWhere('passport_number', 'like', "%{$term}%")
              ->orWhere('primary_mobile', 'like', "%{$term}%");
        });
    }

    /**
     * Scope for employees with expiring documents
     */
    public function scopeWithExpiringDocuments($query, $days = 30)
    {
        $expiryDate = now()->addDays($days);
        
        return $query->whereHas('documents', function ($q) use ($expiryDate) {
            $q->where('status', 'active')
              ->whereRaw("JSON_EXTRACT(custom_fields, '$.expiry_date') <= ?", [$expiryDate->toDateString()])
              ->whereRaw("JSON_EXTRACT(custom_fields, '$.expiry_date') >= ?", [now()->toDateString()]);
        });
    }

    /**
     * Get compatible document types for this employee
     */
    public function getCompatibleDocumentTypes()
    {
        return DocumentType::active()
            ->forEmployees()
            ->when($this->type === 'saudi', function ($query) {
                return $query->forSaudi();
            })
            ->when($this->type === 'expat', function ($query) {
                return $query->forExpat();
            })
            ->ordered()
            ->get();
    }

    /**
     * Check if employee can have specific document type
     */
    public function canHaveDocumentType(DocumentType $documentType): bool
    {
        return $documentType->isCompatibleWithEmployee($this);
    }

    /**
     * Get documents by specific type code
     */
    public function getDocumentsByTypeCode(string $typeCode)
    {
        return $this->documents()->whereHas('documentType', function ($q) use ($typeCode) {
            $q->where('code', $typeCode);
        })->get();
    }

    /**
     * Get documents by specific type ID
     */
    public function getDocumentsByTypeId(int $typeId)
    {
        return $this->documents()->where('document_type_id', $typeId)->get();
    }

    /**
     * Check if employee has specific document type
     */
    public function hasDocumentType(string $typeCode): bool
    {
        return $this->documents()->whereHas('documentType', function ($q) use ($typeCode) {
            $q->where('code', $typeCode);
        })->exists();
    }

    /**
     * Get missing required document types
     */
    public function getMissingRequiredDocumentTypes()
    {
        $requiredTypes = DocumentType::active()
            ->forEmployees()
            ->when($this->type === 'saudi', function ($query) {
                return $query->forSaudi();
            })
            ->when($this->type === 'expat', function ($query) {
                return $query->forExpat();
            })
            ->get()
            ->filter(function ($type) {
                // Consider document types with custom fields as "required"
                return !empty($type->custom_fields) && !$this->hasDocumentType($type->code);
            });

        return $requiredTypes;
    }

    /**
     * Get document statistics
     */
    public function getDocumentStatistics(): array
    {
        return [
            'total_documents' => $this->documents->count(),
            'active_documents' => $this->activeNotExpiredDocuments->count(),
            'expiring_soon' => $this->expiring_soon_documents->count(),
            'expired_documents' => $this->expired_documents->count(),
            'missing_required' => $this->getMissingRequiredDocumentTypes()->count()
        ];
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TaskDocument extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'task_id',
        'document_type', 
        'document_id',
    ];

    /**
     * Document type constants
     */
    const TYPE_COMPANY = 'company_document';
    const TYPE_EMPLOYEE = 'employee_document';
    const TYPE_BRANCH_REGISTRATION = 'branch_registration';
    const TYPE_CIVIL_DEFENSE = 'civil_defense';
    const TYPE_MUNICIPALITY = 'municipality';

    /**
     * Get the task that owns the task document
     */
    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }

    /**
     * Get the company document if this is a company document
     */
    public function companyDocument(): BelongsTo
    {
        return $this->belongsTo(CompanyDocument::class, 'document_id');
    }

    /**
     * Get the employee document if this is an employee document  
     */
    public function employeeDocument(): BelongsTo
    {
        return $this->belongsTo(EmployeeDocument::class, 'document_id');
    }

    /**
     * Get the branch registration if this is a branch registration document
     */
    public function branchRegistration(): BelongsTo
    {
        return $this->belongsTo(BranchCommercialRegistration::class, 'document_id');
    }

    /**
     * Get the civil defense license if this is a civil defense document
     */
    public function civilDefenseLicense(): BelongsTo
    {
        return $this->belongsTo(CivilDefenseLicense::class, 'document_id');
    }

    /**
     * Get the municipality license if this is a municipality document
     */
    public function municipalityLicense(): BelongsTo
    {
        return $this->belongsTo(MunicipalityLicense::class, 'document_id');
    }

    /**
     * Get the actual document model instance
     */
    public function getDocumentInstance()
    {
        switch ($this->document_type) {
            case self::TYPE_COMPANY:
                return $this->companyDocument;
            case self::TYPE_EMPLOYEE:
                return $this->employeeDocument;
            case self::TYPE_BRANCH_REGISTRATION:
                return $this->branchRegistration;
            case self::TYPE_CIVIL_DEFENSE:
                return $this->civilDefenseLicense;
            case self::TYPE_MUNICIPALITY:
                return $this->municipalityLicense;
            default:
                return null;
        }
    }

    /**
     * Get document title for display
     */
    public function getDocumentTitle(): string
    {
        $document = $this->getDocumentInstance();
        
        if (!$document) {
            return __('tasks.document_not_found');
        }

        $locale = app()->getLocale();
        
        switch ($this->document_type) {
            case self::TYPE_COMPANY:
                $nameField = $locale === 'ar' ? 'name_ar' : 'name_en';
                return $document->documentType->{$nameField} ?? __('tasks.company_document');
            case self::TYPE_EMPLOYEE:
                $nameField = $locale === 'ar' ? 'name_ar' : 'name_en';
                return $document->documentType->{$nameField} ?? __('tasks.employee_document');
            case self::TYPE_BRANCH_REGISTRATION:
                $baseName = $locale === 'ar' ? 'السجل التجاري للفرع' : 'Branch Commercial Registration';
                $number = $document->branch_reg_number ?? '';
                return $number ? "{$baseName} ({$number})" : $baseName;
            case self::TYPE_CIVIL_DEFENSE:
                $baseName = $locale === 'ar' ? 'رخصة الدفاع المدني' : 'Civil Defense License';
                $number = $document->license_number ?? '';
                return $number ? "{$baseName} ({$number})" : $baseName;
            case self::TYPE_MUNICIPALITY:
                $baseName = $locale === 'ar' ? 'رخصة البلدية' : 'Municipality License';
                $number = $document->license_number ?? '';
                return $number ? "{$baseName} ({$number})" : $baseName;
            default:
                return __('tasks.unknown_document');
        }
    }

    /**
     * Check if this is a company document
     */
    public function isCompanyDocument(): bool
    {
        return in_array($this->document_type, [
            self::TYPE_COMPANY,
            self::TYPE_CIVIL_DEFENSE,
            self::TYPE_MUNICIPALITY,
            self::TYPE_BRANCH_REGISTRATION
        ]);
    }

    /**
     * Check if this is an employee document
     */
    public function isEmployeeDocument(): bool
    {
        return $this->document_type === self::TYPE_EMPLOYEE;
    }
}

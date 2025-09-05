<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Employee;

class DocumentType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_en',
        'name_ar',
        'code',
        'category',
        'entity_type',
        'requires_expiry_date',
        'requires_file_upload',
        'has_auto_reminder',
        'reminder_days_before',
        'required_fields',
        'optional_fields',
        'icon',
        'color',
        'description_ar',
        'description_en',
        'sort_order',
        'is_active'
    ];

    protected $casts = [
        'requires_expiry_date' => 'boolean',
        'requires_file_upload' => 'boolean',
        'has_auto_reminder' => 'boolean',
        'required_fields' => 'array',
        'optional_fields' => 'array',
        'is_active' => 'boolean'
    ];

    /**
     * Get all employee documents of this type
     */
    public function employeeDocuments(): HasMany
    {
        return $this->hasMany(EmployeeDocument::class);
    }

    /**
     * Scope for active document types
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for employee documents
     */
    public function scopeForEmployees($query)
    {
        return $query->where('category', 'employee');
    }

    /**
     * Scope for company documents
     */
    public function scopeForCompanies($query)
    {
        return $query->where('category', 'company');
    }

    /**
     * Scope for Saudi-specific documents
     */
    public function scopeForSaudi($query)
    {
        return $query->whereIn('entity_type', ['saudi', 'both']);
    }

    /**
     * Scope for expat-specific documents
     */
    public function scopeForExpat($query)
    {
        return $query->whereIn('entity_type', ['expat', 'both']);
    }

    /**
     * Scope ordered by sort order
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name_en');
    }

    /**
     * Get documents requiring expiry date
     */
    public function scopeRequiringExpiry($query)
    {
        return $query->where('requires_expiry_date', true);
    }

    /**
     * Get documents requiring file upload
     */
    public function scopeRequiringFiles($query)
    {
        return $query->where('requires_file_upload', true);
    }

    /**
     * Get documents with auto reminder enabled
     */
    public function scopeWithAutoReminder($query)
    {
        return $query->where('has_auto_reminder', true);
    }

    /**
     * Check if document type is compatible with employee
     */
    public function isCompatibleWithEmployee(Employee $employee): bool
    {
        // Check if document type is for employees
        if ($this->category !== 'employee') {
            return false;
        }

        // Check if document type is compatible with employee type
        if ($employee->type === 'saudi' && !in_array($this->entity_type, ['saudi', 'both'])) {
            return false;
        }

        if ($employee->type === 'expat' && !in_array($this->entity_type, ['expat', 'both'])) {
            return false;
        }

        // Check if document type is active
        if (!$this->is_active) {
            return false;
        }

        return true;
    }

    /**
     * Get validation rules for this document type
     */
    public function getValidationRules(): array
    {
        $rules = [
            'document_type_id' => 'required|exists:document_types,id',
            'document_number' => 'nullable|string|max:255',
            'issue_date' => 'nullable|date',
            'issuing_authority' => 'nullable|string|max:255',
            'issue_place' => 'nullable|string|max:255',
            'reference_number' => 'nullable|string|max:255',
            'fees_amount' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
            'renewal_notes' => 'nullable|string',
        ];

        // Apply expiry date validation if required
        if ($this->requires_expiry_date) {
            $rules['expiry_date'] = 'required|date|after:today';
        } else {
            $rules['expiry_date'] = 'nullable|date|after:today';
        }

        // Apply file upload validation if required
        if ($this->requires_file_upload) {
            $rules['document_file'] = 'required|file|mimes:pdf,jpg,jpeg,png|max:10240';
        } else {
            $rules['document_file'] = 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240';
        }

        // Apply custom field validation based on required_fields
        if ($this->required_fields && is_array($this->required_fields)) {
            foreach ($this->required_fields as $field) {
                if (!isset($rules[$field])) {
                    $rules[$field] = 'required|string|max:255';
                }
            }
        }

        return $rules;
    }

    /**
     * Get display name based on current locale
     */
    public function getDisplayNameAttribute(): string
    {
        return app()->getLocale() === 'ar' ? $this->name_ar : $this->name_en;
    }

    /**
     * Get description based on current locale
     */
    public function getDisplayDescriptionAttribute(): string
    {
        return app()->getLocale() === 'ar' ? $this->description_ar : $this->description_en;
    }

    /**
     * Check if document type has specific requirement
     */
    public function hasRequirement(string $requirement): bool
    {
        switch ($requirement) {
            case 'expiry_date':
                return $this->requires_expiry_date;
            case 'file_upload':
                return $this->requires_file_upload;
            case 'auto_reminder':
                return $this->has_auto_reminder;
            default:
                return false;
        }
    }

    /**
     * Get required fields count
     */
    public function getRequiredFieldsCountAttribute(): int
    {
        return is_array($this->required_fields) ? count($this->required_fields) : 0;
    }

    /**
     * Get optional fields count
     */
    public function getOptionalFieldsCountAttribute(): int
    {
        return is_array($this->optional_fields) ? count($this->optional_fields) : 0;
    }
}

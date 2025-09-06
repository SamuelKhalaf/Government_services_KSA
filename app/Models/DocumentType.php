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
        'reminder_days_before',
        'custom_fields',
        'description_ar',
        'description_en',
        'is_active'
    ];

    protected $casts = [
        'custom_fields' => 'array',
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
     * Scope ordered by name
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('name_en');
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
            'status' => 'required|in:active,expired,cancelled,pending',
            'enable_reminder' => 'nullable|boolean',
            'reminder_days' => 'nullable|integer|min:1|max:365',
        ];

        // Custom field validation is now handled by getCustomFieldsValidationRules()

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
     * Get custom fields count
     */
    public function getCustomFieldsCountAttribute(): int
    {
        return is_array($this->custom_fields) ? count($this->custom_fields) : 0;
    }

    /**
     * Get custom field by key
     */
    public function getCustomField(string $key): ?array
    {
        if (!is_array($this->custom_fields)) {
            return null;
        }

        foreach ($this->custom_fields as $field) {
            if ($field['key'] === $key) {
                return $field;
            }
        }

        return null;
    }

    /**
     * Add custom field
     */
    public function addCustomField(array $field): void
    {
        $customFields = $this->custom_fields ?? [];
        $customFields[] = $field;
        $this->custom_fields = $customFields;
    }

    /**
     * Update custom field
     */
    public function updateCustomField(string $key, array $field): bool
    {
        if (!is_array($this->custom_fields)) {
            return false;
        }

        foreach ($this->custom_fields as $index => $existingField) {
            if ($existingField['key'] === $key) {
                $this->custom_fields[$index] = $field;
                return true;
            }
        }

        return false;
    }

    /**
     * Remove custom field
     */
    public function removeCustomField(string $key): bool
    {
        if (!is_array($this->custom_fields)) {
                return false;
        }

        foreach ($this->custom_fields as $index => $field) {
            if ($field['key'] === $key) {
                unset($this->custom_fields[$index]);
                $this->custom_fields = array_values($this->custom_fields);
                return true;
            }
        }

        return false;
    }

    /**
     * Get validation rules for custom fields
     */
    public function getCustomFieldsValidationRules(): array
    {
        $rules = [];

        if (!is_array($this->custom_fields)) {
            return $rules;
        }

        foreach ($this->custom_fields as $field) {
            $fieldKey = $field['key'];
            $isRequired = $field['required'] ?? false;
            $fieldType = $field['type'] ?? 'text';

            $rule = $isRequired ? 'required|' : 'nullable|';

            switch ($fieldType) {
                case 'number':
                    $rule .= 'numeric';
                    break;
                case 'email':
                    $rule .= 'email';
                    break;
                case 'date':
                    $rule .= 'date';
                    break;
                case 'file':
                    $rule .= 'file|mimes:pdf,jpg,jpeg,png|max:10240';
                    break;
                case 'select':
                    $options = $field['options'] ?? [];
                    if (!empty($options)) {
                        // Handle different option structures
                        $validValues = [];
                        foreach ($options as $option) {
                            if (is_array($option) && isset($option['value'])) {
                                $validValues[] = $option['value'];
                            } elseif (is_string($option)) {
                                $validValues[] = $option;
                            }
                        }
                        if (!empty($validValues)) {
                            $rule .= 'in:' . implode(',', $validValues);
                        }
                    }
                    break;
                default:
                    $rule .= 'string|max:255';
                    break;
            }

            $rules[$fieldKey] = $rule;
        }

        return $rules;
    }

    /**
     * Get all validation rules including custom fields
     */
    public function getAllValidationRules(): array
    {
        $rules = $this->getValidationRules();
        $customRules = $this->getCustomFieldsValidationRules();

        return array_merge($rules, $customRules);
    }
}

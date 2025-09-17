<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EmployeeDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'document_type_id',
        'status',
        'enable_reminder',
        'reminder_days',
        'custom_fields'
    ];

    protected $casts = [
        'enable_reminder' => 'boolean',
        'custom_fields' => 'array'
    ];

    /**
     * Get the employee that owns the document
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    /**
     * Get the document type for this document
     */
    public function documentType(): BelongsTo
    {
        return $this->belongsTo(DocumentType::class);
    }

    /**
     * Get all task documents that reference this employee document
     */
    public function taskDocuments(): HasMany
    {
        return $this->hasMany(TaskDocument::class, 'document_id')->where('document_type', TaskDocument::TYPE_EMPLOYEE);
    }

    /**
     * Check if document is expired
     */
    public function getIsExpiredAttribute()
    {
        $expiryDate = $this->getCustomFieldValue('expiry_date');
        return $expiryDate && \Carbon\Carbon::parse($expiryDate) < now();
    }

    /**
     * Check if document is expiring soon (within 30 days)
     */
    public function getIsExpiringSoonAttribute()
    {
        $expiryDate = $this->getCustomFieldValue('expiry_date');
        if (!$expiryDate) return false;
        
        $expiryDate = \Carbon\Carbon::parse($expiryDate);
        $thirtyDaysFromNow = now()->addDays(30);
        return $expiryDate <= $thirtyDaysFromNow && $expiryDate >= now();
    }

    /**
     * Get file size in human readable format
     */
    public function getFormattedFileSizeAttribute()
    {
        $fileData = $this->getCustomFieldValue('document_file');
        if (!$fileData || !isset($fileData['file_size'])) return null;
        
        $bytes = $fileData['file_size'];
        $units = ['B', 'KB', 'MB', 'GB'];
        
        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, 2) . ' ' . $units[$i];
    }

    /**
     * Get status badge HTML
     */
    public function getStatusBadgeAttribute()
    {
        $statusColors = [
            'active' => 'success',
            'expired' => 'danger',
            'cancelled' => 'warning',
            'pending' => 'info',
            'under_process' => 'primary'
        ];

        $color = $statusColors[$this->status] ?? 'secondary';
        $statusText = __('documents.status_values.' . $this->status) ?? $this->status;

        return '<span class="badge badge-light-' . $color . '">' . $statusText . '</span>';
    }

    /**
     * Scope for active documents
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope for expired documents
     */
    public function scopeExpired($query)
    {
        return $query->whereJsonContains('custom_fields->expiry_date', function($q) {
            $q->whereRaw("JSON_EXTRACT(custom_fields, '$.expiry_date') < ?", [now()->toDateString()]);
        });
    }

    /**
     * Scope for expiring soon documents
     */
    public function scopeExpiringSoon($query, $days = 30)
    {
        $expiryDate = now()->addDays($days);
        return $query->whereRaw("JSON_EXTRACT(custom_fields, '$.expiry_date') IS NOT NULL")
                    ->whereRaw("JSON_EXTRACT(custom_fields, '$.expiry_date') <= ?", [$expiryDate->toDateString()])
                    ->whereRaw("JSON_EXTRACT(custom_fields, '$.expiry_date') >= ?", [now()->toDateString()]);
    }

    /**
     * Scope for specific document type (by code)
     */
    public function scopeByType($query, $typeCode)
    {
        return $query->whereHas('documentType', function ($q) use ($typeCode) {
            $q->where('code', $typeCode);
        });
    }

    /**
     * Scope for specific document type (by ID)
     */
    public function scopeByTypeId($query, $typeId)
    {
        return $query->where('document_type_id', $typeId);
    }

    /**
     * Scope for documents with files
     */
    public function scopeWithFiles($query)
    {
        return $query->whereRaw("JSON_EXTRACT(custom_fields, '$.document_file') IS NOT NULL");
    }

    /**
     * Scope for documents needing reminder
     */
    public function scopeNeedingReminder($query)
    {
        return $query->where('enable_reminder', true)
                    ->whereRaw("JSON_EXTRACT(custom_fields, '$.expiry_date') IS NOT NULL")
                    ->whereRaw("JSON_EXTRACT(custom_fields, '$.expiry_date') <= ?", [now()->addDays(30)->toDateString()]);
    }

    /**
     * Get custom field value by key
     */
    public function getCustomFieldValue(string $key)
    {
        if (!$this->custom_fields || !is_array($this->custom_fields)) {
            return null;
        }
        
        return $this->custom_fields[$key] ?? null;
    }

    /**
     * Check if document has a file
     */
    public function hasFile(): bool
    {
        $fileData = $this->getCustomFieldValue('document_file');
        return $fileData && is_array($fileData) && !empty($fileData['file_path']);
    }

    /**
     * Get file information
     */
    public function getFileInfo(): array
    {
        $fileData = $this->getCustomFieldValue('document_file');
        
        if (!$fileData || !is_array($fileData)) {
            return [];
        }

        $filePath = $fileData['file_path'] ?? '';
        $extension = pathinfo($filePath, PATHINFO_EXTENSION);
        
        return [
            'file_path' => $filePath,
            'original_filename' => $fileData['original_filename'] ?? basename($filePath),
            'file_size' => $fileData['file_size'] ?? 0,
            'extension' => $extension,
            'url' => $filePath ? asset('storage/' . $filePath) : null,
        ];
    }

    /**
     * Set custom field value by key
     */
    public function setCustomFieldValue(string $key, $value): void
    {
        if (!is_array($this->custom_fields)) {
            $this->custom_fields = [];
        }
        
        $this->custom_fields[$key] = $value;
    }

    /**
     * Check if document type is compatible with employee
     */
    public function isDocumentTypeCompatible(): bool
    {
        if (!$this->documentType || !$this->employee) {
            return false;
        }

        // Check if document type is for employees
        if ($this->documentType->category !== 'employee') {
            return false;
        }

        // Check if document type is compatible with employee type
        if ($this->employee->type === 'saudi' && !in_array($this->documentType->entity_type, ['saudi', 'both'])) {
            return false;
        }

        if ($this->employee->type === 'expat' && !in_array($this->documentType->entity_type, ['expat', 'both'])) {
            return false;
        }

        // Check if document type is active
        if (!$this->documentType->is_active) {
            return false;
        }

        return true;
    }

    /**
     * Validate document requirements based on document type
     */
    public function validateRequirements(): array
    {
        $errors = [];

        if (!$this->documentType) {
            $errors[] = 'Document type not found';
            return $errors;
        }

        // Check custom fields requirements
        if ($this->documentType->custom_fields && is_array($this->documentType->custom_fields)) {
            foreach ($this->documentType->custom_fields as $field) {
                if ($field['required'] ?? false) {
                    $fieldKey = $field['key'];
                    if (!isset($this->custom_fields[$fieldKey]) || empty($this->custom_fields[$fieldKey])) {
                        $fieldName = app()->getLocale() === 'ar' ? $field['name_ar'] : $field['name_en'];
                        $errors[] = "Required field '{$fieldName}' is missing";
                    }
                }
            }
        }

        return $errors;
    }

    /**
     * Get validation rules based on document type
     */
    public function getValidationRules(): array
    {
        if (!$this->documentType) {
            return [];
        }

        $rules = [
            'document_type_id' => 'required|exists:document_types,id',
            'status' => 'required|in:active,expired,cancelled,pending',
        ];

        // Apply custom field validation from document type
        $customRules = $this->documentType->getCustomFieldsValidationRules();
        $rules = array_merge($rules, $customRules);

        return $rules;
    }
}

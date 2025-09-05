<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmployeeDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'document_type_id',
        'document_number',
        'issue_date',
        'expiry_date',
        'issuing_authority',
        'issue_place',
        'reference_number',
        'fees_amount',
        'visa_type',
        'sponsor_name',
        'sponsor_id',
        'visa_purpose',
        'duration_days',
        'travel_type',
        'travel_date',
        'return_date',
        'destination_country',
        'fees_paid',
        'payment_method',
        'receipt_number',
        'status',
        'document_status',
        'file_path',
        'original_filename',
        'file_type',
        'file_size',
        'notes',
        'renewal_notes',
        'reminder_date',
        'auto_reminder',
        'dynamic_fields'
    ];

    protected $casts = [
        'issue_date' => 'date',
        'expiry_date' => 'date',
        'travel_date' => 'date',
        'return_date' => 'date',
        'reminder_date' => 'date',
        'fees_paid' => 'decimal:2',
        'fees_amount' => 'decimal:2',
        'auto_reminder' => 'boolean',
        'dynamic_fields' => 'array'
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
     * Check if document is expired
     */
    public function getIsExpiredAttribute()
    {
        return $this->expiry_date && $this->expiry_date < now();
    }

    /**
     * Check if document is expiring soon (within 30 days)
     */
    public function getIsExpiringSoonAttribute()
    {
        if (!$this->expiry_date) return false;
        
        $thirtyDaysFromNow = now()->addDays(30);
        return $this->expiry_date <= $thirtyDaysFromNow && $this->expiry_date >= now();
    }

    /**
     * Get file size in human readable format
     */
    public function getFormattedFileSizeAttribute()
    {
        if (!$this->file_size) return null;
        
        $bytes = $this->file_size;
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
        return $query->whereNotNull('expiry_date')
                    ->where('expiry_date', '<', now());
    }

    /**
     * Scope for expiring soon documents
     */
    public function scopeExpiringSoon($query, $days = 30)
    {
        $expiryDate = now()->addDays($days);
        return $query->whereNotNull('expiry_date')
                    ->where('expiry_date', '<=', $expiryDate)
                    ->where('expiry_date', '>=', now());
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
        return $query->whereNotNull('file_path');
    }

    /**
     * Scope for documents needing reminder
     */
    public function scopeNeedingReminder($query)
    {
        return $query->where('auto_reminder', true)
                    ->whereNotNull('reminder_date')
                    ->where('reminder_date', '<=', now());
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

        // Check expiry date requirement
        if ($this->documentType->requires_expiry_date && !$this->expiry_date) {
            $errors[] = 'Expiry date is required for this document type';
        }

        // Check file upload requirement
        if ($this->documentType->requires_file_upload && !$this->file_path) {
            $errors[] = 'File upload is required for this document type';
        }

        // Check required fields
        if ($this->documentType->required_fields && is_array($this->documentType->required_fields)) {
            foreach ($this->documentType->required_fields as $field) {
                if (!isset($this->dynamic_fields[$field]) || empty($this->dynamic_fields[$field])) {
                    $errors[] = "Required field '{$field}' is missing";
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
        if ($this->documentType->requires_expiry_date) {
            $rules['expiry_date'] = 'required|date|after:today';
        } else {
            $rules['expiry_date'] = 'nullable|date|after:today';
        }

        // Apply file upload validation if required
        if ($this->documentType->requires_file_upload) {
            $rules['document_file'] = 'required|file|mimes:pdf,jpg,jpeg,png|max:10240';
        } else {
            $rules['document_file'] = 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240';
        }

        // Apply custom field validation based on required_fields
        if ($this->documentType->required_fields && is_array($this->documentType->required_fields)) {
            foreach ($this->documentType->required_fields as $field) {
                if (!isset($rules[$field])) {
                    $rules[$field] = 'required|string|max:255';
                }
            }
        }

        return $rules;
    }
}

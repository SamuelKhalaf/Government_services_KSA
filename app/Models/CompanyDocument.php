<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class CompanyDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
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
     * Get the company that owns the document
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Get the document type for this document
     */
    public function documentType(): BelongsTo
    {
        return $this->belongsTo(DocumentType::class);
    }

    /**
     * Get all task documents that reference this company document
     */
    public function taskDocuments(): HasMany
    {
        return $this->hasMany(TaskDocument::class, 'document_id')->where('document_type', TaskDocument::TYPE_COMPANY);
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
        if (!$fileData || !isset($fileData['file_size'])) {
            return 'N/A';
        }

        $bytes = $fileData['file_size'];
        $units = ['B', 'KB', 'MB', 'GB'];
        
        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, 2) . ' ' . $units[$i];
    }

    /**
     * Get custom field value by key
     */
    public function getCustomFieldValue(string $key)
    {
        if (!is_array($this->custom_fields)) {
            return null;
        }
        
        return $this->custom_fields[$key] ?? null;
    }

    /**
     * Check if document has file
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
            'file_type' => $fileData['file_type'] ?? $extension,
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
        return $query->whereRaw("JSON_EXTRACT(custom_fields, '$.expiry_date') < ?", [now()->toDateString()]);
    }

    /**
     * Scope for expiring soon documents
     */
    public function scopeExpiringSoon($query, $days = 30)
    {
        $expiryDate = now()->addDays($days)->toDateString();
        return $query->whereRaw("JSON_EXTRACT(custom_fields, '$.expiry_date') <= ?", [$expiryDate])
                    ->whereRaw("JSON_EXTRACT(custom_fields, '$.expiry_date') >= ?", [now()->toDateString()]);
    }

    /**
     * Scope for documents with files
     */
    public function scopeWithFiles($query)
    {
        return $query->whereRaw("JSON_EXTRACT(custom_fields, '$.document_file.file_path') IS NOT NULL");
    }

    /**
     * Scope for documents needing reminder
     */
    public function scopeNeedingReminder($query)
    {
        return $query->where('enable_reminder', true)
                    ->whereNotNull('reminder_days')
                    ->whereRaw("JSON_EXTRACT(custom_fields, '$.expiry_date') <= ?", [now()->addDays(30)->toDateString()]);
    }
}

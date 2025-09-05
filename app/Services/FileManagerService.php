<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileManagerService
{
    /**
     * Upload and store a file
     */
    public function uploadFile(UploadedFile $file, string $path, string $prefix = ''): array
    {
        // Generate unique filename
        $extension = $file->getClientOriginalExtension();
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $sanitizedName = $this->sanitizeFilename($originalName);
        
        $filename = $prefix . time() . '_' . $sanitizedName . '.' . $extension;
        
        // Store file
        $filePath = $file->storeAs($path, $filename, 'public');
        
        return [
            'file_path' => $filePath,
            'original_filename' => $file->getClientOriginalName(),
            'file_type' => $extension,
            'file_size' => $file->getSize(),
            'mime_type' => $file->getMimeType()
        ];
    }

    /**
     * Delete a file from storage
     */
    public function deleteFile(string $filePath): bool
    {
        if (Storage::disk('public')->exists($filePath)) {
            return Storage::disk('public')->delete($filePath);
        }
        
        return false;
    }

    /**
     * Get file URL
     */
    public function getFileUrl(string $filePath): string
    {
        return Storage::disk('public')->url($filePath);
    }

    /**
     * Check if file exists
     */
    public function fileExists(string $filePath): bool
    {
        return Storage::disk('public')->exists($filePath);
    }

    /**
     * Get file size in human readable format
     */
    public function getFileSize(string $filePath): string
    {
        if (!$this->fileExists($filePath)) {
            return 'N/A';
        }

        $bytes = Storage::disk('public')->size($filePath);
        
        if ($bytes >= 1073741824) {
            return number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        } elseif ($bytes > 1) {
            return $bytes . ' bytes';
        } elseif ($bytes == 1) {
            return '1 byte';
        } else {
            return '0 bytes';
        }
    }

    /**
     * Validate file type and size
     */
    public function validateFile(UploadedFile $file, array $allowedTypes = [], int $maxSize = null): array
    {
        $errors = [];
        
        // Default allowed types
        if (empty($allowedTypes)) {
            $allowedTypes = ['pdf', 'jpg', 'jpeg', 'png', 'doc', 'docx'];
        }
        
        // Default max size (10MB)
        if ($maxSize === null) {
            $maxSize = 10 * 1024 * 1024; // 10MB in bytes
        }
        
        // Check file type
        $extension = strtolower($file->getClientOriginalExtension());
        if (!in_array($extension, $allowedTypes)) {
            $errors[] = 'File type ' . $extension . ' is not allowed. Allowed types: ' . implode(', ', $allowedTypes);
        }
        
        // Check file size
        if ($file->getSize() > $maxSize) {
            $errors[] = 'File size exceeds maximum allowed size of ' . $this->formatBytes($maxSize);
        }
        
        return $errors;
    }

    /**
     * Create directory structure for company documents
     */
    public function createCompanyDirectories(int $companyId): void
    {
        $basePath = 'company_documents/' . $companyId;
        
        $directories = [
            $basePath,
            $basePath . '/civil_defense',
            $basePath . '/municipality',
            $basePath . '/branch_registration',
            $basePath . '/other'
        ];
        
        foreach ($directories as $directory) {
            if (!Storage::disk('public')->exists($directory)) {
                Storage::disk('public')->makeDirectory($directory);
            }
        }
    }

    /**
     * Create directory structure for employee documents
     */
    public function createEmployeeDirectories(int $employeeId): void
    {
        $basePath = 'employee_documents/' . $employeeId;
        
        $directories = [
            $basePath,
            $basePath . '/identity',
            $basePath . '/visa',
            $basePath . '/contracts',
            $basePath . '/certificates',
            $basePath . '/other'
        ];
        
        foreach ($directories as $directory) {
            if (!Storage::disk('public')->exists($directory)) {
                Storage::disk('public')->makeDirectory($directory);
            }
        }
    }

    /**
     * Get file icon based on extension
     */
    public function getFileIcon(string $extension): string
    {
        $icons = [
            'pdf' => 'fas fa-file-pdf text-danger',
            'doc' => 'fas fa-file-word text-primary',
            'docx' => 'fas fa-file-word text-primary',
            'xls' => 'fas fa-file-excel text-success',
            'xlsx' => 'fas fa-file-excel text-success',
            'jpg' => 'fas fa-file-image text-warning',
            'jpeg' => 'fas fa-file-image text-warning',
            'png' => 'fas fa-file-image text-warning',
            'gif' => 'fas fa-file-image text-warning',
            'zip' => 'fas fa-file-archive text-secondary',
            'rar' => 'fas fa-file-archive text-secondary',
            'txt' => 'fas fa-file-alt text-muted',
        ];

        return $icons[strtolower($extension)] ?? 'fas fa-file text-muted';
    }

    /**
     * Sanitize filename
     */
    private function sanitizeFilename(string $filename): string
    {
        // Remove or replace special characters
        $filename = preg_replace('/[^a-zA-Z0-9._-]/', '_', $filename);
        
        // Remove multiple underscores
        $filename = preg_replace('/_+/', '_', $filename);
        
        // Trim underscores from start and end
        $filename = trim($filename, '_');
        
        // Limit length
        if (strlen($filename) > 50) {
            $filename = substr($filename, 0, 50);
        }
        
        return $filename ?: 'file';
    }

    /**
     * Format bytes to human readable format
     */
    private function formatBytes(int $bytes): string
    {
        if ($bytes >= 1073741824) {
            return number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        } else {
            return $bytes . ' bytes';
        }
    }

    /**
     * Clean up old files (for cleanup tasks)
     */
    public function cleanupOldFiles(int $daysOld = 30): int
    {
        $deletedCount = 0;
        $cutoffDate = now()->subDays($daysOld);
        
        // Get all files in storage
        $files = Storage::disk('public')->allFiles();
        
        foreach ($files as $file) {
            $lastModified = Storage::disk('public')->lastModified($file);
            
            if ($lastModified < $cutoffDate->timestamp) {
                // Check if file is referenced in database
                if (!$this->isFileReferenced($file)) {
                    Storage::disk('public')->delete($file);
                    $deletedCount++;
                }
            }
        }
        
        return $deletedCount;
    }

    /**
     * Check if file is referenced in database
     */
    private function isFileReferenced(string $filePath): bool
    {
        // Check in various tables for file references
        $tables = [
            \App\Models\CivilDefenseLicense::class => 'certificate_file_path',
            \App\Models\MunicipalityLicense::class => 'certificate_file_path',
            \App\Models\BranchCommercialRegistration::class => 'certificate_file_path',
            \App\Models\EmployeeDocument::class => 'file_path',
        ];

        foreach ($tables as $model => $column) {
            if ($model::where($column, $filePath)->exists()) {
                return true;
            }
        }

        return false;
    }
}

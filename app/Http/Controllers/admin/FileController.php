<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Services\FileManagerService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class FileController extends Controller
{
    protected FileManagerService $fileManager;

    public function __construct(FileManagerService $fileManager)
    {
        $this->fileManager = $fileManager;
    }

    /**
     * Preview a document file
     */
    public function preview(Request $request)
    {
        $filePath = $request->get('path');
        
        if (!$filePath || !$this->fileManager->fileExists($filePath)) {
            abort(404, 'File not found');
        }

        // Security check - ensure user has permission to view this file
        if (!$this->canAccessFile($filePath)) {
            abort(403, 'Access denied');
        }

        $fullPath = Storage::disk('public')->path($filePath);
        $mimeType = Storage::disk('public')->mimeType($filePath);
        
        // For PDFs and images, show inline preview
        if (in_array($mimeType, ['application/pdf', 'image/jpeg', 'image/png', 'image/gif'])) {
            return response()->file($fullPath, [
                'Content-Type' => $mimeType,
                'Content-Disposition' => 'inline'
            ]);
        }

        // For other files, force download
        return $this->download($request);
    }

    /**
     * Download a document file
     */
    public function download(Request $request)
    {
        $filePath = $request->get('path');
        $originalName = $request->get('name');
        
        if (!$filePath || !$this->fileManager->fileExists($filePath)) {
            abort(404, 'File not found');
        }

        // Security check
        if (!$this->canAccessFile($filePath)) {
            abort(403, 'Access denied');
        }

        $fullPath = Storage::disk('public')->path($filePath);
        
        return response()->download($fullPath, $originalName ?: basename($filePath));
    }

    /**
     * Get file information
     */
    public function info(Request $request)
    {
        $filePath = $request->get('path');
        
        if (!$filePath || !$this->fileManager->fileExists($filePath)) {
            return response()->json(['error' => 'File not found'], 404);
        }

        // Security check
        if (!$this->canAccessFile($filePath)) {
            return response()->json(['error' => 'Access denied'], 403);
        }

        $fileInfo = [
            'path' => $filePath,
            'url' => $this->fileManager->getFileUrl($filePath),
            'size' => $this->fileManager->getFileSize($filePath),
            'size_bytes' => Storage::disk('public')->size($filePath),
            'mime_type' => Storage::disk('public')->mimeType($filePath),
            'last_modified' => Storage::disk('public')->lastModified($filePath),
            'extension' => pathinfo($filePath, PATHINFO_EXTENSION),
            'icon' => $this->fileManager->getFileIcon(pathinfo($filePath, PATHINFO_EXTENSION)),
            'can_preview' => $this->canPreviewFile($filePath),
        ];

        return response()->json($fileInfo);
    }

    /**
     * Delete a file (with security checks)
     */
    public function delete(Request $request)
    {
        $filePath = $request->get('path');
        
        if (!$filePath || !$this->fileManager->fileExists($filePath)) {
            return response()->json(['error' => 'File not found'], 404);
        }

        // Security check
        if (!$this->canAccessFile($filePath)) {
            return response()->json(['error' => 'Access denied'], 403);
        }

        // Additional check - ensure file is not referenced in database
        if ($this->isFileReferenced($filePath)) {
            return response()->json(['error' => 'File is still referenced and cannot be deleted'], 422);
        }

        if ($this->fileManager->deleteFile($filePath)) {
            return response()->json(['success' => 'File deleted successfully']);
        }

        return response()->json(['error' => 'Failed to delete file'], 500);
    }

    /**
     * Check if user can access this file
     */
    private function canAccessFile(string $filePath): bool
    {
        $user = Auth::user();
        
        // Admin can access all files
        if ($user->hasRole('admin')) {
            return true;
        }

        // Check if file belongs to documents user has permission to view
        if (str_contains($filePath, 'company_documents/')) {
            return $user->hasAnyPermission([
                'view_all_clients',
                'view_assigned_clients',
                'view_company_documents'
            ]);
        }

        if (str_contains($filePath, 'employee_documents/')) {
            return $user->hasAnyPermission([
                'view_all_documents',
                'view_assigned_documents'
            ]);
        }

        return false;
    }

    /**
     * Check if file can be previewed
     */
    private function canPreviewFile(string $filePath): bool
    {
        $mimeType = Storage::disk('public')->mimeType($filePath);
        
        return in_array($mimeType, [
            'application/pdf',
            'image/jpeg',
            'image/png',
            'image/gif',
            'image/webp',
            'text/plain'
        ]);
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

    /**
     * Bulk file operations
     */
    public function bulkDelete(Request $request)
    {
        $filePaths = $request->get('files', []);
        $deleted = 0;
        $errors = [];

        foreach ($filePaths as $filePath) {
            if (!$this->canAccessFile($filePath)) {
                $errors[] = "Access denied for: {$filePath}";
                continue;
            }

            if ($this->isFileReferenced($filePath)) {
                $errors[] = "File still referenced: {$filePath}";
                continue;
            }

            if ($this->fileManager->deleteFile($filePath)) {
                $deleted++;
            } else {
                $errors[] = "Failed to delete: {$filePath}";
            }
        }

        return response()->json([
            'deleted' => $deleted,
            'errors' => $errors,
            'message' => "Deleted {$deleted} files" . (count($errors) > 0 ? " with " . count($errors) . " errors" : "")
        ]);
    }
}

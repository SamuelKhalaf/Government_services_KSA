<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Process;
use Carbon\Carbon;

class BackupController extends Controller
{
    /**
     * Display the backup page.
     */
    public function index()
    {
        return view('admin.backup.index');
    }

    /**
     * Create and download a database backup.
     */
    public function create()
    {
        try {
            $config = config('database.connections.' . config('database.default'));
            
            // Generate filename with timestamp
            $timestamp = Carbon::now()->format('Y-m-d_H-i-s');
            $filename = "backup_{$timestamp}.sql";
            
            // Get database connection details
            $host = $config['host'];
            $port = $config['port'];
            $database = $config['database'];
            $username = $config['username'];
            $password = $config['password'];
            
            // Create mysqldump command
            $command = sprintf(
                'mysqldump --host=%s --port=%s --user=%s --password=%s --single-transaction --routines --triggers %s',
                escapeshellarg($host),
                escapeshellarg($port),
                escapeshellarg($username),
                escapeshellarg($password),
                escapeshellarg($database)
            );
            
            // Execute the command
            $process = Process::fromShellCommandline($command);
            $process->setTimeout(300); // 5 minutes timeout
            $process->run();
            
            if (!$process->isSuccessful()) {
                throw new \Exception('Backup failed: ' . $process->getErrorOutput());
            }
            
            $sqlContent = $process->getOutput();
            
            // Add header information to the SQL file
            $header = "-- Database Backup\n";
            $header .= "-- Generated on: " . Carbon::now()->format('Y-m-d H:i:s') . "\n";
            $header .= "-- Database: {$database}\n";
            $header .= "-- Host: {$host}\n\n";
            $header .= "SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";\n";
            $header .= "START TRANSACTION;\n";
            $header .= "SET time_zone = \"+00:00\";\n\n";
            
            $sqlContent = $header . $sqlContent;
            
            // Return the SQL file as download
            return response($sqlContent, 200, [
                'Content-Type' => 'application/sql',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
                'Content-Length' => strlen($sqlContent),
            ]);
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Backup failed: ' . $e->getMessage());
        }
    }

    /**
     * Create a backup and store it on the server.
     */
    public function store()
    {
        try {
            $config = config('database.connections.' . config('database.default'));
            
            // Generate filename with timestamp
            $timestamp = Carbon::now()->format('Y-m-d_H-i-s');
            $filename = "backup_{$timestamp}.sql";
            
            // Get database connection details
            $host = $config['host'];
            $port = $config['port'];
            $database = $config['database'];
            $username = $config['username'];
            $password = $config['password'];
            
            // Create mysqldump command
            $command = sprintf(
                'mysqldump --host=%s --port=%s --user=%s --password=%s --single-transaction --routines --triggers %s',
                escapeshellarg($host),
                escapeshellarg($port),
                escapeshellarg($username),
                escapeshellarg($password),
                escapeshellarg($database)
            );
            
            // Execute the command
            $process = Process::fromShellCommandline($command);
            $process->setTimeout(300); // 5 minutes timeout
            $process->run();
            
            if (!$process->isSuccessful()) {
                throw new \Exception('Backup failed: ' . $process->getErrorOutput());
            }
            
            $sqlContent = $process->getOutput();
            
            // Add header information to the SQL file
            $header = "-- Database Backup\n";
            $header .= "-- Generated on: " . Carbon::now()->format('Y-m-d H:i:s') . "\n";
            $header .= "-- Database: {$database}\n";
            $header .= "-- Host: {$host}\n\n";
            $header .= "SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";\n";
            $header .= "START TRANSACTION;\n";
            $header .= "SET time_zone = \"+00:00\";\n\n";
            
            $sqlContent = $header . $sqlContent;
            
            // Store the backup file
            $backupPath = "backups/{$filename}";
            Storage::disk('local')->put($backupPath, $sqlContent);
            
            return redirect()->back()->with('success', 'Backup created successfully and stored on server.');
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Backup failed: ' . $e->getMessage());
        }
    }

    /**
     * List all stored backups.
     */
    public function list()
    {
        try {
            $backups = [];
            $backupFiles = Storage::disk('local')->files('backups');
            
            foreach ($backupFiles as $file) {
                $backups[] = [
                    'filename' => basename($file),
                    'path' => $file,
                    'size' => Storage::disk('local')->size($file),
                    'created_at' => Carbon::createFromTimestamp(Storage::disk('local')->lastModified($file)),
                ];
            }
            
            // Sort by creation date (newest first)
            usort($backups, function ($a, $b) {
                return $b['created_at']->timestamp - $a['created_at']->timestamp;
            });
            
            return view('admin.backup.list', compact('backups'));
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to list backups: ' . $e->getMessage());
        }
    }

    /**
     * Download a stored backup.
     */
    public function download($filename)
    {
        try {
            $backupPath = "backups/{$filename}";
            
            if (!Storage::disk('local')->exists($backupPath)) {
                return redirect()->back()->with('error', 'Backup file not found.');
            }
            
            return Storage::disk('local')->download($backupPath);
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Download failed: ' . $e->getMessage());
        }
    }

    /**
     * Delete a stored backup.
     */
    public function delete($filename)
    {
        try {
            $backupPath = "backups/{$filename}";
            
            if (!Storage::disk('local')->exists($backupPath)) {
                return redirect()->back()->with('error', 'Backup file not found.');
            }
            
            Storage::disk('local')->delete($backupPath);
            
            return redirect()->back()->with('success', 'Backup deleted successfully.');
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Delete failed: ' . $e->getMessage());
        }
    }
}

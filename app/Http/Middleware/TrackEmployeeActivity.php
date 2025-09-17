<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\EmployeeActivityLog;
use App\Models\EmployeeLoginLog;
use App\Enums\RoleEnum;

class TrackEmployeeActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Only track activities for authenticated users with employee role
        if (Auth::check() && Auth::user()->isEmployee()) {
            $this->trackActivity($request);
            $this->trackLogin($request);
        }

        return $response;
    }

    /**
     * Track user activity
     */
    private function trackActivity(Request $request): void
    {
        $user = Auth::user();
        $action = $this->determineAction($request);
        
        if (!$action) {
            return;
        }

        $modelType = $this->determineModelType($request) ?? 'App\\Models\\Page';
        $modelId = $this->extractModelId($request);
        $description = $this->generateDescription($request, $action, $modelType);

        EmployeeActivityLog::create([
            'user_id' => $user->id,
            'action_type' => $action,
            'model_type' => $modelType,
            'model_id' => $modelId,
            'description' => $description,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'url' => $request->fullUrl(),
        ]);
    }

    /**
     * Track login activity
     */
    private function trackLogin(Request $request): void
    {
        // Check if this is a logout request
        if ($request->is('logout') && $request->isMethod('post')) {
            $user = Auth::user();
            
            if ($user && $user->isEmployee()) {
                // Update the latest active login log
                $latestLogin = EmployeeLoginLog::where('user_id', $user->id)
                    ->where('status', 'active')
                    ->latest()
                    ->first();
                    
                if ($latestLogin) {
                    $latestLogin->update([
                        'logout_at' => now(),
                        'status' => 'logged_out',
                        'duration_minutes' => $latestLogin->calculateDuration(),
                    ]);
                }
            }
        }
    }

    /**
     * Determine the action type based on request
     */
    private function determineAction(Request $request): ?string
    {
        $method = $request->method();
        $path = $request->path();

        // Skip certain paths that don't need tracking
        $skipPaths = ['api/employee-monitoring', 'employee-monitoring/statistics', 'employee-monitoring/chart-data'];
        
        if (in_array($path, $skipPaths)) {
            return null;
        }

        if ($method === 'GET') {
            return 'view';
        }

        if ($method === 'POST') {
            if (str_contains($path, 'create') || str_contains($path, 'store')) {
                return 'create';
            }
            return 'create';
        }

        if ($method === 'PUT' || $method === 'PATCH') {
            return 'update';
        }

        if ($method === 'DELETE') {
            return 'delete';
        }

        return null;
    }

    /**
     * Determine the model type based on request path
     */
    private function determineModelType(Request $request): ?string
    {
        $path = $request->path();

        // Company related
        if (str_contains($path, 'companies')) {
            return 'App\\Models\\Company';
        }

        // Employee related
        if (str_contains($path, 'employees')) {
            return 'App\\Models\\Employee';
        }

        // Task related
        if (str_contains($path, 'tasks')) {
            return 'App\\Models\\Task';
        }

        // Document related
        if (str_contains($path, 'documents')) {
            if (str_contains($path, 'company')) {
                return 'App\\Models\\CompanyDocument';
            }
            if (str_contains($path, 'employee')) {
                return 'App\\Models\\EmployeeDocument';
            }
            if (str_contains($path, 'task')) {
                return 'App\\Models\\TaskDocument';
            }
            return 'App\\Models\\Document';
        }

        // User related
        if (str_contains($path, 'users')) {
            return 'App\\Models\\User';
        }

        // Package related
        if (str_contains($path, 'packages')) {
            return 'App\\Models\\Package';
        }

        // Invoice related
        if (str_contains($path, 'invoices')) {
            return 'App\\Models\\Invoice';
        }

        // Notification related
        if (str_contains($path, 'notifications')) {
            return 'App\\Models\\Notification';
        }

        // Employee monitoring related
        if (str_contains($path, 'employee-monitoring')) {
            return 'App\\Models\\EmployeeMonitoring';
        }

        // Dashboard or general pages
        if (str_contains($path, 'dashboard') || str_contains($path, 'home') || $path === '' || $path === '/') {
            return 'App\\Models\\Dashboard';
        }

        // Default to Page for other requests
        return 'App\\Models\\Page';
    }

    /**
     * Extract model ID from request
     */
    private function extractModelId(Request $request): ?int
    {
        $segments = $request->segments();
        
        // Look for numeric segments that could be IDs
        foreach ($segments as $segment) {
            if (is_numeric($segment)) {
                return (int) $segment;
            }
        }

        return null;
    }

    /**
     * Generate human-readable description
     */
    private function generateDescription(Request $request, string $action, ?string $modelType): string
    {
        $path = $request->path();
        $method = $request->method();
        
        $modelName = $modelType ? class_basename($modelType) : 'Record';
        $actionText = ucfirst($action);
        
        if ($action === 'view') {
            return "Viewed {$modelName} page";
        }
        
        if ($action === 'create') {
            return "Created new {$modelName}";
        }
        
        if ($action === 'update') {
            return "Updated {$modelName}";
        }
        
        if ($action === 'delete') {
            return "Deleted {$modelName}";
        }
        
        return "{$actionText} {$modelName}";
    }
}
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\PackageValidationService;
use App\Models\Company;
use App\Models\Employee;
use Symfony\Component\HttpFoundation\Response;

class CheckPackageLimits
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $operation = null): Response
    {
        // Only apply to POST requests (creation operations)
        if ($request->method() !== 'POST') {
            return $next($request);
        }

        $packageValidationService = new PackageValidationService();
        $company = $this->getCompanyFromRequest($request);
        
        if (!$company) {
            return $next($request);
        }

        $validation = null;
        
        // Determine the operation type and validate accordingly
        switch ($operation) {
            case 'employee':
                $validation = $packageValidationService->canAddEmployee($company);
                break;
            case 'employee_document':
                $validation = $packageValidationService->canAddEmployeeDocument($company);
                break;
            case 'company_document':
                $validation = $packageValidationService->canAddCompanyDocument($company);
                break;
            default:
                // Auto-detect operation based on route
                $validation = $this->autoDetectOperation($request, $packageValidationService, $company);
                break;
        }

        if ($validation && !$validation['allowed']) {
            if ($request->expectsJson()) {
                return response()->json([
                    'error' => true,
                    'message' => $validation['message'],
                    'type' => $validation['type']
                ], 403);
            }

            return back()
                ->withInput()
                ->with('error', $validation['message']);
        }

        return $next($request);
    }

    /**
     * Get company from request parameters
     */
    private function getCompanyFromRequest(Request $request): ?Company
    {
        // Try to get company directly from route parameter
        if ($request->route('company')) {
            return $request->route('company');
        }

        // Try to get company through employee relationship
        if ($request->route('employee')) {
            $employee = $request->route('employee');
            return $employee instanceof Employee ? $employee->company : null;
        }

        // Try to get company from request data
        if ($request->has('company_id')) {
            return Company::find($request->input('company_id'));
        }

        return null;
    }

    /**
     * Auto-detect operation type based on route and request
     */
    private function autoDetectOperation(Request $request, PackageValidationService $service, Company $company): ?array
    {
        $routeName = $request->route()->getName();
        
        if (str_contains($routeName, 'employees.store')) {
            return $service->canAddEmployee($company);
        }
        
        if (str_contains($routeName, 'employee-documents') || str_contains($routeName, 'employees.documents')) {
            return $service->canAddEmployeeDocument($company);
        }
        
        if (str_contains($routeName, 'companies.documents') || str_contains($routeName, 'company-documents')) {
            return $service->canAddCompanyDocument($company);
        }

        return null;
    }
}
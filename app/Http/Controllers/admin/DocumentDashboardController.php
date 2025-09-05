<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Employee;
use App\Models\EmployeeDocument;
use App\Models\CivilDefenseLicense;
use App\Models\MunicipalityLicense;
use App\Models\BranchCommercialRegistration;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DocumentDashboardController extends Controller
{
    /**
     * Display the document dashboard.
     */
    public function index(Request $request)
    {
        // Get statistics
        $stats = $this->getDocumentStatistics();
        
        // Get expiring documents
        $expiringDocuments = $this->getExpiringDocuments();
        
        // Get recent activities
        $recentActivities = $this->getRecentActivities();
        
        // Get chart data
        $chartData = $this->getChartData();
        
        return view('admin.documents.dashboard', compact(
            'stats',
            'expiringDocuments',
            'recentActivities',
            'chartData'
        ));
    }

    /**
     * Get document statistics.
     */
    private function getDocumentStatistics()
    {
        $today = Carbon::today();
        $thirtyDaysFromNow = Carbon::today()->addDays(30);

        return [
            'total_companies' => Company::count(),
            'active_companies' => Company::where('status', 'active')->count(),
            'total_employees' => Employee::count(),
            'active_employees' => Employee::where('status', 'active')->count(),
            
            // Employee Documents
            'total_employee_documents' => EmployeeDocument::count(),
            'active_employee_documents' => EmployeeDocument::where('status', 'active')->count(),
            'expired_employee_documents' => EmployeeDocument::where('expiry_date', '<', $today)->count(),
            'expiring_employee_documents' => EmployeeDocument::whereBetween('expiry_date', [$today, $thirtyDaysFromNow])->count(),
            
            // Company Documents
            'civil_defense_licenses' => CivilDefenseLicense::count(),
            'expired_civil_defense' => CivilDefenseLicense::where('expiry_date', '<', $today)->count(),
            'expiring_civil_defense' => CivilDefenseLicense::whereBetween('expiry_date', [$today, $thirtyDaysFromNow])->count(),
            
            'municipality_licenses' => MunicipalityLicense::count(),
            'expired_municipality' => MunicipalityLicense::where('expiry_date', '<', $today)->count(),
            'expiring_municipality' => MunicipalityLicense::whereBetween('expiry_date', [$today, $thirtyDaysFromNow])->count(),
            
            'branch_registrations' => BranchCommercialRegistration::count(),
            'expired_branch_registrations' => BranchCommercialRegistration::where('expiry_date', '<', $today)->count(),
            'expiring_branch_registrations' => BranchCommercialRegistration::whereBetween('expiry_date', [$today, $thirtyDaysFromNow])->count(),
        ];
    }

    /**
     * Get expiring documents.
     */
    private function getExpiringDocuments()
    {
        $thirtyDaysFromNow = Carbon::today()->addDays(30);
        
        $employeeDocuments = EmployeeDocument::with(['employee.company', 'documentType'])
            ->where('expiry_date', '<=', $thirtyDaysFromNow)
            ->where('expiry_date', '>=', Carbon::today())
            ->orderBy('expiry_date')
            ->limit(10)
            ->get();

        $civilDefenseDocuments = CivilDefenseLicense::with('company')
            ->where('expiry_date', '<=', $thirtyDaysFromNow)
            ->where('expiry_date', '>=', Carbon::today())
            ->orderBy('expiry_date')
            ->limit(5)
            ->get();

        $municipalityDocuments = MunicipalityLicense::with('company')
            ->where('expiry_date', '<=', $thirtyDaysFromNow)
            ->where('expiry_date', '>=', Carbon::today())
            ->orderBy('expiry_date')
            ->limit(5)
            ->get();

        $branchDocuments = BranchCommercialRegistration::with('company')
            ->where('expiry_date', '<=', $thirtyDaysFromNow)
            ->where('expiry_date', '>=', Carbon::today())
            ->orderBy('expiry_date')
            ->limit(5)
            ->get();

        return [
            'employee_documents' => $employeeDocuments,
            'civil_defense_documents' => $civilDefenseDocuments,
            'municipality_documents' => $municipalityDocuments,
            'branch_documents' => $branchDocuments,
        ];
    }

    /**
     * Get recent activities.
     */
    private function getRecentActivities()
    {
        $activities = collect();

        // Recent employee documents
        $recentEmployeeDocuments = EmployeeDocument::with(['employee.company'])
            ->latest()
            ->limit(5)
            ->get()
            ->map(function ($doc) {
                return [
                    'type' => 'employee_document',
                    'title' => 'Employee Document Added',
                    'description' => $doc->document_number . ' for ' . $doc->employee->full_name_en,
                    'company' => $doc->employee->company->company_name_en,
                    'date' => $doc->created_at,
                    'status' => $doc->status,
                ];
            });

        // Recent civil defense licenses
        $recentCivilDefense = CivilDefenseLicense::with('company')
            ->latest()
            ->limit(3)
            ->get()
            ->map(function ($license) {
                return [
                    'type' => 'civil_defense',
                    'title' => 'Civil Defense License Added',
                    'description' => $license->license_number,
                    'company' => $license->company->company_name_en,
                    'date' => $license->created_at,
                    'status' => 'active',
                ];
            });

        return $activities
            ->merge($recentEmployeeDocuments)
            ->merge($recentCivilDefense)
            ->sortByDesc('date')
            ->take(15)
            ->values();
    }

    /**
     * Get chart data for document trends.
     */
    private function getChartData()
    {
        $months = collect();
        $employeeDocCounts = collect();
        $companyDocCounts = collect();

        // Get data for last 12 months
        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthStart = $date->copy()->startOfMonth();
            $monthEnd = $date->copy()->endOfMonth();

            $months->push($date->format('M Y'));
            
            $employeeDocCount = EmployeeDocument::whereBetween('created_at', [$monthStart, $monthEnd])->count();
            $employeeDocCounts->push($employeeDocCount);
            
            $companyDocCount = CivilDefenseLicense::whereBetween('created_at', [$monthStart, $monthEnd])->count() +
                             MunicipalityLicense::whereBetween('created_at', [$monthStart, $monthEnd])->count() +
                             BranchCommercialRegistration::whereBetween('created_at', [$monthStart, $monthEnd])->count();
            $companyDocCounts->push($companyDocCount);
        }

        return [
            'months' => $months->toArray(),
            'employee_documents' => $employeeDocCounts->toArray(),
            'company_documents' => $companyDocCounts->toArray(),
        ];
    }

    /**
     * Get expiring documents for API.
     */
    public function getExpiringDocumentsApi(Request $request)
    {
        $daysAhead = $request->get('days', 30);
        $targetDate = Carbon::today()->addDays($daysAhead);
        
        $employeeDocuments = EmployeeDocument::with(['employee.company', 'documentType'])
            ->where('expiry_date', '<=', $targetDate)
            ->where('expiry_date', '>=', Carbon::today())
            ->orderBy('expiry_date')
            ->get()
            ->map(function ($doc) {
                return [
                    'id' => $doc->id,
                    'type' => 'employee_document',
                    'document_number' => $doc->document_number,
                    'document_type' => $doc->documentType->name_en ?? 'Unknown',
                    'employee_name' => $doc->employee->full_name_en,
                    'company_name' => $doc->employee->company->company_name_en,
                    'expiry_date' => $doc->expiry_date->format('Y-m-d'),
                    'days_to_expiry' => Carbon::today()->diffInDays($doc->expiry_date, false),
                    'status' => $doc->status,
                    'view_url' => route('admin.employees.documents.show', [$doc->employee, $doc]),
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $employeeDocuments->values(),
            'total' => $employeeDocuments->count(),
        ]);
    }
}
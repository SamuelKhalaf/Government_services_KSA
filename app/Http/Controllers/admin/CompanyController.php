<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Company::with(['employees', 'civilDefenseLicenses', 'municipalityLicenses', 'branchCommercialRegistrations']);

        // Search functionality
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by region
        if ($request->filled('region')) {
            $query->where('region', $request->region);
        }

        // Filter by company type
        if ($request->filled('company_type')) {
            $query->where('company_type', $request->company_type);
        }

        // Filter by documents expiring soon
        if ($request->boolean('expiring_soon')) {
            $query->whereHas('civilDefenseLicenses', function ($q) {
                $q->expiringSoon();
            })->orWhereHas('municipalityLicenses', function ($q) {
                $q->expiringSoon();
            })->orWhereHas('branchCommercialRegistrations', function ($q) {
                $q->expiringSoon();
            });
        }

        $companies = $query->latest()->paginate(15);

        // Get filter options
        $regions = Company::distinct()->pluck('region')->filter()->sort();
        $companyTypes = Company::distinct()->pluck('company_type')->filter()->sort();

        return view('admin.companies.index', compact('companies', 'regions', 'companyTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.companies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompanyRequest $request)
    {
        try {
            DB::beginTransaction();

            $company = Company::create($request->validated());

            DB::commit();

            return redirect()
                ->route('admin.companies.workflow', $company)
                ->with('success', __('Company created successfully. Let\'s continue with the setup workflow.'));
        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->withInput()
                ->with('error', __('An error occurred while creating the company. Please try again.'));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        $company->load([
            'employees' => function ($query) {
                $query->with('documents.documentType');
            },
            'civilDefenseLicenses',
            'municipalityLicenses',
            'branchCommercialRegistrations'
        ]);

        // Get document statistics
        $documentStats = [
            'total_employees' => $company->employees->count(),
            'active_employees' => $company->employees->where('status', 'active')->count(),
            'civil_defense_licenses' => $company->civilDefenseLicenses->count(),
            'municipality_licenses' => $company->municipalityLicenses->count(),
            'branch_registrations' => $company->branchCommercialRegistrations->count(),
            'expiring_documents' => $company->expiring_soon_documents
        ];

        return view('admin.companies.show', compact('company', 'documentStats'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        return view('admin.companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        try {
            DB::beginTransaction();

            $company->update($request->validated());

            DB::commit();

            return redirect()
                ->route('admin.companies.show', $company)
                ->with('success', __('Company updated successfully.'));
        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->withInput()
                ->with('error', __('An error occurred while updating the company. Please try again.'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        try {
            DB::beginTransaction();

            // Check if company has employees
            if ($company->employees()->count() > 0) {
                return back()->with('error', __('Cannot delete company with existing employees. Please remove all employees first.'));
            }

            $company->delete();

            DB::commit();

            return redirect()
                ->route('admin.companies.index')
                ->with('success', __('Company deleted successfully.'));
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', __('An error occurred while deleting the company. Please try again.'));
        }
    }

    /**
     * Show workflow page for company setup
     */
    public function workflow(Company $company)
    {
        // Determine current workflow step
        $currentStep = $this->determineWorkflowStep($company);

        return view('admin.companies.workflow', compact('company', 'currentStep'));
    }

    /**
     * Process workflow step
     */
    public function processWorkflowStep(Request $request, Company $company)
    {
        $step = $request->input('step');

        switch ($step) {
            case 'documents':
                return redirect()->route('admin.companies.show', $company)
                    ->with('info', __('Please upload company documents using the tabs below.'));

            case 'employees':
                return redirect()->route('admin.companies.employees.create', $company)
                    ->with('info', __('Now let\'s add employees to this company.'));

            case 'complete':
                $company->update(['workflow_completed' => true]);
                return redirect()->route('admin.companies.show', $company)
                    ->with('success', __('Company setup completed successfully!'));

            default:
                return back()->with('error', __('Invalid workflow step.'));
        }
    }

    /**
     * Search companies via AJAX
     */
    public function search(Request $request)
    {
        $query = Company::query();

        if ($request->filled('term')) {
            $query->search($request->term);
        }

        $companies = $query->select('id', 'company_name_ar', 'company_name_en', 'cr_number')
            ->limit(10)
            ->get();

        return response()->json($companies);
    }

    /**
     * Determine current workflow step
     */
    private function determineWorkflowStep(Company $company): int
    {
        // Step 1: Company created
        if ($company->exists) {
            // Step 2: Check if documents are uploaded
            $hasDocuments = $company->civilDefenseLicenses()->exists() ||
                           $company->municipalityLicenses()->exists() ||
                           $company->branchCommercialRegistrations()->exists();

            if (!$hasDocuments) {
                return 2; // Upload documents
            }

            // Step 3: Check if employees are added
            if (!$company->employees()->exists()) {
                return 3; // Add employees
            }

            // Step 4: Check if employee documents are uploaded
            $hasEmployeeDocuments = $company->employees()
                ->whereHas('documents')
                ->exists();

            if (!$hasEmployeeDocuments) {
                return 4; // Upload employee documents
            }

            // All steps completed
            return 5;
        }

        return 1; // Company creation
    }
}
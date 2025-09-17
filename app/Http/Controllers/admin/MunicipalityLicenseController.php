<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMunicipalityLicenseRequest;
use App\Http\Requests\UpdateMunicipalityLicenseRequest;
use App\Models\Company;
use App\Models\MunicipalityLicense;
use App\Services\PackageValidationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MunicipalityLicenseController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(Company $company)
    {
        $packageValidationService = new PackageValidationService();
        $packageStatus = $packageValidationService->getPackageStatus($company);
        $warnings = $packageValidationService->getWarningMessages($company);
        $canAddDocument = $packageValidationService->canAddCompanyDocument($company);

        return view('admin.companies.documents.municipality.create', compact('company', 'packageStatus', 'warnings', 'canAddDocument'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMunicipalityLicenseRequest $request, Company $company)
    {
        // Validate package limits before storing
        $packageValidationService = new PackageValidationService();
        $validation = $packageValidationService->canAddCompanyDocument($company);
        
        if (!$validation['allowed']) {
            return back()->withInput()->with('error', $validation['message']);
        }

        try {
            DB::beginTransaction();

            $licenseData = $request->validated();
            $licenseData['company_id'] = $company->id;
            
            // Handle reminder settings
            $licenseData['enable_reminder'] = $request->has('enable_reminder') ? (bool) $request->enable_reminder : false;
            $licenseData['reminder_days'] = $request->filled('reminder_days') ? (int) $request->reminder_days : null;

            // Handle file upload
            if ($request->hasFile('certificate_file')) {
                $file = $request->file('certificate_file');
                $filename = time() . '_municipality_' . $file->getClientOriginalName();
                $path = $file->storeAs('company_documents/' . $company->id . '/municipality', $filename, 'public');
                $licenseData['certificate_file_path'] = $path;
            }

            MunicipalityLicense::create($licenseData);

            DB::commit();

            return redirect()
                ->route('admin.companies.workflow', $company)
                ->with('success', __('Municipality License added successfully.'));
        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->withInput()
                ->with('error', __('An error occurred while adding the license. Please try again.'));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company, MunicipalityLicense $municipalityLicense)
    {
        // If user is employee, check if this document is assigned to them via tasks
        if (auth()->user()->isEmployee()) {
            $hasAccess = auth()->user()->assignedTasks()
                ->whereHas('taskDocuments', function ($query) use ($municipalityLicense) {
                    // Check if this municipality license is linked to any task documents assigned to the employee
                    $query->where('document_type', 'municipality')
                          ->where('document_id', $municipalityLicense->id);
                })
                ->exists();
                
            if (!$hasAccess) {
                abort(403, __('common.access_denied'));
            }
        }

        return view('admin.companies.documents.municipality.show', compact('company', 'municipalityLicense'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company, MunicipalityLicense $municipalityLicense)
    {
        // If user is employee, check if this document is assigned to them via tasks
        if (auth()->user()->isEmployee()) {
            $hasAccess = auth()->user()->assignedTasks()
                ->whereHas('taskDocuments', function ($query) use ($municipalityLicense) {
                    // Check if this municipality license is linked to any task documents assigned to the employee
                    $query->where('document_type', 'municipality')
                          ->where('document_id', $municipalityLicense->id);
                })
                ->exists();
                
            if (!$hasAccess) {
                abort(403, __('common.access_denied'));
            }
        }

        return view('admin.companies.documents.municipality.edit', compact('company', 'municipalityLicense'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMunicipalityLicenseRequest $request, Company $company, MunicipalityLicense $municipalityLicense)
    {
        try {
            DB::beginTransaction();

            $licenseData = $request->validated();
            
            // Handle reminder settings
            $licenseData['enable_reminder'] = $request->has('enable_reminder') ? (bool) $request->enable_reminder : false;
            $licenseData['reminder_days'] = $request->filled('reminder_days') ? (int) $request->reminder_days : null;

            // Handle file upload
            if ($request->hasFile('certificate_file')) {
                // Delete old file if exists
                if ($municipalityLicense->certificate_file_path && Storage::disk('public')->exists($municipalityLicense->certificate_file_path)) {
                    Storage::disk('public')->delete($municipalityLicense->certificate_file_path);
                }

                $file = $request->file('certificate_file');
                $filename = time() . '_municipality_' . $file->getClientOriginalName();
                $path = $file->storeAs('company_documents/' . $company->id . '/municipality', $filename, 'public');
                $licenseData['certificate_file_path'] = $path;
            }

            $municipalityLicense->update($licenseData);

            DB::commit();

            return redirect()
                ->route('admin.companies.municipality-licenses.show', [$company, $municipalityLicense])
                ->with('success', __('Municipality License updated successfully.'));
        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->withInput()
                ->with('error', __('An error occurred while updating the license. Please try again.'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company, MunicipalityLicense $municipalityLicense)
    {
        try {
            DB::beginTransaction();

            // Delete file if exists
            if ($municipalityLicense->certificate_file_path && Storage::disk('public')->exists($municipalityLicense->certificate_file_path)) {
                Storage::disk('public')->delete($municipalityLicense->certificate_file_path);
            }

            $municipalityLicense->delete();

            DB::commit();

            return redirect()
                ->route('admin.companies.workflow', $company)
                ->with('success', __('Municipality License deleted successfully.'));
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', __('An error occurred while deleting the license. Please try again.'));
        }
    }
}
<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCivilDefenseLicenseRequest;
use App\Http\Requests\UpdateCivilDefenseLicenseRequest;
use App\Models\Company;
use App\Models\CivilDefenseLicense;
use App\Services\PackageValidationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CivilDefenseLicenseController extends Controller
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

        return view('admin.companies.documents.civil-defense.create', compact('company', 'packageStatus', 'warnings', 'canAddDocument'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCivilDefenseLicenseRequest $request, Company $company)
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
                $filename = time() . '_civil_defense_' . $file->getClientOriginalName();
                $path = $file->storeAs('company_documents/' . $company->id . '/civil_defense', $filename, 'public');
                $licenseData['certificate_file_path'] = $path;
            }

            CivilDefenseLicense::create($licenseData);

            DB::commit();

            return redirect()
                ->route('admin.companies.workflow', $company)
                ->with('success', __('Civil Defense License added successfully.'));
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
    public function show(Company $company, CivilDefenseLicense $civilDefenseLicense)
    {
        // If user is employee, check if this document is assigned to them via tasks
        if (auth()->user()->isEmployee()) {
            $hasAccess = auth()->user()->assignedTasks()
                ->whereHas('taskDocuments', function ($query) use ($civilDefenseLicense) {
                    // Check if this civil defense license is linked to any task documents assigned to the employee
                    $query->where('document_type', 'civil_defense')
                          ->where('document_id', $civilDefenseLicense->id);
                })
                ->exists();
                
            if (!$hasAccess) {
                abort(403, __('common.access_denied'));
            }
        }

        return view('admin.companies.documents.civil-defense.show', compact('company', 'civilDefenseLicense'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company, CivilDefenseLicense $civilDefenseLicense)
    {
        // If user is employee, check if this document is assigned to them via tasks
        if (auth()->user()->isEmployee()) {
            $hasAccess = auth()->user()->assignedTasks()
                ->whereHas('taskDocuments', function ($query) use ($civilDefenseLicense) {
                    // Check if this civil defense license is linked to any task documents assigned to the employee
                    $query->where('document_type', 'civil_defense')
                          ->where('document_id', $civilDefenseLicense->id);
                })
                ->exists();
                
            if (!$hasAccess) {
                abort(403, __('common.access_denied'));
            }
        }

        return view('admin.companies.documents.civil-defense.edit', compact('company', 'civilDefenseLicense'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCivilDefenseLicenseRequest $request, Company $company, CivilDefenseLicense $civilDefenseLicense)
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
                if ($civilDefenseLicense->certificate_file_path && Storage::disk('public')->exists($civilDefenseLicense->certificate_file_path)) {
                    Storage::disk('public')->delete($civilDefenseLicense->certificate_file_path);
                }

                $file = $request->file('certificate_file');
                $filename = time() . '_civil_defense_' . $file->getClientOriginalName();
                $path = $file->storeAs('company_documents/' . $company->id . '/civil_defense', $filename, 'public');
                $licenseData['certificate_file_path'] = $path;
            }

            $civilDefenseLicense->update($licenseData);

            DB::commit();

            return redirect()
                ->route('admin.companies.civil-defense-licenses.show', [$company, $civilDefenseLicense])
                ->with('success', __('Civil Defense License updated successfully.'));
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
    public function destroy(Company $company, CivilDefenseLicense $civilDefenseLicense)
    {
        try {
            DB::beginTransaction();

            // Delete file if exists
            if ($civilDefenseLicense->certificate_file_path && Storage::disk('public')->exists($civilDefenseLicense->certificate_file_path)) {
                Storage::disk('public')->delete($civilDefenseLicense->certificate_file_path);
            }

            $civilDefenseLicense->delete();

            DB::commit();

            return redirect()
                ->route('admin.companies.workflow', $company)
                ->with('success', __('Civil Defense License deleted successfully.'));
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', __('An error occurred while deleting the license. Please try again.'));
        }
    }
}
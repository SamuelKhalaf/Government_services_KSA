<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBranchRegistrationRequest;
use App\Http\Requests\UpdateBranchRegistrationRequest;
use App\Models\Company;
use App\Models\BranchCommercialRegistration;
use App\Services\PackageValidationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BranchCommercialRegistrationController extends Controller
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

        return view('admin.companies.documents.branch-registration.create', compact('company', 'packageStatus', 'warnings', 'canAddDocument'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBranchRegistrationRequest $request, Company $company)
    {
        // Validate package limits before storing
        $packageValidationService = new PackageValidationService();
        $validation = $packageValidationService->canAddCompanyDocument($company);
        
        if (!$validation['allowed']) {
            return back()->withInput()->with('error', $validation['message']);
        }

        try {
            DB::beginTransaction();

            $registrationData = $request->validated();
            $registrationData['company_id'] = $company->id;
            
            // Handle reminder settings
            $registrationData['enable_reminder'] = $request->has('enable_reminder') ? (bool) $request->enable_reminder : false;
            $registrationData['reminder_days'] = $request->filled('reminder_days') ? (int) $request->reminder_days : null;

            // Handle file upload
            if ($request->hasFile('certificate_file')) {
                $file = $request->file('certificate_file');
                $filename = time() . '_branch_reg_' . $file->getClientOriginalName();
                $path = $file->storeAs('company_documents/' . $company->id . '/branch_registration', $filename, 'public');
                $registrationData['certificate_file_path'] = $path;
            }

            BranchCommercialRegistration::create($registrationData);

            DB::commit();

            return redirect()
                ->route('admin.companies.workflow', $company)
                ->with('success', __('Branch Commercial Registration added successfully.'));
        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->withInput()
                ->with('error', __('An error occurred while adding the registration. Please try again.'));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company, BranchCommercialRegistration $branchRegistration)
    {
        // If user is employee, check if this document is assigned to them via tasks
        if (auth()->user()->isEmployee()) {
            $hasAccess = auth()->user()->assignedTasks()
                ->whereHas('taskDocuments', function ($query) use ($branchRegistration) {
                    $query->where('document_type', 'branch_registration')
                          ->where('document_id', $branchRegistration->id);
                })
                ->exists();
                
            if (!$hasAccess) {
                abort(403, __('common.access_denied'));
            }
        }

        return view('admin.companies.documents.branch-registration.show', compact('company', 'branchRegistration'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company, BranchCommercialRegistration $branchRegistration)
    {
        // If user is employee, check if this document is assigned to them via tasks
        if (auth()->user()->isEmployee()) {
            $hasAccess = auth()->user()->assignedTasks()
                ->whereHas('taskDocuments', function ($query) use ($branchRegistration) {
                    // Check if this branch registration is linked to any task documents assigned to the employee
                    $query->where('document_type', 'branch_registration')
                          ->where('document_id', $branchRegistration->id);
                })
                ->exists();
                
            if (!$hasAccess) {
                abort(403, __('common.access_denied'));
            }
        }

        return view('admin.companies.documents.branch-registration.edit', compact('company', 'branchRegistration'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBranchRegistrationRequest $request, Company $company, BranchCommercialRegistration $branchRegistration)
    {
        try {
            DB::beginTransaction();

            $registrationData = $request->validated();
            
            // Handle reminder settings
            $registrationData['enable_reminder'] = $request->has('enable_reminder') ? (bool) $request->enable_reminder : false;
            $registrationData['reminder_days'] = $request->filled('reminder_days') ? (int) $request->reminder_days : null;

            // Handle file upload
            if ($request->hasFile('certificate_file')) {
                // Delete old file if exists
                if ($branchRegistration->certificate_file_path && Storage::disk('public')->exists($branchRegistration->certificate_file_path)) {
                    Storage::disk('public')->delete($branchRegistration->certificate_file_path);
                }

                $file = $request->file('certificate_file');
                $filename = time() . '_branch_reg_' . $file->getClientOriginalName();
                $path = $file->storeAs('company_documents/' . $company->id . '/branch_registration', $filename, 'public');
                $registrationData['certificate_file_path'] = $path;
            }

            $branchRegistration->update($registrationData);

            DB::commit();

            return redirect()
                ->route('admin.companies.branch-registrations.show', [$company, $branchRegistration])
                ->with('success', __('Branch Commercial Registration updated successfully.'));
        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->withInput()
                ->with('error', __('An error occurred while updating the registration. Please try again.'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company, BranchCommercialRegistration $branchRegistration)
    {
        try {
            DB::beginTransaction();

            // Delete file if exists
            if ($branchRegistration->certificate_file_path && Storage::disk('public')->exists($branchRegistration->certificate_file_path)) {
                Storage::disk('public')->delete($branchRegistration->certificate_file_path);
            }

            $branchRegistration->delete();

            DB::commit();

            return redirect()
                ->route('admin.companies.workflow', $company)
                ->with('success', __('Branch Commercial Registration deleted successfully.'));
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', __('An error occurred while deleting the registration. Please try again.'));
        }
    }
}
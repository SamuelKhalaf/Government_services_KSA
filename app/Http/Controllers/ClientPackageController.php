<?php

namespace App\Http\Controllers;

use App\Enums\PermissionEnum;
use App\Http\Requests\AssignPackageRequest;
use App\Http\Requests\RenewPackageRequest;
use App\Models\ClientPackage;
use App\Models\Company;
use App\Models\Package;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientPackageController extends Controller
{
    /**
     * Show the form for assigning a package to a client
     */
    public function create(Company $company)
    {
        $this->authorize('assign_packages_to_clients', PermissionEnum::ASSIGN_PACKAGES_TO_CLIENTS);
        
        $packages = Package::all();
        $activePackage = $company->active_package;
        
        return view('admin.companies.packages.assign', compact('company', 'packages', 'activePackage'));
    }

    /**
     * Assign a package to a client
     */
    public function store(AssignPackageRequest $request, Company $company)
    {
        $this->authorize('assign_packages_to_clients', PermissionEnum::ASSIGN_PACKAGES_TO_CLIENTS);
        
        try {
            DB::beginTransaction();
            
            $package = Package::findOrFail($request->package_id);
            
            // Check if client already has an active package
            $activePackage = $company->active_package;
            if ($activePackage) {
                return redirect()->back()
                    ->with('error', __('client_packages.messages.client_has_active_package'));
            }
            
            // Calculate dates
            $startDate = now();
            $endDate = $startDate->copy()->addMonths($package->duration);
            
            // Create client package assignment
            ClientPackage::create([
                'client_id' => $company->id,
                'package_id' => $package->id,
                'start_date' => $startDate,
                'end_date' => $endDate,
                'status' => 'active',
            ]);
            
            // Create invoice for assigned package
            Invoice::create([
                'client_id' => $company->id,
                'package_id' => $package->id,
                'amount' => $package->price,
                'issue_date' => now(),
                'due_date' => now()->copy()->addDays(14),
                'payment_status' => 'pending',
            ]);
            
            DB::commit();
            
            return redirect()->route('admin.companies.show', $company)
                ->with('success', __('client_packages.messages.package_assigned_successfully'));
                
        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->back()
                ->with('error', __('common.messages.something_went_wrong'));
        }
    }

    /**
     * Show the form for renewing a package
     */
    public function edit(Company $company, ClientPackage $clientPackage)
    {
        $this->authorize('renew_client_packages', PermissionEnum::RENEW_CLIENT_PACKAGES);
        
        // Verify the package belongs to the company
        if ($clientPackage->client_id !== $company->id) {
            abort(404);
        }
        
        return view('admin.companies.packages.renew', compact('company', 'clientPackage'));
    }

    /**
     * Renew a package (extend end date)
     */
    public function update(RenewPackageRequest $request, Company $company, ClientPackage $clientPackage)
    {
        $this->authorize('renew_client_packages', PermissionEnum::RENEW_CLIENT_PACKAGES);
        
        try {
            DB::beginTransaction();
            
            // Verify the package belongs to the company
            if ($clientPackage->client_id !== $company->id) {
                abort(404);
            }
            
            // Extend the end date by the package duration
            $newEndDate = $clientPackage->end_date->addMonths($clientPackage->package->duration);
            
            $clientPackage->update([
                'end_date' => $newEndDate,
                'status' => 'active', // Ensure it's active after renewal
            ]);
            
            // Create invoice for renewal
            Invoice::create([
                'client_id' => $company->id,
                'package_id' => $clientPackage->package_id,
                'amount' => $clientPackage->package->price,
                'issue_date' => now(),
                'due_date' => now()->copy()->addDays(14),
                'payment_status' => 'pending',
            ]);
            
            DB::commit();
            
            return redirect()->route('admin.companies.show', $company)
                ->with('success', __('client_packages.messages.package_renewed_successfully'));
                
        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->back()
                ->with('error', __('common.messages.something_went_wrong'));
        }
    }

    /**
     * Cancel a package
     */
    public function destroy(Company $company, ClientPackage $clientPackage)
    {
        $this->authorize('cancel_client_packages', PermissionEnum::CANCEL_CLIENT_PACKAGES);
        
        try {
            DB::beginTransaction();
            
            // Verify the package belongs to the company
            if ($clientPackage->client_id !== $company->id) {
                abort(404);
            }
            
            // Cancel the package
            $clientPackage->update([
                'status' => 'canceled',
            ]);
            
            // Mark related invoices as cancelled
            Invoice::where('client_id', $company->id)
                   ->where('package_id', $clientPackage->package_id)
                   ->whereIn('payment_status', ['pending', 'overdue'])
                   ->update(['payment_status' => 'cancelled']);
            
            DB::commit();
            
            return redirect()->route('admin.companies.show', $company)
                ->with('success', __('client_packages.messages.package_canceled_successfully'));
                
        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->back()
                ->with('error', __('common.messages.something_went_wrong'));
        }
    }

    /**
     * Change package (cancel current and assign new)
     */
    public function change(Company $company, ClientPackage $clientPackage)
    {
        $this->authorize('assign_packages_to_clients', PermissionEnum::ASSIGN_PACKAGES_TO_CLIENTS);
        
        // Verify the package belongs to the company
        if ($clientPackage->client_id !== $company->id) {
            abort(404);
        }
        
        $packages = Package::all();
        
        return view('admin.companies.packages.change', compact('company', 'clientPackage', 'packages'));
    }

    /**
     * Process package change
     */
    public function changePackage(Request $request, Company $company, ClientPackage $clientPackage)
    {
        $this->authorize('assign_packages_to_clients', PermissionEnum::ASSIGN_PACKAGES_TO_CLIENTS);
        
        $request->validate([
            'package_id' => 'required|exists:packages,id',
        ]);
        
        try {
            DB::beginTransaction();
            
            // Verify the package belongs to the company
            if ($clientPackage->client_id !== $company->id) {
                abort(404);
            }
            
            $newPackage = Package::findOrFail($request->package_id);
            
            // Cancel current package
            $clientPackage->update([
                'status' => 'canceled',
            ]);
            
            // Mark old package invoices as cancelled
            Invoice::where('client_id', $company->id)
                   ->where('package_id', $clientPackage->package_id)
                   ->whereIn('payment_status', ['pending', 'overdue'])
                   ->update(['payment_status' => 'cancelled']);
            
            // Calculate dates for new package
            $startDate = now();
            $endDate = $startDate->copy()->addMonths($newPackage->duration);
            
            // Create new package assignment
            ClientPackage::create([
                'client_id' => $company->id,
                'package_id' => $newPackage->id,
                'start_date' => $startDate,
                'end_date' => $endDate,
                'status' => 'active',
            ]);
            
            // Create invoice for changed package
            Invoice::create([
                'client_id' => $company->id,
                'package_id' => $newPackage->id,
                'amount' => $newPackage->price,
                'issue_date' => now(),
                'due_date' => now()->copy()->addDays(14),
                'payment_status' => 'pending',
            ]);
            
            DB::commit();
            
            return redirect()->route('admin.companies.show', $company)
                ->with('success', __('client_packages.messages.package_changed_successfully'));
                
        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->back()
                ->with('error', __('common.messages.something_went_wrong'));
        }
    }
}

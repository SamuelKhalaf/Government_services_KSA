<?php

namespace App\Http\Controllers;

use App\Enums\PermissionEnum;
use App\Http\Requests\StorePackageRequest;
use App\Http\Requests\UpdatePackageRequest;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PackageController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $packages = Package::latest()->paginate(15);
        
        return view('admin.packages.index', compact('packages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.packages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePackageRequest $request)
    {
        try {
            DB::beginTransaction();
            
            Package::create($request->validated());
            
            DB::commit();
            
            return redirect()->route('admin.packages.index')
                ->with('success', __('common.messages.created_successfully'));
                
        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->back()
                ->withInput()
                ->with('error', __('common.messages.something_went_wrong'));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Package $package)
    {
        $package->load(['clientPackages.company', 'invoices.company']);
        
        return view('admin.packages.show', compact('package'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Package $package)
    {
        return view('admin.packages.edit', compact('package'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePackageRequest $request, Package $package)
    {
        try {
            DB::beginTransaction();
            
            $package->update($request->validated());
            
            DB::commit();
            
            return redirect()->route('admin.packages.index')
                ->with('success', __('common.messages.updated_successfully'));
                
        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->back()
                ->withInput()
                ->with('error', __('common.messages.something_went_wrong'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Package $package)
    {
        try {
            DB::beginTransaction();
            
            // Check if package has active client assignments
            $activeAssignments = $package->clientPackages()
                ->where('status', 'active')
                ->where('end_date', '>=', now()->toDateString())
                ->count();
                
            if ($activeAssignments > 0) {
                return redirect()->back()
                    ->with('error', __('packages.messages.cannot_delete_active_package'));
            }
            
            $package->delete();
            
            DB::commit();
            
            return redirect()->route('admin.packages.index')
                ->with('success', __('common.messages.deleted_successfully'));
                
        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->back()
                ->with('error', __('common.messages.something_went_wrong'));
        }
    }
}

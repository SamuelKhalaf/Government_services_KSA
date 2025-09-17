<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $unusedPermissions = [
            'view_analytics',
            'manage_system_settings',
            'activate_deactivate_users',
            'assign_clients_to_employees',
            'approve_documents',
            'assign_tasks',
            'view_reports',
            'export_reports',
            'view_employee_performance',
        ];

        // Remove permissions from database
        foreach ($unusedPermissions as $permissionName) {
            $permission = Permission::where('name', $permissionName)->first();
            if ($permission) {
                // Remove from role_has_permissions table first
                DB::table('role_has_permissions')
                    ->where('permission_id', $permission->id)
                    ->delete();
                
                // Remove from model_has_permissions table
                DB::table('model_has_permissions')
                    ->where('permission_id', $permission->id)
                    ->delete();
                
                // Finally delete the permission
                $permission->delete();
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $unusedPermissions = [
            'view_analytics',
            'manage_system_settings',
            'activate_deactivate_users',
            'assign_clients_to_employees',
            'approve_documents',
            'assign_tasks',
            'view_reports',
            'export_reports',
            'view_employee_performance',
        ];

        // Recreate permissions (this is for rollback purposes)
        foreach ($unusedPermissions as $permissionName) {
            Permission::create([
                'name' => $permissionName,
                'guard_name' => 'web'
            ]);
        }
    }
};
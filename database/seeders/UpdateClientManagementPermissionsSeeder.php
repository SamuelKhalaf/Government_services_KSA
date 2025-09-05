<?php

namespace Database\Seeders;

use App\Enums\PermissionEnum;
use App\Enums\RoleEnum;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UpdateClientManagementPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Adding new Client Management permissions...');

        // New permissions to add
        $newPermissions = [
            PermissionEnum::VIEW_COMPANY_DOCUMENTS,
            PermissionEnum::CREATE_COMPANY_DOCUMENTS,
            PermissionEnum::UPDATE_COMPANY_DOCUMENTS,
            PermissionEnum::DELETE_COMPANY_DOCUMENTS,
            PermissionEnum::MANAGE_CIVIL_DEFENSE_LICENSES,
            PermissionEnum::MANAGE_MUNICIPALITY_LICENSES,
            PermissionEnum::MANAGE_BRANCH_REGISTRATIONS,
            PermissionEnum::VIEW_DOCUMENT_DASHBOARD,
        ];

        $createdCount = 0;

        foreach ($newPermissions as $permission) {
            $permissionModel = Permission::firstOrCreate([
                'name' => $permission->value,
                'guard_name' => 'web'
            ]);

            if ($permissionModel->wasRecentlyCreated) {
                $createdCount++;
                $this->command->info("Created permission: {$permission->value}");
            }
        }

        $this->command->info("Created {$createdCount} new permissions.");

        // Update Admin role to have all permissions
        $adminRole = Role::where('name', RoleEnum::ADMIN->value)->first();
        if ($adminRole) {
            $adminRole->givePermissionTo(PermissionEnum::all());
            $this->command->info('Updated Admin role with all permissions.');
        }

        // Update Employee role with specific client management permissions
        $employeeRole = Role::where('name', RoleEnum::EMPLOYEE->value)->first();
        if ($employeeRole) {
            $employeePermissions = [
                PermissionEnum::VIEW_ASSIGNED_CLIENTS->value,
                PermissionEnum::UPDATE_CLIENTS->value,
                PermissionEnum::VIEW_CLIENT_EMPLOYEES->value,
                PermissionEnum::CREATE_CLIENT_EMPLOYEES->value,
                PermissionEnum::UPDATE_CLIENT_EMPLOYEES->value,
                PermissionEnum::VIEW_ASSIGNED_DOCUMENTS->value,
                PermissionEnum::UPLOAD_DOCUMENTS->value,
                PermissionEnum::UPDATE_DOCUMENTS->value,
                PermissionEnum::DOWNLOAD_DOCUMENTS->value,
                PermissionEnum::VIEW_DOCUMENT_DASHBOARD->value,
            ];

            $employeeRole->givePermissionTo($employeePermissions);
            $this->command->info('Updated Employee role with client management permissions.');
        }

        $this->command->info('Client Management permissions setup completed successfully!');
    }
}

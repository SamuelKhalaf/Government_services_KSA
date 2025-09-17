<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Enums\PermissionEnum;
use App\Enums\RoleEnum;

class AssignMonitoringPermissionsToAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all admin users
        $adminUsers = User::whereHas('roles', function ($query) {
            $query->where('name', RoleEnum::ADMIN->value);
        })->get();

        // Assign all monitoring permissions to admin users
        $monitoringPermissions = [
            PermissionEnum::VIEW_EMPLOYEE_MONITORING->value,
            PermissionEnum::VIEW_EMPLOYEE_LOGIN_LOGS->value,
            PermissionEnum::VIEW_EMPLOYEE_ACTIVITY_LOGS->value,
            PermissionEnum::VIEW_EMPLOYEE_CLICK_TRACKING->value,
            PermissionEnum::VIEW_EMPLOYEE_SCREEN_TIME->value,
            PermissionEnum::VIEW_EMPLOYEE_SCREENSHOTS->value,
            PermissionEnum::MANAGE_EMPLOYEE_MONITORING->value,
        ];

        foreach ($adminUsers as $admin) {
            $admin->givePermissionTo($monitoringPermissions);
        }

        $this->command->info('Employee monitoring permissions assigned to ' . $adminUsers->count() . ' admin users.');
    }
}

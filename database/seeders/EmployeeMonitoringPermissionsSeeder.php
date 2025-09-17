<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use App\Enums\PermissionEnum;

class EmployeeMonitoringPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            PermissionEnum::VIEW_EMPLOYEE_MONITORING->value,
            PermissionEnum::VIEW_EMPLOYEE_LOGIN_LOGS->value,
            PermissionEnum::VIEW_EMPLOYEE_ACTIVITY_LOGS->value,
            PermissionEnum::VIEW_EMPLOYEE_CLICK_TRACKING->value,
            PermissionEnum::VIEW_EMPLOYEE_SCREEN_TIME->value,
            PermissionEnum::VIEW_EMPLOYEE_SCREENSHOTS->value,
            PermissionEnum::MANAGE_EMPLOYEE_MONITORING->value,
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $this->command->info('Employee Monitoring permissions created successfully.');
    }
}
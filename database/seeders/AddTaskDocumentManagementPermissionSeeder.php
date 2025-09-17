<?php

namespace Database\Seeders;

use App\Enums\PermissionEnum;
use App\Enums\RoleEnum;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AddTaskDocumentManagementPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Adding Task Document Management permission...');

        // Create the new permission
        $permission = Permission::firstOrCreate([
            'name' => PermissionEnum::MANAGE_TASK_DOCUMENTS->value,
            'guard_name' => 'web'
        ]);

        if ($permission->wasRecentlyCreated) {
            $this->command->info("Created permission: {$permission->name}");
        } else {
            $this->command->info("Permission already exists: {$permission->name}");
        }

        // Assign to Admin role
        $adminRole = Role::where('name', RoleEnum::ADMIN->value)->first();
        if ($adminRole) {
            $adminRole->givePermissionTo($permission);
            $this->command->info('Assigned permission to Admin role.');
        }

        // Optionally assign to specific users or other roles as needed
        // For now, only admins can manage task documents
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use App\Enums\PermissionEnum;

class DatabaseBackupPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create the database backup permission
        $permission = Permission::firstOrCreate([
            'name' => PermissionEnum::MANAGE_DATABASE_BACKUP->value,
        ], [
            'guard_name' => 'web',
        ]);

        // Assign the permission to admin role
        $adminRole = \Spatie\Permission\Models\Role::where('name', 'admin')->first();
        if ($adminRole && !$adminRole->hasPermissionTo($permission)) {
            $adminRole->givePermissionTo($permission);
        }

        $this->command->info('Database backup permission created and assigned to admin role.');
    }
}
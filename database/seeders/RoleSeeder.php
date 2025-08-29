<?php

namespace Database\Seeders;

use App\Enums\PermissionEnum;
use App\Enums\RoleEnum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disable foreign key checks to avoid constraint errors
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Truncate tables (delete all data)
        Role::truncate();
        Permission::truncate();
        DB::table('role_has_permissions')->truncate();
        DB::table('model_has_roles')->truncate();
        DB::table('model_has_permissions')->truncate();

        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->command->info('Creating permissions...');
        
        // Create all permissions
        foreach (PermissionEnum::all() as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web'
            ]);
        }

        $this->command->info('Created ' . count(PermissionEnum::all()) . ' permissions.');

        $this->command->info('Creating roles...');

        // Create Admin Role with all permissions
        $adminRole = Role::firstOrCreate([
            'name' => RoleEnum::ADMIN->value,
            'guard_name' => 'web'
        ]);
        
        // Give admin all permissions
        $adminRole->givePermissionTo(PermissionEnum::adminPermissions());
        
        $this->command->info('Admin role created with ' . count(PermissionEnum::adminPermissions()) . ' permissions.');

        // Create Employee Role with restricted permissions
        $employeeRole = Role::firstOrCreate([
            'name' => RoleEnum::EMPLOYEE->value,
            'guard_name' => 'web'
        ]);
        
        // Give employee only specific permissions
        $employeeRole->givePermissionTo(PermissionEnum::employeePermissions());
        
        $this->command->info('Employee role created with ' . count(PermissionEnum::employeePermissions()) . ' permissions.');

        $this->command->info('Roles and permissions seeded successfully!');
    }
}

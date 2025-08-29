<?php

namespace Database\Seeders;

use App\Enums\PermissionEnum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class NewPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Checking for new permissions...');
        
        // Get all permissions from PermissionEnum
        $allPermissions = PermissionEnum::all();
        
        $createdCount = 0;
        
        // Check each permission and create if it doesn't exist
        foreach ($allPermissions as $permissionName) {
            $permission = Permission::firstOrCreate([
                'name' => $permissionName,
                'guard_name' => 'web'
            ]);
            
            if ($permission->wasRecentlyCreated) {
                $createdCount++;
                $this->command->info("Created new permission: {$permissionName}");
            }
        }
        
        if ($createdCount > 0) {
            $this->command->info("Successfully created {$createdCount} new permissions.");
        } else {
            $this->command->info("All permissions already exist. No new permissions created.");
        }
    }
}

<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Seeding users...');

        // Create Admin User
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'مدير النظام',
                'phone_number' => '+966500000001',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'status' => 'active',
                'national_id' => '1234567890',
                'preferred_language' => 'ar',
                'address' => 'الرياض، المملكة العربية السعودية',
            ]
        );

        // Get admin role
        $adminRole = Role::where('name', RoleEnum::ADMIN->value)->first();
        if ($adminRole) {
            $admin->assignRole($adminRole);
            $this->command->info('Admin user created and assigned admin role.');
        }

        // Create Sample Employee User
        $employee = User::firstOrCreate(
            ['email' => 'employee@example.com'],
            [
                'name' => 'موظف إدخال البيانات',
                'phone_number' => '+966500000002',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'status' => 'active',
                'national_id' => '0987654321',
                'preferred_language' => 'ar',
                'address' => 'جدة، المملكة العربية السعودية',
                'created_by' => $admin->id,
            ]
        );

        // Get employee role
        $employeeRole = Role::where('name', RoleEnum::EMPLOYEE->value)->first();
        if ($employeeRole) {
            $employee->assignRole($employeeRole);
            $this->command->info('Employee user created and assigned employee role.');
        }

        // Create additional sample employees if needed
        $this->createSampleEmployees($admin, $employeeRole);

        $this->command->info('Users seeded successfully!');
    }

    /**
     * Create additional sample employees for testing
     */
    private function createSampleEmployees(User $admin, $employeeRole): void
    {
        $sampleEmployees = [
            [
                'name' => 'أحمد محمد العبدالله',
                'email' => 'ahmed@example.com',
                'phone_number' => '+966500000003',
                'national_id' => '1111111111',
            ],
            [
                'name' => 'فاطمة علي الأحمد',
                'email' => 'fatima@example.com',
                'phone_number' => '+966500000004',
                'national_id' => '2222222222',
            ],
            [
                'name' => 'محمد عبدالرحمن السعد',
                'email' => 'mohammed@example.com',
                'phone_number' => '+966500000005',
                'national_id' => '3333333333',
            ],
        ];

        foreach ($sampleEmployees as $employeeData) {
            $employee = User::firstOrCreate(
                ['email' => $employeeData['email']],
                array_merge($employeeData, [
                    'password' => Hash::make('password'),
                    'email_verified_at' => now(),
                    'status' => 'active',
                    'preferred_language' => 'ar',
                    'address' => 'المملكة العربية السعودية',
                    'created_by' => $admin->id,
                ])
            );

            if ($employeeRole) {
                $employee->assignRole($employeeRole);
            }
        }

        $this->command->info('Sample employees created successfully.');
    }
}

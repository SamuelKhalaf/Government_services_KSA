<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PackageDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Seeding Packages and Client Packages...');

        // Seed packages
        $this->seedPackages();
        
        // Seed client packages
        $this->seedClientPackages();

        $this->command->info('Packages and Client Packages seeded successfully!');
    }

    private function seedPackages()
    {
        $packages = [
            [
                'id' => 1, 'name' => 'الباقه الفضية', 'description' => 'Molestiae magna fugi',
                'max_employees' => 5, 'max_employee_documents' => 5, 'max_company_documents' => 5,
                'price' => 500.00, 'duration' => 12,
                'created_at' => '2025-09-07 23:34:55', 'updated_at' => '2025-09-12 20:14:20'
            ],
            [
                'id' => 5, 'name' => 'الباقة الذهبية', 'description' => 'Suscipit aliquid fug',
                'max_employees' => 20, 'max_employee_documents' => 10, 'max_company_documents' => 10,
                'price' => 1000.00, 'duration' => 12,
                'created_at' => '2025-09-07 23:48:19', 'updated_at' => '2025-09-12 20:14:32'
            ],
            [
                'id' => 7, 'name' => 'الباقه البلاتينيه', 'description' => null,
                'max_employees' => null, 'max_employee_documents' => null, 'max_company_documents' => null,
                'price' => 2000.00, 'duration' => 12,
                'created_at' => '2025-09-12 19:34:10', 'updated_at' => '2025-09-12 19:34:10'
            ],
        ];

        foreach ($packages as $package) {
            DB::table('packages')->updateOrInsert(
                ['id' => $package['id']],
                $package
            );
        }
    }

    private function seedClientPackages()
    {
        $clientPackages = [
            [
                'id' => 1, 'client_id' => 7, 'package_id' => 1, 'start_date' => '2024-09-08',
                'end_date' => '2026-09-08', 'status' => 'active',
                'created_at' => '2025-09-08 01:02:40', 'updated_at' => '2025-09-12 21:04:47'
            ],
            [
                'id' => 4, 'client_id' => 6, 'package_id' => 1, 'start_date' => '2025-09-13',
                'end_date' => '2026-09-13', 'status' => 'active',
                'created_at' => '2025-09-12 21:05:28', 'updated_at' => '2025-09-12 21:05:28'
            ],
            [
                'id' => 5, 'client_id' => 4, 'package_id' => 1, 'start_date' => '2025-09-13',
                'end_date' => '2026-09-13', 'status' => 'active',
                'created_at' => '2025-09-12 21:05:50', 'updated_at' => '2025-09-12 21:05:50'
            ],
            [
                'id' => 6, 'client_id' => 2, 'package_id' => 1, 'start_date' => '2025-09-16',
                'end_date' => '2026-09-16', 'status' => 'active',
                'created_at' => '2025-09-16 19:00:03', 'updated_at' => '2025-09-16 19:00:03'
            ],
        ];

        foreach ($clientPackages as $clientPackage) {
            DB::table('client_packages')->updateOrInsert(
                ['id' => $clientPackage['id']],
                $clientPackage
            );
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BasicDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Starting Basic Data Seeding...');

        // Seed in order to respect foreign key constraints
        $this->call([
            UserDataSeeder::class,
            CompanyDataSeeder::class,
            DocumentDataSeeder::class,
            PackageDataSeeder::class,
            TaskDataSeeder::class,
            NotificationDataSeeder::class,
            EmployeeMonitoringDataSeeder::class,
            SystemDataSeeder::class,
        ]);

        $this->command->info('Basic Data Seeding completed successfully!');
    }
}

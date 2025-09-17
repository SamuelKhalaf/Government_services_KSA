<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Check if running on Railway (production environment)
        // if (app()->environment('production') || env('RAILWAY_ENVIRONMENT')) {
        //     $this->call(RailwaySeeder::class);
        // } else {
        //     // Local development - run all seeders
        //     $this->call(RoleSeeder::class);
        //     $this->call(UserSeeder::class);
        //     $this->call(DocumentTypeSeeder::class);
            $this->call(BasicDataSeeder::class);
        // }
    }
}

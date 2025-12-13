<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Run seeders in order
        $this->call([
            AdminUserSeeder::class,  // Create admin user first
            CategorySeeder::class,    // Create categories second (products need categories)
            ProductSeeder::class,     // Create products last (depends on categories)
        ]);
    }
}

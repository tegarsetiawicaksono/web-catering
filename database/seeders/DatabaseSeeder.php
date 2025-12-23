<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\MenuSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Call Seeders
        $this->call([
            MenuSeeder::class,
            CreateAdminSeeder::class
        ]);
    }
}

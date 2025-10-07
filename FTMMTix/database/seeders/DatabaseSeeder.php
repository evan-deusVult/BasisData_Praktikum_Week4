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
        $this->call([
            StudentSeeder::class,
            BankSeeder::class,
            DemoSeeder::class,
            AdminSeeder::class,
            UserAdminSeeder::class,
            LecturerSeeder::class,
        ]);
    }
}

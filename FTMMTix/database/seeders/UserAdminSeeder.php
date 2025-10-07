<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserAdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            [ 'email' => 'admin@ftmm.ac.id' ],
            [
                'name' => 'Admin',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Student; 

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Student::updateOrCreate(
            ['nim' => 'admin'],
            [
                'name' => 'Administrator',
                'email' => 'admin@ftmm.ac.id',
                'password' => Hash::make('admin123'),
                'role' => 'admin', // kalau ada kolom role
            ]
        );
    }
}

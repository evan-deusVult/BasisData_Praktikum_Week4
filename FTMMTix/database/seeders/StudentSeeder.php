<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Student;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        Student::updateOrCreate(
            ['nim' => '164231011'],
            ['name' => 'Gizha', 'email' => 'gizha.pradipta-2023@ftmm.ac.id', 'password' => Hash::make('password123')]
        );
        Student::updateOrCreate(
            ['nim' => '164221089'],
            ['name' => 'Cendekia', 'email' => 'Cendekia.Muhammad-2022@ftmm.ac.id', 'password' => Hash::make('password123')]
        );
        Student::updateOrCreate(
            ['nim' => '164231056'],
            ['name' => 'Gracia', 'email' => 'Gracia.Angela-2023@ftmm.ac.id', 'password' => Hash::make('password123')]
        );
        Student::updateOrCreate(
            ['nim' => '164231061'],
            ['name' => 'Evan', 'email' => 'Evan.Nathaniel-2023@ftmm.ac.id', 'password' => Hash::make('password123')]
        );
        Student::updateOrCreate(
            ['nim' => '164231069'],
            ['name' => 'Ghaly', 'email' => 'Ghaly.Anargya-2023@ftmm.ac.id', 'password' => Hash::make('password123')]
        );
    }
}

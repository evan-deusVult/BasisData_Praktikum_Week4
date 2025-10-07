<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LecturerSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('lecturers')->insert([
            [
                'name' => 'Dr. Budi Santoso',
                'nip' => '197812312022011001',
                'email' => 'budi.santoso@univ.ac.id',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Prof. Siti Aminah',
                'nip' => '198005052022021002',
                'email' => 'siti.aminah@univ.ac.id',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

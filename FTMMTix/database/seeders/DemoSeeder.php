<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class DemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void 
    {

        \App\Models\Student::updateOrCreate(
            ['nim' => '11223344'],
            [
                'name' => 'Mahasiswa Demo',
                'email' => 'demo@ftmm.ac.id',
                'password' => Hash::make('password')
            ]
        );

        $e = \App\Models\Event::updateOrCreate(
            ['slug' => 'ftmm-tech-day-2025'],
            [
                'title'=>'FTMM Tech Day 2025',
                'venue'=>'Auditorium FTMM',
                'start_at'=>now()->addDays(7),
                'end_at'=>now()->addDays(7)->addHours(4),
                'description'=>'Talkshow & Expo teknologi',
                'is_published'=>true,
            ]
        );
        \App\Models\TicketType::insert([
            ['event_id'=>$e->id,'name'=>'Presale','price'=>25000,'quota'=>200],
            ['event_id'=>$e->id,'name'=>'Regular','price'=>40000,'quota'=>500],
        ]);
    }

}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void 
    {
        \App\Models\Bank::insert([
            ['name'=>'BCA','code'=>'014','account_name'=>'FTMM Event','account_number'=>'1234567890','is_active'=>true],
            ['name'=>'BNI','code'=>'009','account_name'=>'FTMM Event','account_number'=>'9988776655','is_active'=>true],
            ['name'=>'BRI','code'=>'002','account_name'=>'FTMM Event','account_number'=>'0011223344','is_active'=>true],
            ['name'=>'Mandiri','code'=>'008','account_name'=>'FTMM Event','account_number'=>'5566778899','is_active'=>true],
        ]);
    }

}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DongiahangcongkenhSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        {
            DB::table('dongiahangcongkenhs')->insert([
                [                    
                    'dongia' => 50000,                   
                ],               
            ]);
        }
    }
}

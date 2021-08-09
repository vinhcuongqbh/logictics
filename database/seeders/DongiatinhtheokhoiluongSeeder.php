<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DongiatinhtheokhoiluongSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dongiatinhtheokhoiluongs')->insert([
            [    
                'khoiluongmax' => 11,      
                'dongia' => 215000,                   
            ],
            [          
                'khoiluongmax' => 31,      
                'dongia' => 210000,                   
            ],  
            [          
                'khoiluongmax' => 61,      
                'dongia' => 200000,                   
            ],
            [          
                'khoiluongmax' => 500,      
                'dongia' => 195000,                   
            ],
        ]);
    }
}

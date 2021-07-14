<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DongiatinhtheosoluongSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dongiatinhtheosoluongs')->insert([
            [          
                'tenmathang' => 'Airpods',      
                'dongia' => 320000,                   
            ],
            [          
                'tenmathang' => 'Apple Watch',      
                'dongia' => 430000,                   
            ],  
            [          
                'tenmathang' => 'iphone dưới X',      
                'dongia' => 750000,                   
            ],
            [          
                'tenmathang' => 'iPhone từ X đến dưới 12',      
                'dongia' => 950000,                   
            ],
            [          
                'tenmathang' => 'iPad dưới 60.000 Yên',      
                'dongia' => 750000,                   
            ],
            [          
                'tenmathang' => 'iPad từ 60.000 Yên trở lên',      
                'dongia' => 950000,                   
            ],
            [          
                'tenmathang' => 'Laptop/Macbook dưới 4kg',      
                'dongia' => 1500000,                   
            ],
            [          
                'tenmathang' => 'Laptop/Macbook từ 4kg trở lên',      
                'dongia' => 0,                   
            ],
            [          
                'tenmathang' => 'Thuốc lá',      
                'dongia' => 380000,                   
            ],
            [          
                'tenmathang' => 'Thuốc lá điện tử',      
                'dongia' => 0,                   
            ],
            [          
                'tenmathang' => 'Linh kiện máy tính',      
                'dongia' => 250000,                   
            ],
        ]);
    }
}

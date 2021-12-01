<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ThongtincongtySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('thongtincongtys')->insert([
            [                
                'tencongty' => 'Công ty vận tải ETRACK',
                'diachi' => 'Tokyo - Nhật Bản',
                'sodienthoai' => '+81 48-400-2787',
                'email' => 'etrack@gmail.com',
                'website' => 'etrack.co.jp',
                'slogan' => 'Order mua hàng Nhật & vận chuyển an toàn số 1 Nhật Bản',
            ],
        ]);
    }
}

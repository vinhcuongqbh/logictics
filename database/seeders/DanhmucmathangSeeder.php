<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DanhmucmathangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('danhmucmathangs')->insert([
            [
                'tenmathang' => 'Airpods',
            ],
            [
                'tenmathang' => 'Apple Watch',
            ],
            [
                'tenmathang' => 'iphone dưới X',
            ],
            [
                'tenmathang' => 'iPhone từ X đến dưới 12',
            ],
            [
                'tenmathang' => 'iPad dưới 60.000 Yên',
            ],
            [
                'tenmathang' => 'iPad từ 60.000 Yên trở lên',
            ],
            [
                'tenmathang' => 'Laptop/Macbook dưới 4kg',
            ],
            [
                'tenmathang' => 'Laptop/Macbook từ 4kg trở lên',
            ],
            [
                'tenmathang' => 'Thuốc lá',
            ],
            [
                'tenmathang' => 'Thuốc lá điện tử',
            ],
            [
                'tenmathang' => 'Linh kiện máy tính',
            ],
            [
                'tenmathang' => 'Hàng thông thường',
            ],
            [
                'tenmathang' => 'Hàng cồng kềnh',
            ],
        ]);
    }
}

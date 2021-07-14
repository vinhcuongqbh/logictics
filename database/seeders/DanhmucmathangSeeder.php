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
                'cachtinhdongia' => 1,
            ],
            [
                'tenmathang' => 'Apple Watch',
                'cachtinhdongia' => 1,
            ],
            [
                'tenmathang' => 'iphone dưới X',
                'cachtinhdongia' => 1,
            ],
            [
                'tenmathang' => 'iPhone từ X đến dưới 12',
                'cachtinhdongia' => 1,
            ],
            [
                'tenmathang' => 'iPad dưới 60.000 Yên',
                'cachtinhdongia' => 1,
            ],
            [
                'tenmathang' => 'iPad từ 60.000 Yên trở lên',
                'cachtinhdongia' => 1,
            ],
            [
                'tenmathang' => 'Laptop/Macbook dưới 4kg',
                'cachtinhdongia' => 1,
            ],
            [
                'tenmathang' => 'Laptop/Macbook từ 4kg trở lên',
                'cachtinhdongia' => 1,
            ],
            [
                'tenmathang' => 'Thuốc lá',
                'cachtinhdongia' => 1,
            ],
            [
                'tenmathang' => 'Thuốc lá điện tử',
                'cachtinhdongia' => 1,
            ],
            [
                'tenmathang' => 'Linh kiện máy tính',
                'cachtinhdongia' => 1,
            ],
            [
                'tenmathang' => 'Hàng thông thường',
                'cachtinhdongia' => 2,
            ],
            [
                'tenmathang' => 'Hàng cồng kềnh',
                'cachtinhdongia' => 3,
            ],
        ]);
    }
}

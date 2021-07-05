<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LoaihangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('loaihangs')->insert([
            [
                'id' => 1,
                'tenloaihang' => 'Nhóm Hàng hóa thông thường',
                'id_trangthai' => 1,
            ],
            [
                'id' => 2,
                'tenloaihang' => 'Nhóm Hàng hóa điện tử',
                'id_trangthai' => 1,
            ],
            [
                'id' => 3,
                'tenloaihang' => 'Nhóm Hàng hóa cồng kềnh',
                'id_trangthai' => 1,
            ],
            [
                'id' => 4,
                'tenloaihang' => 'Nhóm Hàng hóa đặc biệt',
                'id_trangthai' => 1,
            ],
        ]);
    }
}

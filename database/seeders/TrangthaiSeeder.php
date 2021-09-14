<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class TrangthaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('trangthais')->insert([
            [
                'id' => 1,
                'tentrangthai' => 'Đơn hàng được khởi tạo',
            ],
            [
                'id' => 2,
                'tentrangthai' => 'Đơn hàng được nhập kho',
            ],
            [
                'id' => 3,
                'tentrangthai' => 'Đơn hàng được xuất kho',
            ],
            [
                'id' => 4,
                'tentrangthai' => 'Đơn hàng được giao thành công',
            ],
            [
                'id' => 5,
                'tentrangthai' => 'Đơn hàng được giao không thành công',
            ],
            [
                'id' => 6,
                'tentrangthai' => 'Đơn hàng bị thất lạc',
            ],
            [
                'id' => 7,
                'tentrangthai' => 'Đơn hàng bị xóa',
            ],
        ]);
    }
}

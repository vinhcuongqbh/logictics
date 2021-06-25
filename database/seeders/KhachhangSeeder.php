<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Khachhang;

class KhachhangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $khachhang = Khachhang::factory()->count(100)->create();

        /*
        DB::table('khachhangs')->insert([
            [
                'tenkhachhang' => 'Khách hàng 1',
                'email' => 'khachhang1@gmail.com',
                'sodienthoai' => '+123456789',
                'diachi' => 'Phường Đồng Hải - TP. Đồng Hới - tỉnh Quảng Bình',
            ],
            [
                'tenkhachhang' => 'Khách hàng 2',
                'email' => 'khachhang2@gmail.com',
                'sodienthoai' => '+123456789',
                'diachi' => 'Phường Đồng Phú - TP. Đồng Hới - tỉnh Quảng Bình',
            ],
            [
                'tenkhachhang' => 'Khách hàng 3',
                'email' => 'khachhan3@gmail.com',
                'sodienthoai' => '+123456789',
                'diachi' => 'Phường Bắc Lý - TP. Đồng Hới - tỉnh Quảng Bình',
            ],
        ]);*/
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Khohang;

class KhohangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        {
            DB::table('khohangs')->insert([
                [
                    'id' => 1,
                    'tenkhohang' => 'Kho Tổng Việt Nam',
                    'sodienthoai' => '+8477-575-5308',
                    'diachi' => '68 Nguyễn Huệ, Phường Bến Nghé, Quận 1, TP Hồ Chí Minh',
                    'id_trangthai' => 1,
                ],
                [
                    'id' => 2,
                    'tenkhohang' => 'Kho Tổng Nhật Bản',
                    'sodienthoai' => '+8167-249-1830',
                    'diachi' => '17-11, Jiyugaoka 2-chome, Meguro-ku, Tokyo',
                    'id_trangthai' => 1,
                ],
                [
                    'id' => 3,
                    'tenkhohang' => 'Kho Hiroshima',
                    'sodienthoai' => '+8132-127-5762',
                    'diachi' => '275-1270, Miyajimacho , Hatsukaichi-shi, Hiroshima',
                    'id_trangthai' => 1,
                ],
                [
                    'id' => 4,
                    'tenkhohang' => 'Kho Kyoto',
                    'sodienthoai' => '+8178-815-0714',
                    'diachi' => '334-1084, Ueno, Fukuchiyama-shi, Kyoto',
                    'id_trangthai' => 1,
                ],
                [
                    'id' => 5,
                    'tenkhohang' => 'Kho Osaka',
                    'sodienthoai' => '+8191-093-3745',
                    'diachi' => '5-14, Hishie 4-chome, Higashi Osaka, Osaka',
                    'id_trangthai' => 1,
                ],
            ]);
        }

        //$khohang = Khohang::factory()->count(10)->create();
    }
}

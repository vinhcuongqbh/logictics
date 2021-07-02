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
                    'tenkhohang' => 'Kho Tổng Việt Nam',
                    'sodienthoai' => 1,
                    'diachi' => 'Quận 1 - Thành phố Hồ Chí Minh',
                    'id_trangthai' => 1,
                ],
                [
                    'tenkhohang' => 'Kho Tổng Nhật Bản',
                    'sodienthoai' => 2,
                    'diachi' => 'Shibuya - Tokyo',
                    'id_trangthai' => 1,
                ],
            ]);
        }

        $khohang = Khohang::factory()->count(10)->create();
    }
}

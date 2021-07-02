<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Factory;
use App\Models\User;



class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'id_loainhanvien' => '1',
                'name' => 'Administrator',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('@15h1t3rU'),
                'sodienthoai' => '+84975715369',
                'diachi' => 'Tổ dân phố 3 - Phường Đồng Hải - TP. Đồng Hới - tỉnh Quảng Bình',
                'id_khohangquanly' => 0,
                'id_trangthai' => 1,
            ],
            [
                'id_loainhanvien' => '2',
                'name' => 'Vĩnh Trường Linh',
                'email' => 'linhvt@gmail.com',
                'password' => Hash::make('123456'),
                'sodienthoai' => '+84859753480',
                'diachi' => 'Tổ dân phố 3 - Phường Đồng Hải - TP. Đồng Hới - tỉnh Quảng Bình',
                'id_khohangquanly' => 1,
                'id_trangthai' => 1,
            ],
            [
                'id_loainhanvien' => '2',
                'name' => 'Hoàng Ngọc Mai',
                'email' => 'maihn@gmail.com',
                'password' => Hash::make('123456'),
                'sodienthoai' => '+84915441781',
                'diachi' => 'Tổ dân phố 4 - Phường Nam Lý - TP. Đồng Hới - tỉnh Quảng Bình',
                'id_khohangquanly' => 2,
                'id_trangthai' => 1,
            ],
            [
                'id_loainhanvien' => '3',
                'name' => 'Ngô Duy Khánh',
                'email' => 'khanhnd@gmail.com',
                'password' => Hash::make('123456'),
                'sodienthoai' => '+84111111111',
                'diachi' => 'Tỉnh Quảng Bình',
                'id_khohangquanly' => rand(3,10),
                'id_trangthai' => 1,
            ],
            [
                'id_loainhanvien' => '3',
                'name' => 'Nguyễn Hương Nhài',
                'email' => 'nhainh@gmail.com',
                'password' => Hash::make('123456'),
                'sodienthoai' => '+84222222222',
                'diachi' => 'Tỉnh Quảng Bình',
                'id_khohangquanly' => rand(3,10),
                'id_trangthai' => 1,
            ],
        ]);

        $users = User::factory()->count(10)->create();
    }
}

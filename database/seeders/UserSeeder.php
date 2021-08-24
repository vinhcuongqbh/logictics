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
                
                'id' => 1,
                'id_loainhanvien' => '1',
                'name' => 'Administrator',
                'email' => 'admin@etrack.com',
                'password' => Hash::make('123456'),
                'sodienthoai' => '+8497-571-5369',
                'diachi' => 'Việt Nam',
                'id_khohangquanly' => null,
                'id_trangthai' => 1,
                'tilechietkhau' => null,
            ],
            [
                
                'id' => 2,
                'id_loainhanvien' => '1',
                'name' => 'Quản lý',
                'email' => 'quanly@etrack.com',
                'password' => Hash::make('123456'),
                'sodienthoai' => '',
                'diachi' => 'Nhật Bản',
                'id_khohangquanly' => null,
                'id_trangthai' => 1,
                'tilechietkhau' => null,
            ],
            [
                'id' => 3,
                'id_loainhanvien' => '2',
                'name' => 'Nhân viên kho tổng Việt Nam',
                'email' => 'nhanvienVN@etrack.com',
                'password' => Hash::make('123456'),
                'sodienthoai' => '+8485-975-3480',
                'diachi' => 'Việt Nam',
                'id_khohangquanly' => 1,
                'id_trangthai' => 1,
                'tilechietkhau' => 10,
            ],
            [
                'id' => 4,
                'id_loainhanvien' => '2',
                'name' => 'Nhân viên kho tổng Nhật Bản',
                'email' => 'nhanvienjp@etrack.com',
                'password' => Hash::make('123456'),
                'sodienthoai' => '+8491-544-1781',
                'diachi' => 'Tokyo',
                'id_khohangquanly' => 2,
                'id_trangthai' => 1,
                'tilechietkhau' => 10,
            ],
            [
                'id' => 5,
                'id_loainhanvien' => '3',
                'name' => 'Cộng tác viên kho Hiroshima',
                'email' => 'congtacvien1@etrack.com',
                'password' => Hash::make('123456'),
                'sodienthoai' => '+8490-815-3715',
                'diachi' => 'Hiroshima',
                'id_khohangquanly' => 3,
                'id_trangthai' => 1,
                'tilechietkhau' => rand(5,10),
            ],
            [
                'id' => 6,
                'id_loainhanvien' => '3',
                'name' => 'Cộng tác viên kho Kyoto',
                'email' => 'congtacvien2@etrack.com',
                'password' => Hash::make('123456'),
                'sodienthoai' => '+8481-240-2027',
                'diachi' => 'Kyoto',
                'id_khohangquanly' => 4,
                'id_trangthai' => 1,
                'tilechietkhau' => rand(5,10),
            ],
            [
                'id' => 7,
                'id_loainhanvien' => '3',
                'name' => 'Cộng tác viên kho Osaka',
                'email' => 'congtacvien3@etrack.com',
                'password' => Hash::make('123456'),
                'sodienthoai' => '+8497-136-4993',
                'diachi' => 'Osaka',
                'id_khohangquanly' => 5,
                'id_trangthai' => 1,
                'tilechietkhau' => rand(5,10),
            ],
        ]);

        //$users = User::factory()->count(10)->create();
    }
}

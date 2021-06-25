<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class LoainhanvienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('loainhanviens')->insert([
            [
                'id' => 1,
                'tenloainhanvien' => 'Quản lý',
            ],
            [
                'id' => 2,
                'tenloainhanvien' => 'Nhân viên',
            ],
            [
                'id' => 3,
                'tenloainhanvien' => 'Cộng tác viên',
            ],
        ]);
    }
}

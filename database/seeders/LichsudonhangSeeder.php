<?php

namespace Database\Seeders;

use App\Models\Lichsudonhang;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LichsudonhangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    protected $faker;

    public function run()
    {
        
        for ($i=1; $i<=100; $i++) {
            $day1 = '2020-01-01';
        DB::table('lichsudonhangs')->insert([
            [
                'id_donhang' => $i,
                'id_nhanvienquanly' => 3,
                'id_khogui' => 3,
                'id_khonhan' => null,
                'id_trangthai' => 1,
                'created_at' => $day1,
                'updated_at' => $day1,
            ],
            [
                'id_donhang' => $i,
                'id_nhanvienquanly' => 3,
                'id_khogui' => 3,
                'id_khonhan' => null,
                'id_trangthai' => 2,
                'created_at' => $day1,
                'updated_at' => $day1,
            ],     
            [
                'id_donhang' => $i,
                'id_nhanvienquanly' => 3,
                'id_khogui' => 3,
                'id_khonhan' => 2,
                'id_trangthai' => 3,
                'created_at' => $day1,
                'updated_at' => $day1,
            ],    
            [
                'id_donhang' => $i,
                'id_nhanvienquanly' => 2,
                'id_khogui' => 2,
                'id_khonhan' => null,
                'id_trangthai' => 2,
                'created_at' => $day1,
                'updated_at' => $day1,
            ],         
            [
                'id_donhang' => $i,
                'id_nhanvienquanly' => 3,
                'id_khogui' => 3,
                'id_khonhan' => null,
                'id_trangthai' => 2,
                'created_at' => $day1,
                'updated_at' => $day1,
            ],      
        ]);
        }
    }
}

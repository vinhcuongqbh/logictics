<?php

namespace Database\Seeders;

use App\Models\Lichsudonhang;
use App\Models\Donhang;
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
        $id_donhang = 0;        
        for ($id_nhanvienquanly = 3; $id_nhanvienquanly <= 5; $id_nhanvienquanly++) {
            $soluongdonhang = rand(2000, 6000);            
            for ($i = 1; $i <= $soluongdonhang; $i++) {
                $id_donhang++;
                $tongchiphi = rand(100,3000)*1000;
                $day = Carbon::now()->subDays(rand(0, 730));
                $donhang = Donhang::factory()->count(1)->create([
                    'id' => $id_donhang,
                    'id_nhanvienquanly' => 1,
                    'id_khogui' => 1,
                    'id_khonhan' => 0,
                    'id_trangthai' => 4,
                    'tongchiphi' =>  $tongchiphi,
                    'created_at' => $day->copy()->addDays(15),
                    'updated_at' => $day->copy()->addDays(15),
                ]);

               
                DB::table('lichsudonhangs')->insert([
                    [
                        'id_donhang' => $id_donhang,
                        'id_nhanvienquanly' => $id_nhanvienquanly,
                        'id_khogui' => $id_nhanvienquanly,
                        'id_khonhan' => null,
                        'id_trangthai' => 1,
                        'tongchiphi' =>  $tongchiphi,
                        'created_at' => $day,
                        'updated_at' => $day,
                    ],
                    [
                        'id_donhang' => $id_donhang,
                        'id_nhanvienquanly' => $id_nhanvienquanly,
                        'id_khogui' => $id_nhanvienquanly,
                        'id_khonhan' => null,
                        'id_trangthai' => 2,
                        'tongchiphi' =>  $tongchiphi,
                        'created_at' => $day,
                        'updated_at' => $day,
                    ],
                    [
                        'id_donhang' => $id_donhang,
                        'id_nhanvienquanly' => $id_nhanvienquanly,
                        'id_khogui' => $id_nhanvienquanly,
                        'id_khonhan' => 2,
                        'id_trangthai' => 3,
                        'tongchiphi' =>  $tongchiphi,
                        'created_at' => $day->copy()->addDays(2),
                        'updated_at' => $day->copy()->addDays(2),
                    ],
                    [
                        'id_donhang' => $id_donhang,
                        'id_nhanvienquanly' => 2,
                        'id_khogui' => 2,
                        'id_khonhan' => null,
                        'id_trangthai' => 2,
                        'tongchiphi' =>  $tongchiphi,
                        'created_at' => $day->copy()->addDays(3),
                        'updated_at' => $day->copy()->addDays(3),
                    ],
                    [
                        'id_donhang' => $id_donhang,
                        'id_nhanvienquanly' => 2,
                        'id_khogui' => 2,
                        'id_khonhan' => 1,
                        'id_trangthai' => 3,
                        'tongchiphi' =>  $tongchiphi,
                        'created_at' => $day->copy()->addDays(5),
                        'updated_at' => $day->copy()->addDays(5),
                    ],
                    [
                        'id_donhang' => $id_donhang,
                        'id_nhanvienquanly' => 1,
                        'id_khogui' => 1,
                        'id_khonhan' => null,
                        'id_trangthai' => 2,
                        'tongchiphi' =>  $tongchiphi,
                        'created_at' => $day->copy()->addDays(10),
                        'updated_at' => $day->copy()->addDays(10),
                    ],
                    [
                        'id_donhang' => $id_donhang,
                        'id_nhanvienquanly' => 1,
                        'id_khogui' => 1,
                        'id_khonhan' => 0,
                        'id_trangthai' => 3,
                        'tongchiphi' =>  $tongchiphi,
                        'created_at' => $day->copy()->addDays(12),
                        'updated_at' => $day->copy()->addDays(12),
                    ],
                    [
                        'id_donhang' => $id_donhang,
                        'id_nhanvienquanly' => 1,
                        'id_khogui' => 1,
                        'id_khonhan' => 0,
                        'id_trangthai' => 4,
                        'tongchiphi' =>  $tongchiphi,
                        'created_at' => $day->copy()->addDays(15),
                        'updated_at' => $day->copy()->addDays(15),
                    ],
                ]);
            }
        }
    }
}

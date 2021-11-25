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
        $id_khogui = 2;
        for ($id_nhanvienquanly = 5; $id_nhanvienquanly <= 7; $id_nhanvienquanly++) {
            $soluongdonhang = rand(4000, 6000);
            $id_khogui++;
            $tilechietkhau = 10;
            for ($i = 1; $i <= $soluongdonhang; $i++) {
                $id_donhang++;
                $matracuu = str_replace(".", "", microtime(true));
                if (strlen($matracuu) <> 14) {
                    while (strlen($matracuu)<14) {
                        $matracuu = $matracuu . "0";
                    }
                }
                $tongchiphi = rand(100, 3000) * 1000;
                $chietkhau = $tongchiphi * $tilechietkhau / 100;

                $day = Carbon::now()->subDays(rand(0, 730));
                $donhang = Donhang::factory()->count(1)->create([
                    'id' => $id_donhang,
                    'matracuu' => $matracuu,
                    'id_nhanvienkhoitao' => $id_nhanvienquanly,
                    'id_nhanvienquanly' => 3,
                    'id_khogui' => 1,
                    'id_khonhan' => 0,
                    'id_trangthai' => rand(4, 6),
                    'tongkhoiluong' => rand(1, 50),
                    'tongchiphi' =>  $tongchiphi,
                    'chietkhau' => $chietkhau,
                    'created_at' => $day->copy()->addDays(15),
                    'updated_at' => $day->copy()->addDays(15),
                ]);


                DB::table('lichsudonhangs')->insert([
                    [
                        'id_donhang' => $id_donhang,
                        'matracuu' => $matracuu,
                        'id_nhanvienquanly' => $id_nhanvienquanly,
                        'id_khogui' => $id_khogui,
                        'id_khonhan' => null,
                        'id_trangthai' => 1,
                        'created_at' => $day,
                        'updated_at' => $day,
                    ],
                    [
                        'id_donhang' => $id_donhang,
                        'matracuu' => $matracuu,
                        'id_nhanvienquanly' => $id_nhanvienquanly,
                        'id_khogui' => $id_khogui,
                        'id_khonhan' => null,
                        'id_trangthai' => 2,
                        'created_at' => $day,
                        'updated_at' => $day,
                    ],
                    [
                        'id_donhang' => $id_donhang,
                        'matracuu' => $matracuu,
                        'id_nhanvienquanly' => $id_nhanvienquanly,
                        'id_khogui' => $id_khogui,
                        'id_khonhan' => 2,
                        'id_trangthai' => 3,
                        'created_at' => $day->copy()->addDays(2),
                        'updated_at' => $day->copy()->addDays(2),
                    ],
                    [
                        'id_donhang' => $id_donhang,
                        'matracuu' => $matracuu,
                        'id_nhanvienquanly' => 4,
                        'id_khogui' => 2,
                        'id_khonhan' => null,
                        'id_trangthai' => 2,
                        'created_at' => $day->copy()->addDays(3),
                        'updated_at' => $day->copy()->addDays(3),
                    ],
                    [
                        'id_donhang' => $id_donhang,
                        'matracuu' => $matracuu,
                        'id_nhanvienquanly' => 4,
                        'id_khogui' => 2,
                        'id_khonhan' => 1,
                        'id_trangthai' => 3,
                        'created_at' => $day->copy()->addDays(5),
                        'updated_at' => $day->copy()->addDays(5),
                    ],
                    [
                        'id_donhang' => $id_donhang,
                        'matracuu' => $matracuu,
                        'id_nhanvienquanly' => 3,
                        'id_khogui' => 1,
                        'id_khonhan' => null,
                        'id_trangthai' => 2,
                        'created_at' => $day->copy()->addDays(10),
                        'updated_at' => $day->copy()->addDays(10),
                    ],
                    [
                        'id_donhang' => $id_donhang,
                        'matracuu' => $matracuu,
                        'id_nhanvienquanly' => 3,
                        'id_khogui' => 1,
                        'id_khonhan' => 0,
                        'id_trangthai' => 3,
                        'created_at' => $day->copy()->addDays(12),
                        'updated_at' => $day->copy()->addDays(12),
                    ],
                    [
                        'id_donhang' => $id_donhang,
                        'matracuu' => $matracuu,
                        'id_nhanvienquanly' => 3,
                        'id_khogui' => 1,
                        'id_khonhan' => 0,
                        'id_trangthai' => 4,
                        'created_at' => $day->copy()->addDays(15),
                        'updated_at' => $day->copy()->addDays(15),
                    ],
                ]);
            }
        }
    }
}

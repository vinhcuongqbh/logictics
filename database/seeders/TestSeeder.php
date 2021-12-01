<?php

namespace Database\Seeders;

use App\Models\Lichsudonhang;
use App\Models\Donhang;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    protected $faker;

    public function run()
    {
        for ($id_nhanvienquanly = 5; $id_nhanvienquanly <= 7; $id_nhanvienquanly++) {
            $tilechietkhau = 10;     
            for ($i = 1; $i <= 100; $i++) {
                $matracuu = str_replace(".", "", microtime(true));
                if (strlen($matracuu) <> 14) {
                    while (strlen($matracuu)<14) {
                        $matracuu = $matracuu . "0";
                    }
                }
                $tongchiphi = rand(100,3000)*1000;
                $chietkhau = $tongchiphi*$tilechietkhau/100;
                $day = Carbon::now()->subDays(rand(0, 7));
                $donhang = Donhang::factory()->count(1)->create([
                    'matracuu' => $matracuu,
                    'id_nhanvienkhoitao' => $id_nhanvienquanly,
                    'id_nhanvienquanly' => $id_nhanvienquanly,
                    'id_khogui' => $id_nhanvienquanly - 2,
                    'id_khonhan' => null,
                    'id_trangthai' => 2,
                    'tongchiphi' =>  $tongchiphi,
                    'tongkhoiluong' => rand(1, 50),
                    'chietkhau' => $chietkhau,
                    'created_at' => $day->copy()->addDays(15),
                    'updated_at' => $day->copy()->addDays(15),
                ]);
            }
        }
    }
}

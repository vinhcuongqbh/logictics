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
        for ($id_nhanvienquanly = 5; $id_nhanvienquanly <= 5; $id_nhanvienquanly++) {
            $tilechietkhau = 10;     
            for ($i = 1; $i <= 100; $i++) {
                $tongchiphi = rand(100,3000)*1000;
                $chietkhau = $tongchiphi*$tilechietkhau/100;
                $day = Carbon::now()->subDays(rand(0, 7));
                $donhang = Donhang::factory()->count(1)->create([
                    'id_nhanvienkhoitao' => $id_nhanvienquanly,
                    'id_nhanvienquanly' => $id_nhanvienquanly,
                    'id_khogui' => 3,
                    'id_khonhan' => null,
                    'id_trangthai' => 2,
                    'tongchiphi' =>  $tongchiphi,
                    'chietkhau' => $chietkhau,
                    'created_at' => $day->copy()->addDays(15),
                    'updated_at' => $day->copy()->addDays(15),
                ]);
            }
        }
    }
}

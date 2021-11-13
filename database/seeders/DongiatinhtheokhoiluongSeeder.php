<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class dongiatinhtheokhoiluongSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dongiatinhtheokhoiluongs')->insert([
            [
                'khoiluongmax' => 11,
                'dongiaduongkhong' => 215000,
                'dongiaduongbien' => 185000,
            ],
            [
                'khoiluongmax' => 31,
                'dongiaduongkhong' => 210000,
                'dongiaduongbien' => 180000,
            ],
            [
                'khoiluongmax' => 61,
                'dongiaduongkhong' => 200000,
                'dongiaduongbien' => 170000,
            ],
            [
                'khoiluongmax' => 500,
                'dongiaduongkhong' => 195000,
                'dongiaduongbien' => 165000,
            ],
        ]);
    }
}

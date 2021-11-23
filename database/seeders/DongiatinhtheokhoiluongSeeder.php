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
                'khoiluongmax' => 10,
                'dongiaduongkhong' => 204000,
                'dongiaduongbien' => 0,
            ],
            [
                'khoiluongmax' => 50,
                'dongiaduongkhong' => 199000,
                'dongiaduongbien' => 116000,
            ],
            [
                'khoiluongmax' => 500,
                'dongiaduongkhong' => 189000,
                'dongiaduongbien' => 104000,
            ],
            [
                'khoiluongmax' => 9999,
                'dongiaduongkhong' => 0,
                'dongiaduongbien' => 0,
            ],
        ]);
    }
}

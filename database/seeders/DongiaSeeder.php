<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DongiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dongias')->insert([
            [
                'id' => 1,
                'tensanpham' => 'Airpods',
                'dongia' => '100000',
            ],
            [
                'id' => 2,
                'tensanpham' => 'iPhone',
                'dongia' => '200000',
            ],
        ]);
    }
}

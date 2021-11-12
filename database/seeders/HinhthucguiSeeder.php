<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HinhthucguiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hinhthucguis')->insert([
            [
                'id' => 1,
                'tenhinhthucgui' => 'Đường biển',
            ],
            [
                'id' => 2,
                'tenhinhthucgui' => 'Đường hàng không',
            ],
        ]);
    }
}

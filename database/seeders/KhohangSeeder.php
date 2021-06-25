<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Khohang;

class KhohangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $khohang = Khohang::factory()->count(10)->create();
    }
}

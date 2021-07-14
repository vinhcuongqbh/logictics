<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            TrangthaiSeeder::class,
            LoainhanvienSeeder::class,
            LoaihangSeeder::class,
            UserSeeder::class,
            KhachhangSeeder::class,
            KhohangSeeder::class,
            DongiahangcongkenhSeeder::class,
            DongiatinhtheosoluongSeeder::class,
            DongiatinhtheokhoiluongSeeder::class,
            DanhmucmathangSeeder::class,
        ]);
    }
}

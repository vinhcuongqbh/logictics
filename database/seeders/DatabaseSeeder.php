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
            DongiahangcongkenhSeeder::class,
            DongiatinhtheosoluongSeeder::class,
            DongiatinhtheokhoiluongSeeder::class,
            KhohangSeeder::class,            
            UserSeeder::class,
            KhachhangSeeder::class,           
            LichsudonhangSeeder::class,
            ThongtincongtySeeder::class,
            HinhthucguiSeeder::class,
            TestSeeder::class,
            //DonhangSeeder::class,
        ]);
    }
}

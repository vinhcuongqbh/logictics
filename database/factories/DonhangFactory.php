<?php

namespace Database\Factories;

use App\Models\Donhang;
use Illuminate\Database\Eloquent\Factories\Factory;

class DonhangFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Donhang::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_nhanvienquanly' => rand(3,6),
            'id_trangthai' => 2,
            'tennguoigui' => $this->faker->name(),
            'sodienthoainguoigui' => $this->faker->phoneNumber(),
            'diachinguoigui' => $this->faker->address(),
            'tennguoinhan' => $this->faker->name(),
            'sodienthoainguoinhan' => $this->faker->phoneNumber(),
            'diachinguoinhan' => $this->faker->address(),
            'id_khogui' => rand(2,5),
            'id_loaihang' => rand(1,10),
            'noidunghang' =>  $this->faker->paragraph(),
            'khoiluong' =>  rand(1,200),
            'kichthuoc' =>  rand(1,200),
            'giatriuoctinh' => rand(1000,100000000),
            'tongchiphi' => rand(1000,100000000),
        ];
    }
}

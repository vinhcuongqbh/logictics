<?php

namespace Database\Factories;

use App\Models\Khachhang;
use Illuminate\Database\Eloquent\Factories\Factory;

class KhachhangFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Khachhang::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'tenkhachhang' => $this->faker->name(),
            'id_loaikhachhang' => rand(0,1),
            'sodienthoai' => $this->faker->phoneNumber(),
            'diachi' => $this->faker->address(),
            'email' => $this->faker->unique()->safeEmail(),
            'id_nhanvienquanly' => rand(3,7),
            'id_trangthai' => 1,
        ];
    }
}

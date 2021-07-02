<?php

namespace Database\Factories;

use App\Models\Khohang;
use Illuminate\Database\Eloquent\Factories\Factory;

class KhohangFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Khohang::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'tenkhohang' => $this->faker->city('fa_IR'),
            'sodienthoai' => $this->faker->phoneNumber(),
            'diachi' => $this->faker->address(),
            'id_trangthai' => 1,
        ];
    }
}

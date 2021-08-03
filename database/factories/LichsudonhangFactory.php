<?php

namespace Database\Factories;

use App\Models\Lichsudonhang;
use Illuminate\Database\Eloquent\Factories\Factory;

class LichsudonhangFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Lichsudonhang::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_nhanvienquanly' => rand(3,6),
            'id_khogui' => rand(2,5),
            'id_nhan' => rand(2,5),
            'id_trangthai' => 2,
            'created_at' => $this->faker->dateTimeBetween('2020-01-01', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('2020-01-01', 'now'),
        ];
    }
    }
}

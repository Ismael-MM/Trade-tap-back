<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\trabajador_profesione;

class TrabajadorProfesioneFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TrabajadorProfesione::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'trabajador_id' => $this->faker->randomNumber(),
            'profesion_id' => $this->faker->randomNumber(),
        ];
    }
}

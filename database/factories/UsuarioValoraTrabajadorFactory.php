<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\usuario_valora_trabajador;

class UsuarioValoraTrabajadorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UsuarioValoraTrabajador::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'puntuacion' => $this->faker->randomFloat(0, 0, 9999999999.),
        ];
    }
}

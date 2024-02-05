<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\HorarioInhabilitado;
use App\Models\Trabajador;

class HorarioInhabilitadoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = HorarioInhabilitado::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'fecha' => $this->faker->date(),
            'trabajador_id' => Trabajador::factory(),
        ];
    }
}

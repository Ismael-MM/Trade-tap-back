<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Trabajador;
use App\Models\horario_trabajadore;

class HorarioTrabajadoreFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = HorarioTrabajadore::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'rango' => $this->faker->word(),
            'hora_comienzo' => $this->faker->dateTime(),
            'hora_final' => $this->faker->dateTime(),
            'trabajador_id' => Trabajador::factory(),
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\HorarioTrabajador;
use App\Models\Trabajador;

class HorarioTrabajadorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = HorarioTrabajador::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'rango' => $this->faker->randomElement(["Lunes-Viernes","Lunes-Sabado","Lunes-Domingo"]),
            'hora_comienzo' => $this->faker->dateTime(),
            'hora_final' => $this->faker->dateTime(),
            'trabajador_id' => Trabajador::factory(),
        ];
    }
}

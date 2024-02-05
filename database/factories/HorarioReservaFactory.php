<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\HorarioReserva;
use App\Models\Reserva;

class HorarioReservaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = HorarioReserva::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'fecha' => $this->faker->date(),
            'hora_comienzo' => $this->faker->dateTime(),
            'hora_final' => $this->faker->dateTime(),
            'reserva_id' => Reserva::factory(),
        ];
    }
}

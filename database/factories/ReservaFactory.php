<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Cliente;
use App\Models\Reserva;
use App\Models\Trabajador;

class ReservaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reserva::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'estado' => $this->faker->randomElement(["Finalizada","Pendiente","En"]),
            'trabajador_id' => Trabajador::factory(),
            'cliente_id' => Cliente::factory(),
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Cliente;
use App\Models\Servicio;
use App\Models\Trabajador;
use App\Models\Valoracion;

class ValoracionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Valoracion::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'Puntuacion' => $this->faker->randomFloat(0, 0, 9999999999.),
            'cliente_id' => Cliente::factory(),
            'trabajador_id' => Trabajador::factory(),
            'serivicio_id' => $this->faker->randomNumber(),
            'servicio_id' => Servicio::factory(),
        ];
    }
}

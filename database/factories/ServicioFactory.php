<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Encargo;
use App\Models\Reserva;
use App\Models\Servicio;

class ServicioFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Servicio::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'encargo_id' => Encargo::factory(),
            'reserva_id' => Reserva::factory(),
        ];
    }
}
<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Cliente;
use App\Models\Solicitud;
use App\Models\Trabajador;

class SolicitudFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Solicitud::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'descripcion' => $this->faker->text(),
            'titulo' => $this->faker->word(),
            'estado' => $this->faker->randomElement(["Aceptado","Pendiente","Rechazado"]),
            'trabajador_id' => Trabajador::factory(),
            'cliente_id' => Cliente::factory(),
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Cliente;
use App\Models\Encargo;
use App\Models\Trabajador;

class EncargoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Encargo::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'estado' => $this->faker->randomElement(["Entregado","Pendiente","Cancelado"]),
            'fecha_entregada' => $this->faker->date(),
            'fecha_entregada1' => $this->faker->date(),
            'trabajador_id' => Trabajador::factory(),
            'cliente_id' => Cliente::factory(),
        ];
    }
}

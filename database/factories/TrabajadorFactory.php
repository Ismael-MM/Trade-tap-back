<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Trabajador;

class TrabajadorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Trabajador::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'cif' => $this->faker->word(),
            'descripcion' => $this->faker->text(),
            'situacion' => $this->faker->randomElement(["Aceptado","Pendiente","Rechazado"]),
        ];
    }
}

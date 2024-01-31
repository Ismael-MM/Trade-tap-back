<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\trabajadore;

class TrabajadoreFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Trabajadore::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->word(),
            'apellido1' => $this->faker->word(),
            'apellido2' => $this->faker->word(),
            'direccion' => $this->faker->word(),
            'provincia' => $this->faker->word(),
            'localidad' => $this->faker->word(),
            'cp' => $this->faker->numberBetween(-10000, 10000),
            'cif' => $this->faker->word(),
            'email' => $this->faker->safeEmail(),
            'descripcion' => $this->faker->text(),
        ];
    }
}

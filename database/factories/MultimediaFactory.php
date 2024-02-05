<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Multimedia;
use App\Models\Valoracion;

class MultimediaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Multimedia::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'tipo' => $this->faker->randomElement(["Foto","Video"]),
            'url' => $this->faker->url(),
            'valoracion_id' => Valoracion::factory(),
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Users;
use App\Models\solicitude;

class SolicitudeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Solicitude::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'users_id' => Users::factory(),
        ];
    }
}

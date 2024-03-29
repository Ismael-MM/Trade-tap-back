<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->firstName(),
            'usuario' => fake()->userName(),
            'apellido1' => fake()->lastName(),
            'apellido2' => fake()->lastName(),
            'direccion' => fake()->streetAddress(),
            'provincia' => fake()->state(),
            'localidad' => fake()->city(),
            'cp' => fake()->postcode(),
            'rol' => $this->faker->randomElement(["trabajador"]),
            'telefono' => fake()->mobileNumber(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'telefono' => fake()->mobileNumber(),
            'password' => Hash::make(12345678), // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}

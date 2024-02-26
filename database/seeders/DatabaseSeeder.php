<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Cliente;
use App\Models\Profesion;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Trabajador;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            ProfesionSeeder::class
        ]);

        User::factory(50)->create()->each(function ($user) {
            // Generar un número aleatorio entre 1 y 4 para el número de profesiones
            $numProfesiones = rand(1, 4);

            // Obtener un conjunto aleatorio de profesiones de la base de datos
            $profesiones = Profesion::inRandomOrder()->limit($numProfesiones)->get();

            // Crear un trabajador
            $trabajador = Trabajador::factory()->create();

            // Asociar las profesiones obtenidas al trabajador
            foreach ($profesiones as $profesion) {
                $trabajador->profesions()->attach($profesion);
            }

            // Asignar al usuario el tipo y el ID del trabajador creado
            $user->userable_id = $trabajador->id;
            $user->userable_type = Trabajador::class;
            $user->save();
        });

        // \App\Models\User::factory(10)->create();
        // \App\Models\Trabajador::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]); // password = password
    }
}

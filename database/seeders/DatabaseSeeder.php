<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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


        User::factory(10)->create()->each(function ($user) {
            $trabajador = Trabajador::factory()->create();
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

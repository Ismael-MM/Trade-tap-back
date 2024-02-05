<?php

namespace Database\Seeders;

use App\Models\HorarioTrabajador;
use Illuminate\Database\Seeder;

class HorarioTrabajadorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HorarioTrabajador::factory()->count(5)->create();
    }
}

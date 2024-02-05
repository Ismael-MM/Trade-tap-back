<?php

namespace Database\Seeders;

use App\Models\HorarioIngabilitado;
use Illuminate\Database\Seeder;

class HorarioIngabilitadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HorarioIngabilitado::factory()->count(5)->create();
    }
}

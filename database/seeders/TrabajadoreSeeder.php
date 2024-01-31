<?php

namespace Database\Seeders;

use App\Models\Trabajadore;
use Illuminate\Database\Seeder;

class TrabajadoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Trabajadore::factory()->count(5)->create();
    }
}

<?php

namespace Database\Seeders;

use App\Models\Profesion;
use Illuminate\Database\Seeder;

class ProfesionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $profesiones = [
            'Fontanero',
            'Carpintero',
            'Electricista',
            'Jardinero',
            'Soldador',
            'Mecánico',
            'Cocinero',
            'Técnico',
            'Diseñador',
            'Albañil',
            'Crupier',
            'Jamonero',
            'Camarero',
            'Dj',
            'Servicios Caterin',
            'Frigorista',
            'Caldeleria',
            'Informático',
        ];

        foreach ($profesiones as $profesion) {
            Profesion::create([
                'nombre' => $profesion,
                'familia_profesional' => 'Profesiones'
            ]);
        }
    }
}

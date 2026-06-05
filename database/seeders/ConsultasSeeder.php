<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Consulta;

class ConsultasSeeder extends Seeder
{
    public function run(): void
    {
        $consultas = [
            [
                'nombre'  => 'Lucas Escobar',
                'email'   => 'Lucassss@gmail.com',
                'mensaje' => 'Hola, quería consultar si tienen disponible la RTX 4070 Super y si hacer envios a Uruguay',
                'leida'   => false,
            ],
        ];

        foreach ($consultas as $data) {
            Consulta::firstOrCreate(
                ['email' => $data['email'], 'mensaje' => $data['mensaje']],
                $data
            );
        }
    }
}

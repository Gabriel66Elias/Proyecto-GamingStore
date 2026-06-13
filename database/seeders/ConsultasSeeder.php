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
                'mensaje' => 'Hola, quería consultar si tienen disponible la RTX 4070 Super y si hacen envíos a Uruguay',
                'leida'   => true,
            ],
            [
                'nombre'  => 'Valentina López',
                'email'   => 'valentina.lopez@test.com',
                'mensaje' => 'Buen día, hice una compra por transferencia hace 2 días y sigue pendiente. ¿Me confirman si impactó el pago?',
                'leida'   => false,
            ],
            [
                'nombre'  => 'Mateo Fernández',
                'email'   => 'mateo.fernandez@test.com',
                'mensaje' => '¿La mother ASUS ROG Strix B550-F ya viene con la BIOS actualizada para la serie 5000 de Ryzen?',
                'leida'   => true,
            ],
            [
                'nombre'  => 'Camila Rodríguez',
                'email'   => 'cami.rodriguez@hotmail.com',
                'mensaje' => 'Necesito armar una PC para diseño gráfico. ¿Tienen algún presupuesto armado con Intel i9?',
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
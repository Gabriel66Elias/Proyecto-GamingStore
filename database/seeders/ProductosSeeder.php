<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Producto;

class ProductosSeeder extends Seeder
{
    public function run(): void
    {
        Producto::firstOrCreate(
            ['nombre' => 'NVIDIA RTX 4070 Super'],
            [
                'categoria'     => 'Hardware',
                'descripcion'   => 'La RTX 4070 Super ofrece un rendimiento excepcional en 1440p y es capaz de mover títulos exigentes en 4K con ray tracing activado. Incluye soporte para DLSS 3.5 y Frame Generation.',
                'especificaciones' => [
                    '12 GB GDDR6X',
                    'DLSS 3.5 con Frame Generation',
                    'Ray Tracing de 3ra generación',
                    'Boost Clock: 2475 MHz',
                    'Consumo: 220W TDP',
                ],
                'precio_compra' => 750000.00,
                'precio_venta'  => 1050000.00,
                'stock'         => 8,
                'imagen'        => null,
            ]
        );

        Producto::firstOrCreate(
            ['nombre' => 'AMD Ryzen 7 7800X3D'],
            [
                'categoria'     => 'Hardware',
                'descripcion'   => 'El procesador gaming más rápido del mundo gracias a la tecnología 3D V-Cache. Domina en juegos a 1080p y 1440p superando a cualquier rival de Intel en títulos optimizados.',
                'especificaciones' => [
                    '8 núcleos / 16 hilos',
                    '3D V-Cache de 96 MB',
                    'Boost Clock: 5.0 GHz',
                    'TDP: 120W',
                    'Socket AM5',
                ],
                'precio_compra' => 420000.00,
                'precio_venta'  => 620000.00,
                'stock'         => 12,
                'imagen'        => null,
            ]
        );
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Usuario;
use App\Models\Producto;
use App\Models\VentaCabecera;
use App\Models\Resena;

class ResenasSeeder extends Seeder
{
    public function run(): void
    {
        $lucas     = Usuario::where('email', 'lucas.garcia@test.com')->first();
        $mateo     = Usuario::where('email', 'mateo.fernandez@test.com')->first();

        $prods = Producto::whereIn('nombre', [
            'NVIDIA RTX 4070 Super',
            'AMD Ryzen 7 7800X3D',
            'AMD Ryzen 5 5600G'
        ])->get()->keyBy('nombre');

        // Traemos pedidos específicos que ya están "completados" o "entregados"
        $pedidoLucas1 = VentaCabecera::where('numero_pedido', 'PED-SEED-001')->first();
        $pedidoLucas2 = VentaCabecera::where('numero_pedido', 'PED-SEED-002')->first();
        $pedidoMateo  = VentaCabecera::where('numero_pedido', 'PED-SEED-010')->first();

        if (!$lucas || !$mateo || !$pedidoLucas1) {
            return; // Evita errores si corren en mal orden
        }

        $resenas = [
            [
                'usuario_id'   => $lucas->id,
                'producto_id'  => $prods['NVIDIA RTX 4070 Super']->id ?? null,
                'venta_id'     => $pedidoLucas1->id,
                'calificacion' => 5,
                'comentario'   => 'Una bestia. Corre el Cyberpunk 2077 en Ultra sin transpirar. El envío llegó perfecto con Andreani.',
            ],
            [
                'usuario_id'   => $lucas->id,
                'producto_id'  => $prods['AMD Ryzen 7 7800X3D']->id ?? null,
                'venta_id'     => $pedidoLucas2->id,
                'calificacion' => 4,
                'comentario'   => 'Excelente procesador, las temperaturas son un poco altas pero con una buena líquida se soluciona.',
            ],
            [
                'usuario_id'   => $mateo->id,
                'producto_id'  => $prods['AMD Ryzen 5 5600G']->id ?? null,
                'venta_id'     => $pedidoMateo->id,
                'calificacion' => 5,
                'comentario'   => 'Calidad precio imbatible. Los gráficos integrados zafan muy bien para e-sports como el CS2.',
            ]
        ];

        foreach ($resenas as $res) {
            if ($res['producto_id'] && $res['venta_id']) {
                Resena::firstOrCreate([
                    'usuario_id' => $res['usuario_id'],
                    'venta_id'   => $res['venta_id'],
                ], $res);
            }
        }
    }
}
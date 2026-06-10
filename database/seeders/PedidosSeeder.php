<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use App\Models\Usuario;
use App\Models\VentaCabecera;
use App\Models\VentaDetalle;
use App\Models\Producto;

class PedidosSeeder extends Seeder
{
    public function run(): void
    {
        $lucas     = Usuario::where('email', 'lucas.garcia@test.com')->first();
        $valentina = Usuario::where('email', 'valentina.lopez@test.com')->first();
        $mateo     = Usuario::where('email', 'mateo.fernandez@test.com')->first();

        if (!$lucas || !$valentina || !$mateo) {
            $this->command->warn('Clientes de prueba no encontrados. Asegurate de ejecutar ClientesSeeder primero.');
            return;
        }

        $prods = Producto::whereIn('nombre', [
            'NVIDIA RTX 4070 Super',
            'NVIDIA RTX 5090',
            'AMD RX 6600 XT',
            'AMD Ryzen 7 7800X3D',
            'AMD Ryzen 5 5600G',
            'Intel Core i9-14900K',
            'Corsair Vengeance DDR5 32GB',
            'Samsung 980 Pro 2TB NVMe',
            'Corsair iCUE H150i Elite LCD',
            'ASUS ROG Strix B550-F Gaming',
        ])->get()->keyBy('nombre');

        // ── LUCAS GARCÍA ────────────────────────────────────────────────────────
        // PED-SEED-001 · tarjeta · domicilio · completado
        $this->pedido([
            'user_id'          => $lucas->id,
            'numero_pedido'    => 'PED-SEED-001',
            'nombre_cliente'   => 'Lucas',
            'apellido_cliente' => 'García',
            'email_cliente'    => $lucas->email,
            'telefono_cliente' => '+54 11 4521-3300',
            'tipo_envio'       => 'domicilio',
            'transporte'       => 'Andreani',
            'provincia'        => 'Buenos Aires',
            'localidad'        => 'La Plata',
            'calle'            => 'Av. 7 Nro. 1234',
            'codigo_postal'    => '1900',
            'costo_envio'      => 12500,
            'metodo_pago'      => 'tarjeta',
            'estado'           => 'completado',
            'fecha_venta'      => Carbon::now()->subDays(35),
        ], [
            [$prods['NVIDIA RTX 4070 Super']      ?? null, 1],
            [$prods['Corsair Vengeance DDR5 32GB'] ?? null, 2],
        ]);

        // PED-SEED-002 · transferencia · domicilio · entregado
        $this->pedido([
            'user_id'          => $lucas->id,
            'numero_pedido'    => 'PED-SEED-002',
            'nombre_cliente'   => 'Lucas',
            'apellido_cliente' => 'García',
            'email_cliente'    => $lucas->email,
            'telefono_cliente' => '+54 11 4521-3300',
            'tipo_envio'       => 'domicilio',
            'transporte'       => 'Correo Argentino',
            'provincia'        => 'Buenos Aires',
            'localidad'        => 'La Plata',
            'calle'            => 'Av. 7 Nro. 1234',
            'codigo_postal'    => '1900',
            'costo_envio'      => 13900,
            'metodo_pago'      => 'transferencia',
            'estado'           => 'entregado',
            'fecha_venta'      => Carbon::now()->subDays(18),
        ], [
            [$prods['AMD Ryzen 7 7800X3D']  ?? null, 1],
            [$prods['Samsung 980 Pro 2TB NVMe'] ?? null, 1],
        ]);

        // PED-SEED-003 · tarjeta · retiro · en_camino
        $this->pedido([
            'user_id'          => $lucas->id,
            'numero_pedido'    => 'PED-SEED-003',
            'nombre_cliente'   => 'Lucas',
            'apellido_cliente' => 'García',
            'email_cliente'    => $lucas->email,
            'telefono_cliente' => '+54 11 4521-3300',
            'tipo_envio'       => 'domicilio',
            'transporte'       => 'Andreani',
            'provincia'        => 'Buenos Aires',
            'localidad'        => 'La Plata',
            'calle'            => 'Av. 7 Nro. 1234',
            'codigo_postal'    => '1900',
            'costo_envio'      => 12500,
            'metodo_pago'      => 'tarjeta',
            'estado'           => 'en_camino',
            'fecha_venta'      => Carbon::now()->subDays(5),
        ], [
            [$prods['Corsair iCUE H150i Elite LCD'] ?? null, 1],
        ]);

        // PED-SEED-004 · tarjeta · retiro · pendiente
        $this->pedido([
            'user_id'          => $lucas->id,
            'numero_pedido'    => 'PED-SEED-004',
            'nombre_cliente'   => 'Lucas',
            'apellido_cliente' => 'García',
            'email_cliente'    => $lucas->email,
            'telefono_cliente' => '+54 11 4521-3300',
            'tipo_envio'       => 'retiro',
            'transporte'       => null,
            'provincia'        => null,
            'localidad'        => null,
            'calle'            => null,
            'codigo_postal'    => null,
            'costo_envio'      => 0,
            'metodo_pago'      => 'tarjeta',
            'estado'           => 'pendiente',
            'fecha_venta'      => Carbon::now()->subDay(),
        ], [
            [$prods['ASUS ROG Strix B550-F Gaming'] ?? null, 1],
            [$prods['AMD Ryzen 5 5600G']            ?? null, 1],
        ]);

        // ── VALENTINA LÓPEZ ─────────────────────────────────────────────────────
        // PED-SEED-005 · transferencia · domicilio · pendiente (esperando pago)
        $this->pedido([
            'user_id'          => $valentina->id,
            'numero_pedido'    => 'PED-SEED-005',
            'nombre_cliente'   => 'Valentina',
            'apellido_cliente' => 'López',
            'email_cliente'    => $valentina->email,
            'telefono_cliente' => '+54 351 444-7890',
            'tipo_envio'       => 'domicilio',
            'transporte'       => 'Correo Argentino',
            'provincia'        => 'Córdoba',
            'localidad'        => 'Córdoba Capital',
            'calle'            => 'Bv. San Juan 459',
            'codigo_postal'    => '5000',
            'costo_envio'      => 13900,
            'metodo_pago'      => 'transferencia',
            'estado'           => 'pendiente',
            'fecha_venta'      => Carbon::now()->subDays(2),
        ], [
            [$prods['NVIDIA RTX 5090'] ?? null, 1],
        ]);

        // PED-SEED-006 · tarjeta · domicilio · en_proceso
        $this->pedido([
            'user_id'          => $valentina->id,
            'numero_pedido'    => 'PED-SEED-006',
            'nombre_cliente'   => 'Valentina',
            'apellido_cliente' => 'López',
            'email_cliente'    => $valentina->email,
            'telefono_cliente' => '+54 351 444-7890',
            'tipo_envio'       => 'domicilio',
            'transporte'       => 'Andreani',
            'provincia'        => 'Córdoba',
            'localidad'        => 'Córdoba Capital',
            'calle'            => 'Bv. San Juan 459',
            'codigo_postal'    => '5000',
            'costo_envio'      => 12500,
            'metodo_pago'      => 'tarjeta',
            'estado'           => 'en_proceso',
            'fecha_venta'      => Carbon::now()->subDays(4),
        ], [
            [$prods['AMD Ryzen 7 7800X3D']          ?? null, 1],
            [$prods['ASUS ROG Strix B550-F Gaming']  ?? null, 1],
            [$prods['Corsair Vengeance DDR5 32GB']   ?? null, 1],
        ]);

        // PED-SEED-007 · tarjeta · retiro · cancelado
        $this->pedido([
            'user_id'          => $valentina->id,
            'numero_pedido'    => 'PED-SEED-007',
            'nombre_cliente'   => 'Valentina',
            'apellido_cliente' => 'López',
            'email_cliente'    => $valentina->email,
            'telefono_cliente' => '+54 351 444-7890',
            'tipo_envio'       => 'retiro',
            'transporte'       => null,
            'provincia'        => null,
            'localidad'        => null,
            'calle'            => null,
            'codigo_postal'    => null,
            'costo_envio'      => 0,
            'metodo_pago'      => 'tarjeta',
            'estado'           => 'cancelado',
            'fecha_venta'      => Carbon::now()->subDays(12),
        ], [
            [$prods['Intel Core i9-14900K'] ?? null, 1],
        ]);

        // ── MATEO FERNÁNDEZ ─────────────────────────────────────────────────────
        // PED-SEED-008 · transferencia · domicilio · enviado
        $this->pedido([
            'user_id'          => $mateo->id,
            'numero_pedido'    => 'PED-SEED-008',
            'nombre_cliente'   => 'Mateo',
            'apellido_cliente' => 'Fernández',
            'email_cliente'    => $mateo->email,
            'telefono_cliente' => '+54 341 522-6600',
            'tipo_envio'       => 'domicilio',
            'transporte'       => 'Andreani',
            'provincia'        => 'Santa Fe',
            'localidad'        => 'Rosario',
            'calle'            => 'Av. Pellegrini 1800',
            'codigo_postal'    => '2000',
            'costo_envio'      => 12500,
            'metodo_pago'      => 'transferencia',
            'estado'           => 'enviado',
            'fecha_venta'      => Carbon::now()->subDays(6),
        ], [
            [$prods['AMD RX 6600 XT']          ?? null, 1],
            [$prods['Samsung 980 Pro 2TB NVMe'] ?? null, 1],
        ]);

        // PED-SEED-009 · tarjeta · domicilio · en_proceso
        $this->pedido([
            'user_id'          => $mateo->id,
            'numero_pedido'    => 'PED-SEED-009',
            'nombre_cliente'   => 'Mateo',
            'apellido_cliente' => 'Fernández',
            'email_cliente'    => $mateo->email,
            'telefono_cliente' => '+54 341 522-6600',
            'tipo_envio'       => 'domicilio',
            'transporte'       => 'Correo Argentino',
            'provincia'        => 'Santa Fe',
            'localidad'        => 'Rosario',
            'calle'            => 'Av. Pellegrini 1800',
            'codigo_postal'    => '2000',
            'costo_envio'      => 13900,
            'metodo_pago'      => 'tarjeta',
            'estado'           => 'en_proceso',
            'fecha_venta'      => Carbon::now()->subDays(3),
        ], [
            [$prods['Corsair iCUE H150i Elite LCD'] ?? null, 1],
            [$prods['Corsair Vengeance DDR5 32GB']  ?? null, 2],
        ]);

        // PED-SEED-010 · tarjeta · retiro · completado
        $this->pedido([
            'user_id'          => $mateo->id,
            'numero_pedido'    => 'PED-SEED-010',
            'nombre_cliente'   => 'Mateo',
            'apellido_cliente' => 'Fernández',
            'email_cliente'    => $mateo->email,
            'telefono_cliente' => '+54 341 522-6600',
            'tipo_envio'       => 'retiro',
            'transporte'       => null,
            'provincia'        => null,
            'localidad'        => null,
            'calle'            => null,
            'codigo_postal'    => null,
            'costo_envio'      => 0,
            'metodo_pago'      => 'tarjeta',
            'estado'           => 'completado',
            'fecha_venta'      => Carbon::now()->subDays(22),
        ], [
            [$prods['AMD Ryzen 5 5600G']           ?? null, 1],
            [$prods['ASUS ROG Strix B550-F Gaming'] ?? null, 1],
            [$prods['Samsung 980 Pro 2TB NVMe']    ?? null, 1],
        ]);
    }

    private function pedido(array $data, array $items): void
    {
        if (VentaCabecera::where('numero_pedido', $data['numero_pedido'])->exists()) {
            return;
        }

        // Calcular total a partir de los ítems reales
        $subtotal = 0;
        $lineas   = [];
        foreach ($items as [$producto, $cantidad]) {
            if (!$producto) continue;
            $precio   = (float) $producto->precio_venta;
            $sub      = $precio * $cantidad;
            $subtotal += $sub;
            $lineas[] = compact('producto', 'cantidad', 'precio', 'sub');
        }

        $total = $subtotal + (float) ($data['costo_envio'] ?? 0);

        $cabecera = VentaCabecera::create(array_merge($data, ['total' => $total]));

        foreach ($lineas as $l) {
            VentaDetalle::create([
                'venta_id'       => $cabecera->id,
                'producto_id'    => $l['producto']->id,
                'cantidad'       => $l['cantidad'],
                'precio_unitario' => $l['precio'],
                'subtotal'       => $l['sub'],
            ]);
        }
    }
}

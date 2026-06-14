<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;
use App\Models\Producto;

class ProductosSeeder extends Seeder
{
    public function run(): void
    {
        $hw  = Categoria::where('nombre', 'Hardware')->first()->id;
        $con = Categoria::where('nombre', 'Consolas')->first()->id;
        $per = Categoria::where('nombre', 'Periféricos')->first()->id;
        $tv  = Categoria::where('nombre', 'TV & Monitores')->first()->id;

        $productos = [

            // ── HARDWARE ────────────────────────────────────────────────────
            [
                'nombre'        => 'NVIDIA RTX 4070 Super',
                'categoria_id'  => $hw,
                'descripcion'   => 'La RTX 4070 Super ofrece rendimiento excepcional en 1440p y es capaz de mover títulos exigentes en 4K con ray tracing.',
                'especificaciones' => ['12 GB GDDR6X','DLSS 3.5 con Frame Generation','Ray Tracing de 3ra generación'],
                'precio_compra' => 750000,  'precio_venta' => 1050000, 'descuento_porcentaje' => 10, 'stock' => 8,  'imagen' => 'productos/rtx4070.webp',
            ],
            [
                'nombre'        => 'NVIDIA RTX 5090',
                'categoria_id'  => $hw,
                'descripcion'   => 'La GPU más potente del mercado. Rendimiento sin igual para entusiastas.',
                'especificaciones' => ['32 GB GDDR7','DLSS 4 con Multi Frame Generation'],
                'precio_compra' => 2200000, 'precio_venta' => 2800000, 'descuento_porcentaje' => 0, 'stock' => 3,  'imagen' => 'productos/rtx5090.webp',
            ],
            [
                'nombre'        => 'AMD RX 6600 XT',
                'categoria_id'  => $hw,
                'descripcion'   => 'Excelente relación precio-rendimiento para 1080p gaming.',
                'especificaciones' => ['8 GB GDDR6','128-bit bus'],
                'precio_compra' => 280000,  'precio_venta' => 390000,  'descuento_porcentaje' => 15, 'stock' => 9,  'imagen' => 'productos/rx6600xt.webp',
            ],
            [
                'nombre'        => 'AMD Ryzen 7 7800X3D',
                'categoria_id'  => $hw,
                'descripcion'   => 'El procesador gaming más rápido gracias a la tecnología 3D V-Cache.',
                'especificaciones' => ['8 núcleos / 16 hilos','3D V-Cache de 96 MB'],
                'precio_compra' => 420000,  'precio_venta' => 620000,  'descuento_porcentaje' => 5, 'stock' => 12, 'imagen' => 'productos/r7.webp',
            ],
            [
                'nombre'        => 'AMD Ryzen 5 5600G',
                'categoria_id'  => $hw,
                'descripcion'   => 'Procesador con gráficos integrados Radeon Vega.',
                'especificaciones' => ['6 núcleos / 12 hilos','GPU integrada Radeon Vega 7'],
                'precio_compra' => 160000,  'precio_venta' => 230000,  'descuento_porcentaje' => 0, 'stock' => 11, 'imagen' => 'productos/ryzen55600g.webp',
            ],
            [
                'nombre'        => 'Intel Core i9-14900K',
                'categoria_id'  => $hw,
                'descripcion'   => 'El procesador de escritorio más potente de Intel.',
                'especificaciones' => ['24 núcleos (8P + 16E)','Boost Clock: 6.0 GHz'],
                'precio_compra' => 550000,  'precio_venta' => 780000,  'descuento_porcentaje' => 0, 'stock' => 6,  'imagen' => 'productos/i9-14900k.webp',
            ],
            [
                'nombre'        => 'ASUS ROG Strix B550-F Gaming',
                'categoria_id'  => $hw,
                'descripcion'   => 'Motherboard ATX con soporte para Ryzen 5000 y 3000.',
                'especificaciones' => ['Socket AM4','DDR4 hasta 4400 MHz'],
                'precio_compra' => 180000,  'precio_venta' => 260000,  'descuento_porcentaje' => 10, 'stock' => 7,  'imagen' => 'productos/asus-b550f.webp',
            ],
            [
                'nombre'        => 'Corsair Vengeance DDR5 32GB',
                'categoria_id'  => $hw,
                'descripcion'   => 'Kit de memoria DDR5 de alta velocidad.',
                'especificaciones' => ['32 GB (2x16 GB)','DDR5-6000 MHz'],
                'precio_compra' => 120000,  'precio_venta' => 170000,  'descuento_porcentaje' => 20, 'stock' => 15, 'imagen' => 'productos/ram.webp',
            ],
            [
                'nombre'        => 'Samsung 980 Pro 2TB NVMe',
                'categoria_id'  => $hw,
                'descripcion'   => 'SSD NVMe PCIe 4.0 de alto rendimiento.',
                'especificaciones' => ['2 TB de capacidad','Lectura: 7000 MB/s'],
                'precio_compra' => 130000,  'precio_venta' => 185000,  'descuento_porcentaje' => 0, 'stock' => 12, 'imagen' => 'productos/samsung-980pro.webp',
            ],
            [
                'nombre'        => 'Corsair iCUE H150i Elite LCD',
                'categoria_id'  => $hw,
                'descripcion'   => 'Refrigeración líquida AIO de 360mm con pantalla LCD.',
                'especificaciones' => ['Radiador 360mm','Display LCD IPS 2.1"'],
                'precio_compra' => 160000,  'precio_venta' => 230000,  'descuento_porcentaje' => 5, 'stock' => 8,  'imagen' => 'productos/corsair-h150i.webp',
            ],
            [
                'nombre'        => 'Corsair RM750x 750W',
                'categoria_id'  => $hw,
                'descripcion'   => 'Fuente de alimentación modular 80 PLUS Gold.',
                'especificaciones' => ['750W de potencia','80 PLUS Gold'],
                'precio_compra' => 110000,  'precio_venta' => 158000,  'descuento_porcentaje' => 0, 'stock' => 10, 'imagen' => 'productos/corsair-rm750x.webp',
            ],
            [
                'nombre'        => 'NZXT H5 Flow',
                'categoria_id'  => $hw,
                'descripcion'   => 'Gabinete ATX minimalista con panel frontal mesh.',
                'especificaciones' => ['Factor ATX Mid-Tower','Panel frontal mesh'],
                'precio_compra' => 95000,   'precio_venta' => 135000,  'descuento_porcentaje' => 10, 'stock' => 7,  'imagen' => 'productos/nzxt-h5.webp',
            ],

            // ── CONSOLAS ────────────────────────────────────────────────────
            [
                'nombre'        => 'PlayStation 5',
                'categoria_id'  => $con,
                'descripcion'   => 'La consola de nueva generación de Sony.',
                'especificaciones' => ['CPU: AMD Zen 2','SSD: 825 GB'],
                'precio_compra' => 600000,  'precio_venta' => 850000,  'descuento_porcentaje' => 0, 'stock' => 5,  'imagen' => 'productos/ps5.webp',
            ],
            [
                'nombre'        => 'Xbox Series X',
                'categoria_id'  => $con,
                'descripcion'   => 'La consola más potente de Microsoft.',
                'especificaciones' => ['CPU: AMD Zen 2','GPU: 12 TFLOPS'],
                'precio_compra' => 550000,  'precio_venta' => 780000,  'descuento_porcentaje' => 0, 'stock' => 4,  'imagen' => 'productos/xboxx.webp',
            ],
            [
                'nombre'        => 'Steam Deck OLED',
                'categoria_id'  => $con,
                'descripcion'   => 'PC gaming portátil de Valve.',
                'especificaciones' => ['Pantalla OLED 7.4"','Batería: hasta 12 horas'],
                'precio_compra' => 400000,  'precio_venta' => 580000,  'descuento_porcentaje' => 5, 'stock' => 6,  'imagen' => 'productos/steam-deck.webp',
            ],
            [
                'nombre'        => 'Nintendo Switch OLED',
                'categoria_id'  => $con,
                'descripcion'   => 'La versión mejorada de Switch con pantalla OLED.',
                'especificaciones' => ['Pantalla OLED 7"','64 GB almacenamiento'],
                'precio_compra' => 280000,  'precio_venta' => 390000,  'descuento_porcentaje' => 0, 'stock' => 10, 'imagen' => 'productos/switch.webp',
            ],
            [
                'nombre'        => 'Nintendo Switch 2',
                'categoria_id'  => $con,
                'descripcion'   => 'La nueva generación de la consola híbrida.',
                'especificaciones' => ['Pantalla LCD 7.9"','RAM: 12 GB'],
                'precio_compra' => 350000,  'precio_venta' => 490000,  'descuento_porcentaje' => 0, 'stock' => 3,  'imagen' => 'productos/sw2.webp',
            ],

            // ── PERIFÉRICOS ─────────────────────────────────────────────────
            [
                'nombre'        => 'HyperX Cloud II',
                'categoria_id'  => $per,
                'descripcion'   => 'Auriculares gaming con sonido envolvente.',
                'especificaciones' => ['Drivers 53mm','Sonido virtual 7.1'],
                'precio_compra' => 65000,   'precio_venta' => 92000,   'descuento_porcentaje' => 25, 'stock' => 14, 'imagen' => 'productos/hyperx-cloud2.webp',
            ],
            [
                'nombre'        => 'Logitech G Pro X Superlight 2',
                'categoria_id'  => $per,
                'descripcion'   => 'Mouse gaming ultraliviano.',
                'especificaciones' => ['Sensor HERO 2','Peso: <60g'],
                'precio_compra' => 85000,   'precio_venta' => 120000,  'descuento_porcentaje' => 0, 'stock' => 9,  'imagen' => 'productos/logitech-gpro.webp',
            ],
            [
                'nombre'        => 'Razer BlackWidow V4',
                'categoria_id'  => $per,
                'descripcion'   => 'Teclado mecánico gaming.',
                'especificaciones' => ['Switches Razer Yellow','RGB Chroma'],
                'precio_compra' => 75000,   'precio_venta' => 108000,  'descuento_porcentaje' => 10, 'stock' => 11, 'imagen' => 'productos/razer-blackwidow.webp',
            ],
            [
                'nombre'        => 'DualSense PlayStation 5',
                'categoria_id'  => $per,
                'descripcion'   => 'El control oficial de PS5.',
                'especificaciones' => ['Gatillos adaptativos','Háptica'],
                'precio_compra' => 55000,   'precio_venta' => 78000,   'descuento_porcentaje' => 0, 'stock' => 16, 'imagen' => 'productos/mando-ps5.webp',
            ],
            [
                'nombre'        => 'Xbox Elite Controller Series 2',
                'categoria_id'  => $per,
                'descripcion'   => 'El control más premium de Microsoft.',
                'especificaciones' => ['Palancas intercambiables','Batería: 40hs'],
                'precio_compra' => 90000,   'precio_venta' => 128000,  'descuento_porcentaje' => 5, 'stock' => 8,  'imagen' => 'productos/xbox-elite.webp',
            ],
            [
                'nombre'        => 'HyperX QuadCast S',
                'categoria_id'  => $per,
                'descripcion'   => 'Micrófono de condensador USB.',
                'especificaciones' => ['4 patrones polares','RGB'],
                'precio_compra' => 70000,   'precio_venta' => 99000,   'descuento_porcentaje' => 15, 'stock' => 10, 'imagen' => 'productos/mic-quadcast.webp',
            ],
            [
                'nombre'        => 'Thrustmaster T300RS GT',
                'categoria_id'  => $per,
                'descripcion'   => 'Volante de carreras con fuerza de retorno.',
                'especificaciones' => ['Rotación 1080°','Force Feedback'],
                'precio_compra' => 220000,  'precio_venta' => 310000,  'descuento_porcentaje' => 0, 'stock' => 3,  'imagen' => 'productos/tm.webp',
            ],

            // ── TV & MONITORES ───────────────────────────────────────────────
            [
                'nombre'        => 'ASUS ROG Swift Pro PG248QP',
                'categoria_id'  => $tv,
                'descripcion'   => 'Monitor gaming Full HD de 360Hz.',
                'especificaciones' => ['24" FHD','360Hz'],
                'precio_compra' => 350000,  'precio_venta' => 490000,  'descuento_porcentaje' => 0, 'stock' => 4,  'imagen' => 'productos/monitor-asus-360hz.webp',
            ],
            [
                'nombre'        => 'LG UltraGear 27GP950-B',
                'categoria_id'  => $tv,
                'descripcion'   => 'Monitor 4K de 144Hz.',
                'especificaciones' => ['27" 4K','144Hz'],
                'precio_compra' => 220000,  'precio_venta' => 308000,  'descuento_porcentaje' => 10, 'stock' => 6,  'imagen' => 'productos/monitor-lg-27.webp',
            ],
            [
                'nombre'        => 'Samsung Odyssey G7 32"',
                'categoria_id'  => $tv,
                'descripcion'   => 'Monitor gaming curvo QLED de 240Hz.',
                'especificaciones' => ['32" 2K','240Hz'],
                'precio_compra' => 280000,  'precio_venta' => 392000,  'descuento_porcentaje' => 15, 'stock' => 5,  'imagen' => 'productos/monitor-samsung-g7.webp',
            ],
            [
                'nombre'        => 'LG OLED C3 55"',
                'categoria_id'  => $tv,
                'descripcion'   => 'Smart TV OLED con 4 puertos HDMI 2.1.',
                'especificaciones' => ['55" OLED 4K 120Hz','HDR'],
                'precio_compra' => 650000,  'precio_venta' => 910000,  'descuento_porcentaje' => 0, 'stock' => 3,  'imagen' => 'productos/tv-lg-oled55.webp',
            ],
            [
                'nombre'        => 'Samsung Neo QLED 8K 55"',
                'categoria_id'  => $tv,
                'descripcion'   => 'TV 8K con tecnología Quantum Matrix Pro.',
                'especificaciones' => ['55" 8K','Upscaling IA'],
                'precio_compra' => 900000,  'precio_venta' => 1260000, 'descuento_porcentaje' => 5, 'stock' => 2,  'imagen' => 'productos/tv-samsung-8k.webp',
            ],
        ];

        foreach ($productos as $data) {
            Producto::firstOrCreate(
                ['nombre' => $data['nombre']],
                $data
            );
        }
    }
}
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
                'descripcion'   => 'La RTX 4070 Super ofrece rendimiento excepcional en 1440p y es capaz de mover títulos exigentes en 4K con ray tracing. Incluye soporte para DLSS 3.5 y Frame Generation.',
                'especificaciones' => ['12 GB GDDR6X','DLSS 3.5 con Frame Generation','Ray Tracing de 3ra generación','Boost Clock: 2475 MHz','Consumo: 220W TDP'],
                'precio_compra' => 750000,  'precio_venta' => 1050000, 'stock' => 8,  'imagen' => null,
            ],
            [
                'nombre'        => 'NVIDIA RTX 5090',
                'categoria_id'  => $hw,
                'descripcion'   => 'La GPU más potente del mercado. Diseñada para 4K y 8K gaming con DLSS 4 y Multi Frame Generation. Rendimiento sin igual para los entusiastas más exigentes.',
                'especificaciones' => ['32 GB GDDR7','DLSS 4 con Multi Frame Generation','512-bit bus','Boost Clock: 2.9 GHz','Consumo: 575W TDP'],
                'precio_compra' => 2200000, 'precio_venta' => 2800000, 'stock' => 3,  'imagen' => 'productos/rtx5090.webp',
            ],
            [
                'nombre'        => 'AMD RX 6600 XT',
                'categoria_id'  => $hw,
                'descripcion'   => 'Excelente relación precio-rendimiento para 1080p gaming. Ideal para armar un PC gaming de entrada sin sacrificar fluidez en los títulos más populares.',
                'especificaciones' => ['8 GB GDDR6','128-bit bus','Boost Clock: 2589 MHz','Consumo: 160W TDP','Compatible con FidelityFX Super Resolution'],
                'precio_compra' => 280000,  'precio_venta' => 390000,  'stock' => 9,  'imagen' => 'productos/rx6600xt.webp',
            ],
            [
                'nombre'        => 'AMD Ryzen 7 7800X3D',
                'categoria_id'  => $hw,
                'descripcion'   => 'El procesador gaming más rápido gracias a la tecnología 3D V-Cache. Domina en juegos a 1080p y 1440p superando a cualquier rival en títulos optimizados.',
                'especificaciones' => ['8 núcleos / 16 hilos','3D V-Cache de 96 MB','Boost Clock: 5.0 GHz','TDP: 120W','Socket AM5'],
                'precio_compra' => 420000,  'precio_venta' => 620000,  'stock' => 12, 'imagen' => null,
            ],
            [
                'nombre'        => 'AMD Ryzen 5 5600G',
                'categoria_id'  => $hw,
                'descripcion'   => 'Procesador con gráficos integrados Radeon Vega. Perfecta solución para armar un PC sin GPU dedicada, con capacidad para gaming casual en 1080p.',
                'especificaciones' => ['6 núcleos / 12 hilos','GPU integrada Radeon Vega 7','Boost Clock: 4.4 GHz','TDP: 65W','Socket AM4'],
                'precio_compra' => 160000,  'precio_venta' => 230000,  'stock' => 11, 'imagen' => 'productos/ryzen55600g.webp',
            ],
            [
                'nombre'        => 'Intel Core i9-14900K',
                'categoria_id'  => $hw,
                'descripcion'   => 'El procesador de escritorio más potente de Intel. 24 núcleos para tareas de creación de contenido y gaming de alto rendimiento en simultáneo.',
                'especificaciones' => ['24 núcleos (8P + 16E)','Boost Clock: 6.0 GHz','Cache L3: 36 MB','TDP: 125W (PBP)','Socket LGA1700'],
                'precio_compra' => 550000,  'precio_venta' => 780000,  'stock' => 6,  'imagen' => 'productos/i9-14900k.webp',
            ],
            [
                'nombre'        => 'ASUS ROG Strix B550-F Gaming',
                'categoria_id'  => $hw,
                'descripcion'   => 'Motherboard ATX con soporte para Ryzen 5000 y 3000. Diseño robusto, PCIe 4.0, conectividad WiFi 6 y audio SupremeFX de alta fidelidad.',
                'especificaciones' => ['Socket AM4','DDR4 hasta 4400 MHz','PCIe 4.0 x16','WiFi 6 integrado','2.5Gb Ethernet'],
                'precio_compra' => 180000,  'precio_venta' => 260000,  'stock' => 7,  'imagen' => 'productos/asus-b550f.webp',
            ],
            [
                'nombre'        => 'Corsair Vengeance DDR5 32GB',
                'categoria_id'  => $hw,
                'descripcion'   => 'Kit de memoria DDR5 de alta velocidad para plataformas Intel y AMD de última generación. Optimizado para overclocking con perfil XMP 3.0.',
                'especificaciones' => ['32 GB (2x16 GB)','DDR5-6000 MHz','CL30','XMP 3.0','Disipador de aluminio de bajo perfil'],
                'precio_compra' => 120000,  'precio_venta' => 170000,  'stock' => 15, 'imagen' => 'productos/ram.webp',
            ],
            [
                'nombre'        => 'Samsung 980 Pro 2TB NVMe',
                'categoria_id'  => $hw,
                'descripcion'   => 'SSD NVMe PCIe 4.0 de alto rendimiento con velocidades de lectura de hasta 7000 MB/s. Ideal para acortar tiempos de carga y manejar proyectos pesados.',
                'especificaciones' => ['2 TB de capacidad','Lectura: 7000 MB/s','Escritura: 6900 MB/s','PCIe 4.0 x4 NVMe 1.3c','Factor de forma: M.2 2280'],
                'precio_compra' => 130000,  'precio_venta' => 185000,  'stock' => 12, 'imagen' => 'productos/samsung-980pro.webp',
            ],
            [
                'nombre'        => 'Corsair iCUE H150i Elite LCD',
                'categoria_id'  => $hw,
                'descripcion'   => 'Refrigeración líquida AIO de 360mm con pantalla LCD integrada de 2.1". Control total de velocidad de ventiladores y bomba vía software iCUE.',
                'especificaciones' => ['Radiador 360mm','Display LCD IPS 2.1"','3 ventiladores LL120 RGB','Compatible LGA1700, AM5, AM4','Control por software iCUE'],
                'precio_compra' => 160000,  'precio_venta' => 230000,  'stock' => 8,  'imagen' => 'productos/corsair-h150i.webp',
            ],
            [
                'nombre'        => 'Corsair RM750x 750W',
                'categoria_id'  => $hw,
                'descripcion'   => 'Fuente de alimentación modular 80 PLUS Gold con ventilador ZeroRPM en cargas bajas. Construida para sistemas gaming de alto rendimiento.',
                'especificaciones' => ['750W de potencia','80 PLUS Gold','Totalmente modular','Ventilador 135mm ZeroRPM','Garantía 10 años'],
                'precio_compra' => 110000,  'precio_venta' => 158000,  'stock' => 10, 'imagen' => 'productos/corsair-rm750x.webp',
            ],
            [
                'nombre'        => 'NZXT H5 Flow',
                'categoria_id'  => $hw,
                'descripcion'   => 'Gabinete ATX minimalista con panel frontal mesh para máximo flujo de aire. Diseño interior limpio con soporte para AIOs de hasta 360mm.',
                'especificaciones' => ['Factor ATX Mid-Tower','Panel frontal mesh','Soporte AIO 360mm frontal','2x USB-A + 1x USB-C frontal','Vidrio templado lateral'],
                'precio_compra' => 95000,   'precio_venta' => 135000,  'stock' => 7,  'imagen' => 'productos/nzxt-h5.webp',
            ],

            // ── CONSOLAS ────────────────────────────────────────────────────
            [
                'nombre'        => 'PlayStation 5',
                'categoria_id'  => $con,
                'descripcion'   => 'La consola de nueva generación de Sony con SSD ultrarrápido, ray tracing nativo y el innovador control DualSense con retroalimentación háptica y gatillos adaptativos.',
                'especificaciones' => ['CPU: AMD Zen 2, 8 núcleos a 3.5 GHz','GPU: 10.28 TFLOPS, 36 CUs a 2.23 GHz','SSD: 825 GB (5.5 GB/s)','RAM: 16 GB GDDR6','Resolución: hasta 8K'],
                'precio_compra' => 600000,  'precio_venta' => 850000,  'stock' => 5,  'imagen' => 'productos/ps5.webp',
            ],
            [
                'nombre'        => 'Xbox Series X',
                'categoria_id'  => $con,
                'descripcion'   => 'La consola más potente de Microsoft con 12 TFLOPS de rendimiento. Compatible con miles de juegos de Xbox One, 360 y Xbox original mediante retrocompatibilidad.',
                'especificaciones' => ['CPU: AMD Zen 2, 8 núcleos a 3.8 GHz','GPU: 12 TFLOPS RDNA 2','SSD: 1 TB NVMe','RAM: 16 GB GDDR6','Resolución: hasta 4K 120fps'],
                'precio_compra' => 550000,  'precio_venta' => 780000,  'stock' => 4,  'imagen' => 'productos/xboxx.webp',
            ],
            [
                'nombre'        => 'Steam Deck OLED',
                'categoria_id'  => $con,
                'descripcion'   => 'PC gaming portátil de Valve con pantalla OLED HDR de 7.4". Corré tu biblioteca completa de Steam en cualquier lugar con hasta 12 horas de batería.',
                'especificaciones' => ['Pantalla OLED 7.4" HDR 90Hz','CPU: AMD Zen 2 + GPU RDNA 2','RAM: 16 GB LPDDR5','SSD: 512 GB NVMe','Batería: hasta 12 horas'],
                'precio_compra' => 400000,  'precio_venta' => 580000,  'stock' => 6,  'imagen' => 'productos/steam-deck.webp',
            ],
            [
                'nombre'        => 'Nintendo Switch OLED',
                'categoria_id'  => $con,
                'descripcion'   => 'La versión mejorada de Switch con pantalla OLED de 7" y mayor almacenamiento. Jugá en TV, sobremesa o modo portátil con los mismos controles Joy-Con.',
                'especificaciones' => ['Pantalla OLED 7" 720p','64 GB de almacenamiento interno','Slot microSD','Batería: 4.5-9 horas','Dock con LAN integrada'],
                'precio_compra' => 280000,  'precio_venta' => 390000,  'stock' => 10, 'imagen' => 'productos/switch.webp',
            ],
            [
                'nombre'        => 'Nintendo Switch 2',
                'categoria_id'  => $con,
                'descripcion'   => 'La nueva generación de la consola híbrida de Nintendo. Mayor potencia, pantalla más grande y nuevas funciones para el modo multijugador local.',
                'especificaciones' => ['Pantalla LCD 7.9" 1080p','Procesador NVIDIA mejorado','RAM: 12 GB','Almacenamiento: 256 GB','Batería: hasta 6 horas'],
                'precio_compra' => 350000,  'precio_venta' => 490000,  'stock' => 3,  'imagen' => 'productos/sw2.webp',
            ],

            // ── PERIFÉRICOS ─────────────────────────────────────────────────
            [
                'nombre'        => 'HyperX Cloud II',
                'categoria_id'  => $per,
                'descripcion'   => 'Auriculares gaming con drivers de 53mm y sonido envolvente virtual 7.1. Micrófono desmontable con cancelación de ruido y compatibilidad multiplataforma.',
                'especificaciones' => ['Drivers 53mm','Sonido virtual 7.1','Micrófono desmontable','Frecuencia: 15Hz-25kHz','Compatible PC, PS4, Xbox, Switch'],
                'precio_compra' => 65000,   'precio_venta' => 92000,   'stock' => 14, 'imagen' => 'productos/hyperx-cloud2.webp',
            ],
            [
                'nombre'        => 'Logitech G Pro X Superlight 2',
                'categoria_id'  => $per,
                'descripcion'   => 'Mouse gaming ultraliviano de menos de 60g con sensor HERO 2 de 32000 DPI. El mouse preferido por los jugadores profesionales de esports a nivel mundial.',
                'especificaciones' => ['Sensor HERO 2 — 32000 DPI','Peso: menos de 60g','Conexión inalámbrica LIGHTSPEED','Batería: hasta 95 horas','5 botones programables'],
                'precio_compra' => 85000,   'precio_venta' => 120000,  'stock' => 9,  'imagen' => 'productos/logitech-gpro.webp',
            ],
            [
                'nombre'        => 'Razer BlackWidow V4',
                'categoria_id'  => $per,
                'descripcion'   => 'Teclado mecánico gaming con switches Razer Yellow de activa lineal. RGB Chroma con 16.8M de colores y teclas multimedia dedicadas.',
                'especificaciones' => ['Switches Razer Yellow (lineales)','RGB Chroma por tecla','Teclas multimedia dedicadas','Reposamuñecas magnético','Anti-ghosting completo'],
                'precio_compra' => 75000,   'precio_venta' => 108000,  'stock' => 11, 'imagen' => 'productos/razer-blackwidow.webp',
            ],
            [
                'nombre'        => 'DualSense PlayStation 5',
                'categoria_id'  => $per,
                'descripcion'   => 'El control oficial de PS5 con retroalimentación háptica y gatillos adaptativos que simulan resistencia física. Micrófono y parlante integrados.',
                'especificaciones' => ['Gatillos adaptativos L2/R2','Retroalimentación háptica','Micrófono y parlante integrados','USB-C + Bluetooth 5.1','Batería recargable'],
                'precio_compra' => 55000,   'precio_venta' => 78000,   'stock' => 16, 'imagen' => 'productos/mando-ps5.webp',
            ],
            [
                'nombre'        => 'Xbox Elite Controller Series 2',
                'categoria_id'  => $per,
                'descripcion'   => 'El control más premium de Microsoft con palancas intercambiables, gatillos con recorrido ajustable y batería recargable de hasta 40 horas.',
                'especificaciones' => ['Palancas y D-pad intercambiables','Gatillos con recorrido ajustable','Batería: hasta 40 horas','Conexión inalámbrica + USB-C','Memoriza hasta 3 perfiles'],
                'precio_compra' => 90000,   'precio_venta' => 128000,  'stock' => 8,  'imagen' => 'productos/xbox-elite.webp',
            ],
            [
                'nombre'        => 'HyperX QuadCast S',
                'categoria_id'  => $per,
                'descripcion'   => 'Micrófono de condensador USB con iluminación RGB y cuatro patrones polares seleccionables. Ideal para streaming, podcasting y comunicación en juego.',
                'especificaciones' => ['4 patrones polares','Frecuencia: 20Hz-20kHz','Resolución: 24 bit / 96kHz','LED RGB personalizable','Conexión USB-A y USB-C'],
                'precio_compra' => 70000,   'precio_venta' => 99000,   'stock' => 10, 'imagen' => 'productos/mic-quadcast.webp',
            ],
            [
                'nombre'        => 'Thrustmaster T300RS GT',
                'categoria_id'  => $per,
                'descripcion'   => 'Volante de carreras con motor de doble correa y fuerza de retorno de 1080°. Compatible con PlayStation y PC, incluye pedales de dos ejes.',
                'especificaciones' => ['Rotación: 1080°','Motor dual belt force feedback','Compatible PS5, PS4, PC','Pedales de 2 ejes incluidos','Hub de volante intercambiable'],
                'precio_compra' => 220000,  'precio_venta' => 310000,  'stock' => 3,  'imagen' => 'productos/tm.webp',
            ],

            // ── TV & MONITORES ───────────────────────────────────────────────
            [
                'nombre'        => 'ASUS ROG Swift Pro PG248QP',
                'categoria_id'  => $tv,
                'descripcion'   => 'Monitor gaming Full HD de 360Hz con tecnología NVIDIA G-Sync. Diseñado específicamente para jugadores competitivos que necesitan cada fotograma.',
                'especificaciones' => ['24" Full HD 1920x1080','360Hz con NVIDIA G-Sync','1ms GtG','Panel TN','HDMI 2.0 + DisplayPort 1.4'],
                'precio_compra' => 350000,  'precio_venta' => 490000,  'stock' => 4,  'imagen' => 'productos/monitor-asus-360hz.webp',
            ],
            [
                'nombre'        => 'LG UltraGear 27GP950-B',
                'categoria_id'  => $tv,
                'descripcion'   => 'Monitor 4K de 144Hz con panel Nano IPS y HDMI 2.1. Perfecto para PS5 y Xbox Series X aprovechando al máximo la resolución y tasa de refresco.',
                'especificaciones' => ['27" 4K UHD 3840x2160','144Hz con HDMI 2.1','1ms GtG Nano IPS','NVIDIA G-Sync + AMD FreeSync','HDR 600'],
                'precio_compra' => 220000,  'precio_venta' => 308000,  'stock' => 6,  'imagen' => 'productos/monitor-lg-27.webp',
            ],
            [
                'nombre'        => 'Samsung Odyssey G7 32"',
                'categoria_id'  => $tv,
                'descripcion'   => 'Monitor gaming curvo QLED de 240Hz con resolución 2K. La curvatura 1000R cubre todo tu campo visual para una inmersión total en el juego.',
                'especificaciones' => ['32" 2K QHD 2560x1440','240Hz','1ms MPRT','Curvatura 1000R QLED','G-Sync Compatible + FreeSync Premium Pro'],
                'precio_compra' => 280000,  'precio_venta' => 392000,  'stock' => 5,  'imagen' => 'productos/monitor-samsung-g7.webp',
            ],
            [
                'nombre'        => 'LG OLED C3 55"',
                'categoria_id'  => $tv,
                'descripcion'   => 'Smart TV OLED con 4 puertos HDMI 2.1 y soporte para 4K 120fps. Negros perfectos, contraste infinito y procesador α9 Gen6 para una imagen excepcional.',
                'especificaciones' => ['55" OLED 4K 120Hz','4x HDMI 2.1','Dolby Vision IQ + Dolby Atmos','Procesador α9 Gen6','webOS 23 con ThinQ AI'],
                'precio_compra' => 650000,  'precio_venta' => 910000,  'stock' => 3,  'imagen' => 'productos/tv-lg-oled55.webp',
            ],
            [
                'nombre'        => 'Samsung Neo QLED 8K 55"',
                'categoria_id'  => $tv,
                'descripcion'   => 'TV 8K con tecnología Quantum Matrix Pro y upscaling de inteligencia artificial. La experiencia visual más avanzada disponible para el hogar.',
                'especificaciones' => ['55" 8K UHD 7680x4320','Quantum Matrix Pro','AI 8K Upscaling Neural Quantum','4x HDMI 2.1','Tizen OS con Gaming Hub'],
                'precio_compra' => 900000,  'precio_venta' => 1260000, 'stock' => 2,  'imagen' => 'productos/tv-samsung-8k.webp',
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

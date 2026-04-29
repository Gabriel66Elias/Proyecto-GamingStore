<?php

namespace App\Http\Controllers;

class ProductoController extends Controller
{
    private function getProductos()
    {
        return [
            // --- CONSOLAS ---
            0 => [
                'nombre' => 'PlayStation 5',
                'descripcion' => 'Vive una experiencia de juego de nueva generación con la PlayStation 5.',
                'imagen' => '/img/ps5.webp',
                'precio' => 1200000,
                'stock' => 1,
                'specs' => ['Procesador AMD Ryzen Zen 2', '825GB SSD', 'DualSense included'],
                'categoria' => 'Consolas'
            ],
            2 => [
                'nombre' => 'Nintendo Switch 2',
                'descripcion' => 'Juega en el televisor o en modo portátil con total libertad.',
                'imagen' => '/img/sw2.webp',
                'precio' => 459999,
                'stock' => 10,
                'specs' => ['Pantalla 6.2"', '32GB memoria', 'Joy-Con'],
                'categoria' => 'Consolas'
            ],
            6 => [
                'nombre' => 'Xbox Series X',
                'descripcion' => 'La Xbox más rápida y potente de la historia. Juega a miles de títulos de cuatro generaciones.',
                'imagen' => '/img/xboxx.webp',
                'precio' => 1150000,
                'stock' => 3,
                'specs' => ['12 Teraflops de potencia', 'SSD NVMe de 1TB', 'Juego en 4K y hasta 120 FPS'],
                'categoria' => 'Consolas'
            ],
            16 => [
                'nombre' => 'Nintendo Switch OLED',
                'descripcion' => 'La versión mejorada con una pantalla OLED vibrante, soporte ajustable y audio mejorado.',
                'imagen' => '/img/switch.webp',
                'precio' => 550000,
                'stock' => 8,
                'specs' => ['Pantalla OLED 7"', '64GB almacenamiento interno', 'Soporte ancho ajustable'],
                'categoria' => 'Consolas'
            ],
            18 => [
                'nombre' => 'Steam Deck OLED 512GB',
                'descripcion' => 'Juega tu biblioteca de PC en cualquier lugar con colores espectaculares y HDR.',
                'imagen' => '/img/steam-deck.webp',
                'precio' => 1100000,
                'stock' => 4,
                'specs' => ['Pantalla HDR OLED 7.4"', '512GB NVMe SSD', 'APU AMD Zen 2 ultrarrápida'],
                'categoria' => 'Consolas'
            ],

            // --- HARDWARE ---
            3 => [
                'nombre' => 'Tarjeta grafica RTX 5090',
                'descripcion' => 'Descubre la tarjeta grafica mas poderosa de nvidea.',
                'imagen' => '/img/rtx5090.webp',
                'precio' => 2600000,
                'stock' => 2,
                'specs' => ['32GB GDDR7', 'Arquitectura Blackwell', 'DLSS 4.0'],
                'categoria' => 'Hardware'
            ],
            4 => [
                'nombre' => 'Tarjeta grafica RX 6600xt',
                'descripcion' => 'Tarjeta grafica de gama media exelente para juego en 1080p',
                'imagen' => '/img/rx6600xt.webp',
                'precio' => 450000,
                'stock' => 3,
                'specs' => ['8GB GDDR6', 'FSR 3.0', '1080p Ultra'],
                'categoria' => 'Hardware'
            ],
            5 => [
                'nombre' => 'Memoria RAM 32gb (x2 16gb) HyperX',
                'descripcion' => 'Pack de 2 memorias ram de 16gb 3200hz con rgb',
                'imagen' => '/img/ram.webp',
                'precio' => 98000,
                'stock' => 3,
                'specs' => ['3200MHz', 'CL16', 'RGB Lighting'],
                'categoria' => 'Hardware'
            ],
            7 => [
                'nombre' => 'Procesador AMD Ryzen 5 5600G',
                'descripcion' => 'Rendimiento potente para gaming y multitarea con gráficos integrados Radeon.',
                'imagen' => '/img/ryzen55600g.webp',
                'precio' => 245000,
                'stock' => 8,
                'specs' => ['6 Núcleos / 12 Hilos', 'Gráficos integrados Radeon', 'Reloj base 3.9 GHz', 'Socket AM4'],
                'categoria' => 'Hardware'
            ],
            8 => [
                'nombre' => 'Motherboard ASUS ROG Strix B550-F',
                'descripcion' => 'Placa base gaming optimizada para procesadores Ryzen con PCIe 4.0 y Aura Sync RGB.',
                'imagen' => '/img/asus-b550f.webp',
                'precio' => 290000,
                'stock' => 5,
                'specs' => ['Chipset B550', 'Soporte PCIe 4.0', 'Doble M.2', 'Audio SupremeFX'],
                'categoria' => 'Hardware'
            ],
            9 => [
                'nombre' => 'SSD M.2 1TB Samsung 980 PRO',
                'descripcion' => 'Velocidades de lectura asombrosas para que tus juegos carguen al instante.',
                'imagen' => '/img/samsung-980pro.webp',
                'precio' => 165000,
                'stock' => 15,
                'specs' => ['NVMe M.2 PCIe 4.0', 'Lectura hasta 7000 MB/s', 'Caché DRAM'],
                'categoria' => 'Hardware'
            ],
            10 => [
                'nombre' => 'Fuente de Poder Corsair RM750x',
                'descripcion' => 'Energía limpia, silenciosa y eficiente para los componentes más exigentes.',
                'imagen' => '/img/corsair-rm750x.webp',
                'precio' => 195000,
                'stock' => 4,
                'specs' => ['750 Watts', 'Certificación 80 Plus Gold', 'Totalmente Modular'],
                'categoria' => 'Hardware'
            ],
            19 => [
                'nombre' => 'Procesador Intel Core i9-14900K',
                'descripcion' => 'Rendimiento extremo de 14va generación para gaming competitivo y creación de contenido.',
                'imagen' => '/img/i9-14900k.webp',
                'precio' => 950000,
                'stock' => 5,
                'specs' => ['24 Núcleos / 32 Hilos', 'Frecuencia turbo hasta 6.0 GHz', 'Socket LGA 1700'],
                'categoria' => 'Hardware'
            ],
            20 => [
                'nombre' => 'Gabinete NZXT H5 Flow',
                'descripcion' => 'Flujo de aire optimizado con un diseño limpio, minimalista y panel de vidrio templado.',
                'imagen' => '/img/nzxt-h5.webp',
                'precio' => 180000,
                'stock' => 10,
                'specs' => ['Panel frontal perforado', 'Ventilador inferior dedicado GPU', 'Vidrio templado'],
                'categoria' => 'Hardware'
            ],
            21 => [
                'nombre' => 'Watercooling Corsair iCUE H150i',
                'descripcion' => 'Mantén las temperaturas a raya con este sistema de refrigeración líquida de 360mm.',
                'imagen' => '/img/corsair-h150i.webp',
                'precio' => 260000,
                'stock' => 6,
                'specs' => ['Radiador de 360mm', '3x Ventiladores magnéticos RGB', 'Bomba de alto rendimiento'],
                'categoria' => 'Hardware'
            ],

            // --- PERIFÉRICOS ---
            1 => [
                'nombre' => 'Mando - PlayStation 5',
                'descripcion' => 'Descubre una experiencia de juego más profunda con retroalimentación háptica.',
                'imagen' => '/img/mando-ps5.webp',
                'precio' => 75000,
                'stock' => 5,
                'specs' => ['Retroalimentación háptica', 'Gatillos adaptativos'],
                'categoria' => 'Periféricos'
            ],
            11 => [
                'nombre' => 'Teclado Razer BlackWidow V3',
                'descripcion' => 'El teclado mecánico icónico para gamers, ahora con switches mejorados y RGB Chroma.',
                'imagen' => '/img/razer-blackwidow.webp',
                'precio' => 185000,
                'stock' => 6,
                'specs' => ['Switches Mecánicos Verdes', 'Iluminación RGB Razer Chroma', 'Reposamuñecas ergonómico'],
                'categoria' => 'Periféricos'
            ],
            12 => [
                'nombre' => 'Mouse Logitech G Pro X Superlight',
                'descripcion' => 'Ratón ultraligero diseñado para profesionales de los eSports. Sin cables, sin límites.',
                'imagen' => '/img/logitech-gpro.webp',
                'precio' => 150000,
                'stock' => 7,
                'specs' => ['Peso menor a 63 gramos', 'Sensor HERO 25K', 'Inalámbrico LIGHTSPEED'],
                'categoria' => 'Periféricos'
            ],
            13 => [
                'nombre' => 'Auriculares HyperX Cloud II',
                'descripcion' => 'Comodidad legendaria y sonido inmersivo para largas sesiones de juego.',
                'imagen' => '/img/hyperx-cloud2.webp',
                'precio' => 120000,
                'stock' => 12,
                'specs' => ['Sonido Envolvente Virtual 7.1', 'Micrófono con cancelación de ruido', 'Almohadillas de memory foam'],
                'categoria' => 'Periféricos'
            ],
            22 => [
                'nombre' => 'Teclado Magnetico Attack Shark X68 HE',
                'descripcion' => 'teclado mecánico magnético de 65% diseñado para gaming competitivo, destacando por su Rapid Trigger (RT) con precisión de 0,01mm  , polling rate de 8000 hz y switches magnéticos.',
                'imagen' => '/img/tm.webp',
                'precio' => 112000,
                'stock' => 3,
                'specs' => ['Tecnología Magnética', 'Keycaps PBT', 'Iluminación RGB'],
                'categoria' => 'Periféricos'
            ],
            23 => [
                'nombre' => 'Micrófono HyperX QuadCast S',
                'descripcion' => 'Micrófono USB de condensador con iluminación RGB radiante para streamers y creadores.',
                'imagen' => '/img/mic-quadcast.webp',
                'precio' => 210000,
                'stock' => 8,
                'specs' => ['Iluminación RGB personalizable', 'Sensor táctil para silenciar', 'Montura antivibración'],
                'categoria' => 'Periféricos'
            ],
            24 => [
                'nombre' => 'Mando Xbox Elite Series 2',
                'descripcion' => 'El control más avanzado del mundo, diseñado para adaptarse a tu estilo de juego.',
                'imagen' => '/img/xbox-elite.webp',
                'precio' => 240000,
                'stock' => 5,
                'specs' => ['Palancas de tensión ajustable', 'Gatillos de alta sensibilidad', 'Batería interna recargable'],
                'categoria' => 'Periféricos'
            ],

            // --- GAMING TVs & MONITORES ---
            14 => [
                'nombre' => 'Monitor Gaming LG UltraGear 27"',
                'descripcion' => 'Monitor IPS de alta tasa de refresco para obtener ventaja competitiva en shooters.',
                'imagen' => '/img/monitor-lg-27.webp',
                'precio' => 420000,
                'stock' => 4,
                'specs' => ['Panel IPS de 27 Pulgadas', 'Tasa de refresco de 144Hz', 'Tiempo de respuesta 1ms', 'G-SYNC Compatible'],
                'categoria' => 'TVs y Monitores'
            ],
            15 => [
                'nombre' => 'Smart TV LG OLED 55" 4K',
                'descripcion' => 'La mejor experiencia visual para consolas de nueva generación con negros puros.',
                'imagen' => '/img/tv-lg-oled55.webp',
                'precio' => 1850000,
                'stock' => 2,
                'specs' => ['55 Pulgadas OLED 4K', 'Tasa de refresco 120Hz', 'HDMI 2.1 con VRR', 'Dolby Vision Gaming'],
                'categoria' => 'TVs y Monitores'
            ],
            25 => [
                'nombre' => 'Monitor Curvo Samsung Odyssey G7 32"',
                'descripcion' => 'Inmersión total y rendimiento extremo gracias a su espectacular curvatura y panel veloz.',
                'imagen' => '/img/monitor-samsung-g7.webp',
                'precio' => 980000,
                'stock' => 4,
                'specs' => ['Panel VA Curvo 1000R', 'Resolución WQHD 1440p', 'Tasa de refresco 240Hz'],
                'categoria' => 'TVs y Monitores'
            ],
            26 => [
                'nombre' => 'Monitor ASUS ROG Swift 360Hz',
                'descripcion' => 'Diseñado específicamente para profesionales de eSports que necesitan la máxima fluidez visual.',
                'imagen' => '/img/monitor-asus-360hz.webp',
                'precio' => 1150000,
                'stock' => 2,
                'specs' => ['Panel Fast IPS 24.5"', 'Tasa de refresco 360Hz', 'NVIDIA Reflex Latency Analyzer'],
                'categoria' => 'TVs y Monitores'
            ],
            27 => [
                'nombre' => 'Smart TV Samsung Neo QLED 65" 8K',
                'descripcion' => 'Detalle absoluto, contraste inigualable y colores vibrantes para el setup de living definitivo.',
                'imagen' => '/img/tv-samsung-8k.webp',
                'precio' => 3500000,
                'stock' => 1,
                'specs' => ['Pantalla 65" Quantum Matrix', 'Resolución Real 8K', 'Tasa de refresco 144Hz', 'Anti-reflejo pro'],
                'categoria' => 'TVs y Monitores'
            ]
        ];
    }
    /**
     * MÉTODO: index()
     * DESCRIPCIÓN: Se ejecuta al entrar a la ruta '/catalogo'. Prepara y organiza
     * los datos antes de enviarlos a la vista.
     */
    public function index()
    {
        // 1. Obtenemos todos los productos brutos
        $productosRaw = $this->getProductos();
        
        // Guardamos el ID dentro del array para no perderlo al agrupar
        foreach ($productosRaw as $id => $producto) {
            $productosRaw[$id]['id'] = $id;
        }

        // Agrupamos por la llave 'categoria'
        $productosAgrupados = collect($productosRaw)->groupBy('categoria');
        
        return view('catalogo', compact('productosAgrupados'));
    }
    /**
     * MÉTODO: show($id)
     * DESCRIPCIÓN: Se ejecuta al entrar al detalle de un producto específico (ej: '/consulta/6').
     * Recibe dinámicamente el $id a través de la URL.
     */
    public function show($id)
    {
        $productos = $this->getProductos();
        // VALIDACIÓN DE SEGURIDAD: 
        // Si el usuario manipula la URL y pone un ID que no existe (ej: /consulta/999),
        // isset() devuelve falso y lo redirigimos forzosamente al catálogo para evitar un error 404/500.
        if (!isset($productos[$id])) {
            return redirect('/catalogo');
        }

        // Si existe, aislamos ese único producto y se lo enviamos a la vista 'consultas'.
        $producto = $productos[$id];
        return view('consultas', compact('producto'));
    }
}
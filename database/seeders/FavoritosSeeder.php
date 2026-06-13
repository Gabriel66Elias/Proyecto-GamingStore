<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Usuario;
use App\Models\Producto;
use App\Models\Favorito;

class FavoritosSeeder extends Seeder
{
    public function run(): void
    {
        $lucas     = Usuario::where('email', 'lucas.garcia@test.com')->first();
        $valentina = Usuario::where('email', 'valentina.lopez@test.com')->first();
        $mateo     = Usuario::where('email', 'mateo.fernandez@test.com')->first();

        $prods = Producto::whereIn('nombre', [
            'NVIDIA RTX 5090',
            'Intel Core i9-14900K',
            'AMD RX 6600 XT',
            'Samsung 980 Pro 2TB NVMe',
            'Corsair iCUE H150i Elite LCD'
        ])->get()->keyBy('nombre');

        if (!$lucas || !$valentina || !$mateo || $prods->isEmpty()) {
            return;
        }

        $favoritos = [
            // Lucas sueña con la PC de gama extrema
            ['usuario_id' => $lucas->id, 'producto_id' => $prods['NVIDIA RTX 5090']->id ?? null],
            ['usuario_id' => $lucas->id, 'producto_id' => $prods['Intel Core i9-14900K']->id ?? null],
            
            // Valentina tiene en la mira refrigeración y almacenamiento
            ['usuario_id' => $valentina->id, 'producto_id' => $prods['Corsair iCUE H150i Elite LCD']->id ?? null],
            ['usuario_id' => $valentina->id, 'producto_id' => $prods['Samsung 980 Pro 2TB NVMe']->id ?? null],

            // Mateo busca la RX
            ['usuario_id' => $mateo->id, 'producto_id' => $prods['AMD RX 6600 XT']->id ?? null],
        ];

        foreach ($favoritos as $fav) {
            if ($fav['producto_id']) {
                Favorito::firstOrCreate($fav);
            }
        }
    }
}
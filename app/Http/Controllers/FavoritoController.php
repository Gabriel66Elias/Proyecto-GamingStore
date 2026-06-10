<?php

namespace App\Http\Controllers;

use App\Models\Favorito;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;

class FavoritoController extends Controller
{
    // Marca/desmarca un producto como favorito del usuario autenticado
    public function toggle(Producto $producto)
    {
        $usuarioId = Auth::id();

        $favorito = Favorito::where('usuario_id', $usuarioId)
            ->where('producto_id', $producto->id)
            ->first();

        if ($favorito) {
            $favorito->delete();
            return response()->json(['favorito' => false]);
        }

        Favorito::create([
            'usuario_id'  => $usuarioId,
            'producto_id' => $producto->id,
        ]);

        return response()->json(['favorito' => true]);
    }
}

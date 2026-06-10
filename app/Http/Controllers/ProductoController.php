<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Resena;
use Illuminate\Support\Facades\Auth;

class ProductoController extends Controller
{
    public function index()
    {
        $categorias = Categoria::all();

        $productosAgrupados = Producto::with('categoria')
            ->get()
            ->groupBy(fn($p) => $p->categoria?->nombre ?? 'Sin categoría');

        $favoritoIds = Auth::check()
            ? Auth::user()->favoritos()->pluck('productos.id')->toArray()
            : [];

        return view('catalogo', compact('productosAgrupados', 'categorias', 'favoritoIds'));
    }

    public function show($id)
    {
        $producto = Producto::with('categoria')->findOrFail($id);

        $esFavorito = Auth::check()
            ? Auth::user()->favoritos()->where('productos.id', $producto->id)->exists()
            : false;

        $resenas = Resena::with('usuario')
            ->where('producto_id', $producto->id)
            ->latest()
            ->paginate(5, ['*'], 'resenas_page');

        $promedioResenas = round($resenas->total() ? Resena::where('producto_id', $producto->id)->avg('calificacion') : 0, 1);

        return view('consultas', compact('producto', 'esFavorito', 'resenas', 'promedioResenas'));
    }
}

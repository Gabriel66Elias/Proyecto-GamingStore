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
            ->where('stock', '>', 0) 
            ->get()
            ->groupBy(fn($p) => $p->categoria?->nombre ?? 'Sin categoría');

        $favoritoIds = Auth::check()
            ? Auth::user()->favoritos()->pluck('productos.id')->toArray()
            : [];

        // ACTUALIZADO: Apunta a la carpeta tienda/
        return view('tienda.catalogo', compact('productosAgrupados', 'categorias', 'favoritoIds'));
    }
    
    public function show(int $id)
    {
        $producto = Producto::with('categoria')->findOrFail($id);
    
        $esFavorito = Auth::check()
            ? Auth::user()->favoritos()->where('productos.id', $producto->id)->exists()
            : false;

        $resenas = Resena::with('usuario')
            ->where('producto_id', $producto->id)
            ->latest()
            ->paginate(5, ['*'], 'resenas_page');
        /** @noinspection PhpParamsInspection */    
        $promedioResenas = round($resenas->total() ? Resena::where('producto_id', $producto->id)->avg('calificacion') : 0, 1);

        // INTACTO: Se mantiene en la raíz según rúbrica
        return view('paginas.consultas', compact('producto', 'esFavorito', 'resenas', 'promedioResenas'));
    }
}
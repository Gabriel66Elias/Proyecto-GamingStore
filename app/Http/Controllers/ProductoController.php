<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;

class ProductoController extends Controller
{
    public function index()
    {
        $categorias = Categoria::all();

        $productosAgrupados = Producto::with('categoria')
            ->get()
            ->groupBy(fn($p) => $p->categoria?->nombre ?? 'Sin categoría');

        return view('catalogo', compact('productosAgrupados', 'categorias'));
    }

    public function show($id)
    {
        $producto = Producto::with('categoria')->findOrFail($id);
        return view('consultas', compact('producto'));
    }
}

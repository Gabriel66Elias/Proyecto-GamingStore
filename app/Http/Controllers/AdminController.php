<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Consulta;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    private function soloAdmin()
    {
        if (!Auth::check() || Auth::user()->rol->nombre !== 'admin') {
            abort(403, 'Acceso denegado.');
        }
    }

    public function dashboard()
    {
        $this->soloAdmin();

        $stats = [
            'total_productos' => Producto::count(),
            'categorias'      => Categoria::count(),
            'stock_total'     => Producto::sum('stock'),
            'sin_stock'       => Producto::where('stock', 0)->count(),
        ];

        $ultimos = Producto::with('categoria')->latest()->limit(5)->get();

        return view('adminpanel.dashboard', compact('stats', 'ultimos'));
    }

    public function productos()
    {
        $this->soloAdmin();
        $productos = Producto::with('categoria')->orderBy('nombre')->paginate(15);
        return view('adminpanel.productos', compact('productos'));
    }

    public function create()
    {
        $this->soloAdmin();
        $categorias = Categoria::all();
        return view('adminpanel.productos-crear', compact('categorias'));
    }

    public function store(Request $request)
    {
        $this->soloAdmin();

        $data = $request->validate([
            'nombre'        => 'required|string|max:100|unique:productos,nombre',
            'categoria_id'  => 'required|exists:categorias,id',
            'descripcion'   => 'nullable|string',
            'precio_compra' => 'required|numeric|min:0',
            'precio_venta'  => 'required|numeric|min:0',
            'stock'         => 'required|integer|min:0',
            'imagen'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'specs'         => 'nullable|array',
            'specs.*'       => 'nullable|string|max:200',
        ]);

        $specs = array_values(array_filter($request->input('specs', []), fn($s) => trim($s) !== ''));
        $data['especificaciones'] = !empty($specs) ? $specs : null;

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('productos', 'public');
        }

        unset($data['specs']);

        Producto::create($data);

        return redirect()->route('admin.productos')->with('success', 'Producto creado correctamente.');
    }

    public function edit($id)
    {
        $this->soloAdmin();
        $producto   = Producto::findOrFail($id);
        $categorias = Categoria::all();
        return view('adminpanel.productos-editar', compact('producto', 'categorias'));
    }

    public function update(Request $request, $id)
    {
        $this->soloAdmin();

        $producto = Producto::findOrFail($id);

        $data = $request->validate([
            'nombre'        => "required|string|max:100|unique:productos,nombre,{$id}",
            'categoria_id'  => 'required|exists:categorias,id',
            'descripcion'   => 'nullable|string',
            'precio_compra' => 'required|numeric|min:0',
            'precio_venta'  => 'required|numeric|min:0',
            'stock'         => 'required|integer|min:0',
            'imagen'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'specs'         => 'nullable|array',
            'specs.*'       => 'nullable|string|max:200',
        ]);

        $specs = array_values(array_filter($request->input('specs', []), fn($s) => trim($s) !== ''));
        $data['especificaciones'] = !empty($specs) ? $specs : null;

        if ($request->hasFile('imagen')) {
            if ($producto->imagen) {
                Storage::disk('public')->delete($producto->imagen);
            }
            $data['imagen'] = $request->file('imagen')->store('productos', 'public');
        }

        unset($data['specs']);

        $producto->update($data);

        return redirect()->route('admin.productos')->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy($id)
    {
        $this->soloAdmin();

        $producto = Producto::findOrFail($id);
        $producto->delete();

        return redirect()->route('admin.productos')->with('success', 'Producto eliminado correctamente.');
    }

    public function stock()
    {
        $this->soloAdmin();
        $productos = Producto::with('categoria')->orderBy('stock')->get();
        return view('adminpanel.stock', compact('productos'));
    }

    public function consultas()
    {
        $this->soloAdmin();
        $consultas = Consulta::latest()->paginate(20);
        return view('adminpanel.consultas', compact('consultas'));
    }

    public function marcarLeida($id)
    {
        $this->soloAdmin();
        Consulta::findOrFail($id)->update(['leida' => true]);
        return response()->json(['ok' => true]);
    }

    public function destroyConsulta($id)
    {
        $this->soloAdmin();
        Consulta::findOrFail($id)->delete();
        return redirect()->route('admin.consultas')->with('success', 'Consulta eliminada correctamente.');
    }

    public function pedidos()
    {
        $this->soloAdmin();
        return view('adminpanel.pedidos');
    }
}

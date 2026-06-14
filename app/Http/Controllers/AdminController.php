<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Consulta;
use App\Models\Producto;
use App\Models\Resena;
use App\Models\VentaCabecera;
use App\Models\VentaDetalle;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function dashboard()
    {
        
        $stockChart = [
            'total' => Producto::count(),
            'segments' => [

                ['label' => 'Buen stock', 'value' => Producto::where('stock', '>', 5)->count(), 'color' => '#4ade80'],
    
                ['label' => 'Poco stock', 'value' => Producto::whereBetween('stock', [1, 5])->count(), 'color' => '#fbbf24'],
 
                ['label' => 'Sin stock',  'value' => Producto::where('stock', 0)->count(), 'color' => '#FF3B3B'],
            ],
        ];

        $detallesVendidos = VentaDetalle::whereHas('venta', fn ($q) => $q->whereNotIn('estado', ['carrito', 'cancelado']));

        $ingresos = (clone $detallesVendidos)->sum('subtotal');
        $costos   = (clone $detallesVendidos)
            ->join('productos', 'ventas_detalle.producto_id', '=', 'productos.id')
            ->sum(DB::raw('ventas_detalle.cantidad * productos.precio_compra'));
        $ganancia = $ingresos - $costos;

        $gananciaChart = [
            'ingresos' => $ingresos,
            'costos'   => $costos,
            'ganancia' => $ganancia,
            'segments' => [
                ['label' => 'Ganancia neta',      'value' => max($ganancia, 0), 'color' => '#4ade80'],
                ['label' => 'Costo de productos', 'value' => $costos, 'color' => '#64748b'],
            ],
        ];

        $ultimos = Producto::with('categoria')->latest()->limit(5)->get();

        $pedidosRecientes = VentaCabecera::with('usuario')
            ->whereNotIn('estado', ['carrito'])
            ->latest('fecha_venta')
            ->limit(5)
            ->get();

        return view('adminpanel.dashboard', compact('stockChart', 'gananciaChart', 'ultimos', 'pedidosRecientes'));
    }

    public function productos()
    {
        $productos = Producto::with('categoria')->orderBy('nombre')->paginate(15);
        return view('adminpanel.productos', compact('productos'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        return view('adminpanel.productos-crear', compact('categorias'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre'               => 'required|string|max:100|unique:productos,nombre',
            'categoria_id'         => 'required|exists:categorias,id',
            'descripcion'          => 'nullable|string',
            'precio_compra'        => 'required|numeric|min:0',
            'precio_venta'         => 'required|numeric|min:0',
            'descuento_porcentaje' => 'nullable|numeric|min:0|max:99',
            'stock'                => 'required|integer|min:0',
            'imagen'               => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'specs'                => 'nullable|array',
            'specs.*'              => 'nullable|string|max:200',
        ]);

        $specs = array_values(array_filter($request->input('specs', []), fn($s) => trim($s) !== ''));
        $data['especificaciones'] = !empty($specs) ? $specs : null;

        $data['descuento_porcentaje'] = $data['descuento_porcentaje'] ?? null;

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('productos', 'public');
        }

        unset($data['specs']);

        Producto::create($data);

        return redirect()->route('admin.productos')->with('success', 'Producto creado correctamente.');
    }

    public function edit($id)
    {
        $producto   = Producto::findOrFail($id);
        $categorias = Categoria::all();
        return view('adminpanel.productos-editar', compact('producto', 'categorias'));
    }

    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);

        $data = $request->validate([
            'nombre'               => "required|string|max:100|unique:productos,nombre,{$id}",
            'categoria_id'         => 'required|exists:categorias,id',
            'descripcion'          => 'nullable|string',
            'precio_compra'        => 'required|numeric|min:0',
            'precio_venta'         => 'required|numeric|min:0',
            'descuento_porcentaje' => 'nullable|numeric|min:0|max:99',
            'stock'                => 'required|integer|min:0',
            'imagen'               => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'specs'                => 'nullable|array',
            'specs.*'              => 'nullable|string|max:200',
        ]);

        $specs = array_values(array_filter($request->input('specs', []), fn($s) => trim($s) !== ''));
        $data['especificaciones'] = !empty($specs) ? $specs : null;

        $data['descuento_porcentaje'] = $data['descuento_porcentaje'] ?? null;

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
        $producto = Producto::findOrFail($id);
        $producto->delete();

        return redirect()->route('admin.productos')->with('success', 'Producto eliminado correctamente.');
    }

    public function stock()
    {
        $productos = Producto::with('categoria')->orderBy('stock')->get();
        return view('adminpanel.stock', compact('productos'));
    }

    public function consultas()
    {
        $consultas = Consulta::latest()->paginate(20);

        $resenas = Resena::with(['usuario', 'producto'])
            ->latest()
            ->paginate(20, ['*'], 'resenas_page');

        return view('adminpanel.consultas', compact('consultas', 'resenas'));
    }

    public function marcarLeida($id)
    {
        Consulta::findOrFail($id)->update(['leida' => true]);
        return response()->json(['ok' => true]);
    }

    public function destroyConsulta($id)
    {
        Consulta::findOrFail($id)->delete();
        return redirect()->route('admin.consultas')->with('success', 'Consulta eliminada correctamente.');
    }

    public function destroyResena($id)
    {
        Resena::findOrFail($id)->delete();
        return redirect()->route('admin.consultas')->with('success', 'Reseña eliminada correctamente.');
    }

    public function pedidos(Request $request)
    {
        // Iniciamos la consulta base excluyendo los carritos
        $query = VentaCabecera::with(['detalles.producto', 'usuario'])
            ->whereNotIn('estado', ['carrito']);

        // Filtro por Estado del pedido
        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        // Filtro por Tipo de Envío
        if ($request->filled('tipo_envio')) {
            $query->where('tipo_envio', $request->tipo_envio);
        }

        // Filtro por Método de Pago
        if ($request->filled('metodo_pago')) {
            $query->where('metodo_pago', $request->metodo_pago);
        }

        // Ejecutamos la consulta con paginación
        $pedidos = $query->latest('fecha_venta')->paginate(25)->withQueryString();

        $stats = [
            'total'      => VentaCabecera::whereNotIn('estado', ['carrito'])->count(),
            'pendiente'  => VentaCabecera::whereIn('estado', ['pendiente', 'confirmado'])->count(),
            'en_proceso' => VentaCabecera::where('estado', 'en_proceso')->count(),
            'enviado'    => VentaCabecera::whereIn('estado', ['enviado', 'en_camino'])->count(),
        ];

        return view('adminpanel.pedidos', compact('pedidos', 'stats'));
    }

    public function exportarPedidosPdf(Request $request)
    {
        $request->validate([
            'desde'  => 'nullable|date',
            'hasta'  => 'nullable|date',
            'estado' => 'nullable|string',
        ]);

        $query = VentaCabecera::with(['detalles', 'usuario'])
            ->whereNotIn('estado', ['carrito']);

        if ($request->filled('desde')) {
            $query->whereDate('fecha_venta', '>=', $request->desde);
        }
        if ($request->filled('hasta')) {
            $query->whereDate('fecha_venta', '<=', $request->hasta);
        }
        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        $pedidos = $query->orderBy('fecha_venta')->get();
        $total   = $pedidos->sum('total');

        $pdf = Pdf::loadView('adminpanel.pedidos-pdf', [
            'pedidos' => $pedidos,
            'total'   => $total,
            'desde'   => $request->desde,
            'hasta'   => $request->hasta,
            'estado'  => $request->estado,
        ])->setPaper('a4', 'portrait');

        return $pdf->download('registro-ventas-' . now()->format('Y-m-d_His') . '.pdf');
    }

    public function actualizarEstadoPedido(Request $request, $id)
    {
        $request->validate([
            'estado'             => 'required|in:pendiente,en_proceso,enviado,en_camino,entregado,completado,cancelado',
            'codigo_seguimiento' => 'nullable|string|max:60',
        ]);

        $pedido = VentaCabecera::findOrFail($id);

        if ($pedido->estado === 'carrito') {
            return response()->json(['error' => 'No se puede modificar un carrito activo'], 422);
        }

        // Si se cancela, restaurar stock
        if ($request->estado === 'cancelado' && $pedido->estado !== 'cancelado') {
            foreach ($pedido->detalles()->with('producto')->get() as $item) {
                if ($item->producto) {
                    $item->producto->increment('stock', $item->cantidad);
                }
            }
        }

        // Si se reactiva desde cancelado, volver a descontar stock
        if ($pedido->estado === 'cancelado' && $request->estado !== 'cancelado') {
            foreach ($pedido->detalles()->with('producto')->get() as $item) {
                if ($item->producto && $item->producto->stock >= $item->cantidad) {
                    $item->producto->decrement('stock', $item->cantidad);
                }
            }
        }

        $datosActualizar = ['estado' => $request->estado];

        if ($request->filled('codigo_seguimiento')) {
            $datosActualizar['codigo_seguimiento'] = $request->codigo_seguimiento;
        }

        $pedido->update($datosActualizar);

        return response()->json([
            'ok'                 => true,
            'estado'             => $request->estado,
            'label'              => VentaCabecera::estadoLabel($request->estado),
            'codigo_seguimiento' => $pedido->codigo_seguimiento,
        ]);
    }
}
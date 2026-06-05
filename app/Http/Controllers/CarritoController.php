<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VentaCabecera;
use App\Models\VentaDetalle;
use App\Models\Producto;

class CarritoController extends Controller
{
    // Helper privado: busca o crea el carrito activo del usuario autenticado
    private function obtenerCarrito(): VentaCabecera
    {
        return VentaCabecera::firstOrCreate(
            ['user_id' => auth()->id(), 'estado' => 'carrito'],
            ['total' => 0]
        );
    }

    // Helper privado: recalcula el total sumando subtotales de los detalles
    private function recalcularTotal(VentaCabecera $carrito): void
    {
        $carrito->update(['total' => $carrito->detalles()->sum('subtotal')]);
    }

    // GET /carrito/datos — sin middleware auth, devuelve JSON del carrito actual
    public function datos()
    {
        if (!auth()->check()) {
            return response()->json(['items' => [], 'total' => 0]);
        }

        $carrito = VentaCabecera::where('user_id', auth()->id())
            ->where('estado', 'carrito')
            ->with(['detalles.producto'])
            ->first();

        if (!$carrito) {
            return response()->json(['items' => [], 'total' => 0]);
        }

        $items = $carrito->detalles->map(function ($detalle) {
            return [
                'id'              => $detalle->id,
                'producto_id'     => $detalle->producto_id,
                'nombre'          => $detalle->producto->nombre,
                'precio_unitario' => (float) $detalle->precio_unitario,
                'cantidad'        => $detalle->cantidad,
                'subtotal'        => (float) $detalle->subtotal,
                'stock'           => $detalle->producto->stock,
                'imagen'          => $detalle->producto->imagen
                    ? asset('storage/' . $detalle->producto->imagen)
                    : asset('assets/placeholder-producto.svg'),
            ];
        });

        return response()->json([
            'items' => $items,
            'total' => (float) $carrito->total,
        ]);
    }

    // POST /carrito/agregar — requiere auth
    public function agregar(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cantidad'    => 'required|integer|min:1',
        ]);

        $producto = Producto::findOrFail($request->producto_id);

        if ($producto->stock < $request->cantidad) {
            return response()->json(['error' => 'No hay suficiente stock disponible'], 422);
        }

        $carrito = $this->obtenerCarrito();
        $item    = $carrito->detalles()->where('producto_id', $producto->id)->first();

        if ($item) {
            $nuevaCantidad = $item->cantidad + $request->cantidad;
            if ($nuevaCantidad > $producto->stock) {
                return response()->json([
                    'error' => "Stock insuficiente. Solo quedan {$producto->stock} unidades."
                ], 422);
            }
            $item->cantidad = $nuevaCantidad;
            $item->subtotal = $nuevaCantidad * $item->precio_unitario;
            $item->save();
        } else {
            $carrito->detalles()->create([
                'producto_id'     => $producto->id,
                'cantidad'        => $request->cantidad,
                'precio_unitario' => $producto->precio_venta,
                'subtotal'        => $producto->precio_venta * $request->cantidad,
            ]);
        }

        $this->recalcularTotal($carrito);
        return $this->datos();
    }

    // PATCH /carrito/{id} — actualiza cantidad de un ítem, requiere auth
    public function actualizar(Request $request, $id)
    {
        $request->validate(['cantidad' => 'required|integer|min:1']);

        $carrito = $this->obtenerCarrito();
        $item    = $carrito->detalles()->with('producto')->where('id', $id)->firstOrFail();

        if ($request->cantidad > $item->producto->stock) {
            return response()->json([
                'error' => "Stock insuficiente. Solo quedan {$item->producto->stock} unidades."
            ], 422);
        }

        $item->cantidad = $request->cantidad;
        $item->subtotal = $request->cantidad * $item->precio_unitario;
        $item->save();

        $this->recalcularTotal($carrito);
        return $this->datos();
    }

    // DELETE /carrito/{id} — elimina un ítem, requiere auth
    public function eliminar($id)
    {
        $carrito = $this->obtenerCarrito();
        $carrito->detalles()->where('id', $id)->delete();
        $this->recalcularTotal($carrito);
        return $this->datos();
    }

    // POST /carrito/vaciar — elimina todos los ítems, requiere auth
    public function vaciar()
    {
        $carrito = $this->obtenerCarrito();
        $carrito->detalles()->delete();
        $carrito->update(['total' => 0]);
        return $this->datos();
    }

    // POST /carrito/confirmar — confirma la compra, requiere auth
    public function confirmar()
    {
        $carrito = $this->obtenerCarrito();

        if ($carrito->detalles()->count() === 0) {
            return response()->json(['error' => 'Tu carrito está vacío'], 422);
        }

        $carrito->update([
            'estado'      => 'confirmado',
            'fecha_venta' => now(),
        ]);

        return response()->json(['redirect' => route('compra.confirmada')]);
    }
}

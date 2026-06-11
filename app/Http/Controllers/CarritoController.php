<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\VentaCabecera;
use App\Models\VentaDetalle;
use App\Models\Producto;

class CarritoController extends Controller
{
    // ─── HELPERS DB ──────────────────────────────────────────────────────────

    private function obtenerCarrito(): VentaCabecera
    {
        return VentaCabecera::firstOrCreate(
            ['user_id' => auth()->id(), 'estado' => 'carrito'],
            ['total' => 0]
        );
    }

    private function recalcularTotal(VentaCabecera $carrito): void
    {
        $carrito->update(['total' => $carrito->detalles()->sum('subtotal')]);
    }

    // ─── HELPERS SESIÓN (invitados) ───────────────────────────────────────────
    // Formato: session['carrito_guest'] = [ producto_id => ['cantidad' => N], ... ]

    private function getGuestCart(): array
    {
        return session('carrito_guest', []);
    }

    private function saveGuestCart(array $cart): void
    {
        session(['carrito_guest' => $cart]);
    }

    // ─── GET /carrito/datos ───────────────────────────────────────────────────

    public function datos()
    {
        return auth()->check() ? $this->datosAuth() : $this->datosGuest();
    }

    private function datosGuest()
    {
        $guestCart = $this->getGuestCart();
        if (empty($guestCart)) {
            return response()->json(['items' => [], 'total' => 0]);
        }

        $items = [];
        $total = 0;

        foreach ($guestCart as $productoId => $entry) {
            $producto = Producto::find($productoId);
            if (!$producto) continue;

            $subtotal = $producto->precio_final * $entry['cantidad'];
            $total   += $subtotal;

            $items[] = [
                'id'              => $productoId,
                'producto_id'     => $productoId,
                'nombre'          => $producto->nombre,
                'precio_unitario' => (float) $producto->precio_final,
                'cantidad'        => $entry['cantidad'],
                'subtotal'        => (float) $subtotal,
                'stock'           => $entry['cantidad'] + $producto->stock,
                'imagen'          => $producto->imagen
                    ? asset('storage/' . $producto->imagen)
                    : asset('assets/placeholder-producto.svg'),
            ];
        }

        return response()->json(['items' => $items, 'total' => (float) $total]);
    }

    private function datosAuth()
    {
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
                'stock'           => $detalle->cantidad + $detalle->producto->stock,
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

    // ─── POST /carrito/agregar ────────────────────────────────────────────────

    public function agregar(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cantidad'    => 'required|integer|min:1',
        ]);

        $producto = Producto::findOrFail($request->producto_id);

        return auth()->check()
            ? $this->agregarAuth($producto, (int) $request->cantidad)
            : $this->agregarGuest($producto, (int) $request->cantidad);
    }

    private function agregarGuest(Producto $producto, int $cantidad)
    {
        $guestCart  = $this->getGuestCart();
        $productoId = $producto->id;
        $existente  = $guestCart[$productoId]['cantidad'] ?? 0;
        $total      = $existente + $cantidad;

        if ($total > $producto->stock) {
            $disponible = max(0, $producto->stock - $existente);
            return response()->json([
                'error' => "Stock insuficiente. Solo podés agregar {$disponible} unidades más."
            ], 422);
        }

        $guestCart[$productoId] = ['cantidad' => $total];
        $this->saveGuestCart($guestCart);

        return $this->datos();
    }

    private function agregarAuth(Producto $producto, int $cantidad)
    {
        return DB::transaction(function () use ($producto, $cantidad) {
            $producto = Producto::whereKey($producto->id)->lockForUpdate()->first();

            if ($producto->stock < $cantidad) {
                return response()->json([
                    'error' => "Stock insuficiente. Solo quedan {$producto->stock} unidades disponibles."
                ], 422);
            }

            $carrito = $this->obtenerCarrito();
            $item    = $carrito->detalles()->where('producto_id', $producto->id)->first();

            if ($item) {
                $item->cantidad += $cantidad;
                $item->subtotal  = $item->cantidad * $item->precio_unitario;
                $item->save();
            } else {
                $carrito->detalles()->create([
                    'producto_id'     => $producto->id,
                    'cantidad'        => $cantidad,
                    'precio_unitario' => $producto->precio_final,
                    'subtotal'        => $producto->precio_final * $cantidad,
                ]);
            }

            $producto->decrement('stock', $cantidad);
            $this->recalcularTotal($carrito);

            return $this->datos();
        });
    }

    // ─── PATCH /carrito/{id} ─────────────────────────────────────────────────

    public function actualizar(Request $request, $id)
    {
        $request->validate(['cantidad' => 'required|integer|min:1']);

        return auth()->check()
            ? $this->actualizarAuth((int) $id, (int) $request->cantidad)
            : $this->actualizarGuest((int) $id, (int) $request->cantidad);
    }

    private function actualizarGuest(int $productoId, int $nuevaCantidad)
    {
        $guestCart = $this->getGuestCart();

        if (!isset($guestCart[$productoId])) {
            return response()->json(['error' => 'Item no encontrado'], 404);
        }

        $producto = Producto::find($productoId);
        if (!$producto) {
            return response()->json(['error' => 'Producto no encontrado'], 404);
        }

        if ($nuevaCantidad > $producto->stock) {
            return response()->json([
                'error' => "Stock insuficiente. Máximo disponible: {$producto->stock} unidades."
            ], 422);
        }

        $guestCart[$productoId] = ['cantidad' => $nuevaCantidad];
        $this->saveGuestCart($guestCart);

        return $this->datos();
    }

    private function actualizarAuth(int $id, int $nuevaCantidad)
    {
        return DB::transaction(function () use ($id, $nuevaCantidad) {
            $carrito  = $this->obtenerCarrito();
            $item     = $carrito->detalles()->where('id', $id)->firstOrFail();
            $producto = Producto::whereKey($item->producto_id)->lockForUpdate()->first();

            $diff = $nuevaCantidad - $item->cantidad;

            if ($diff > 0) {
                if ($diff > $producto->stock) {
                    $maxPosible = $item->cantidad + $producto->stock;
                    return response()->json([
                        'error' => "Stock insuficiente. Máximo posible: {$maxPosible} unidades."
                    ], 422);
                }
                $producto->decrement('stock', $diff);
            } elseif ($diff < 0) {
                $producto->increment('stock', abs($diff));
            }

            $item->cantidad = $nuevaCantidad;
            $item->subtotal = $nuevaCantidad * $item->precio_unitario;
            $item->save();

            $this->recalcularTotal($carrito);

            return $this->datos();
        });
    }

    // ─── DELETE /carrito/{id} ────────────────────────────────────────────────

    public function eliminar($id)
    {
        return auth()->check()
            ? $this->eliminarAuth((int) $id)
            : $this->eliminarGuest((int) $id);
    }

    private function eliminarGuest(int $productoId)
    {
        $guestCart = $this->getGuestCart();
        unset($guestCart[$productoId]);
        $this->saveGuestCart($guestCart);

        return $this->datos();
    }

    private function eliminarAuth(int $id)
    {
        return DB::transaction(function () use ($id) {
            $carrito = $this->obtenerCarrito();
            $item    = $carrito->detalles()->where('id', $id)->first();

            if ($item) {
                $producto = Producto::whereKey($item->producto_id)->lockForUpdate()->first();
                $producto?->increment('stock', $item->cantidad);
                $item->delete();
            }

            $this->recalcularTotal($carrito);

            return $this->datos();
        });
    }

    // ─── POST /carrito/vaciar ────────────────────────────────────────────────

    public function vaciar()
    {
        if (!auth()->check()) {
            $this->saveGuestCart([]);
            return $this->datos();
        }

        return DB::transaction(function () {
            $carrito = $this->obtenerCarrito();
            $items   = $carrito->detalles()->get();

            $productos = Producto::whereIn('id', $items->pluck('producto_id'))
                ->lockForUpdate()
                ->get()
                ->keyBy('id');

            foreach ($items as $item) {
                $productos->get($item->producto_id)?->increment('stock', $item->cantidad);
            }

            $carrito->detalles()->delete();
            $carrito->update(['total' => 0]);

            return $this->datos();
        });
    }

    // ─── POST /carrito/confirmar (requiere auth) ──────────────────────────────

    public function confirmar(Request $request)
    {
        $carrito = $this->obtenerCarrito();

        if ($carrito->detalles()->count() === 0) {
            return response()->json(['error' => 'Tu carrito está vacío'], 422);
        }

        $data = $request->validate([
            'nombre'        => 'required|string|max:50',
            'apellido'      => 'required|string|max:50',
            'email'         => 'required|email|max:100',
            'telefono'      => 'required|string|max:20',
            'tipo_envio'    => 'required|in:retiro,domicilio',
            'transporte'    => 'nullable|string|max:40',
            'provincia'     => 'nullable|string|max:60',
            'localidad'     => 'nullable|string|max:80',
            'calle'         => 'nullable|string|max:120',
            'codigo_postal' => 'nullable|string|max:10',
            'metodo_pago'   => 'required|in:tarjeta,transferencia',
            'costo_envio'   => 'required|numeric|min:0',
        ]);

        $numeroPedido = 'GS-' . date('Ymd') . '-' . str_pad($carrito->id, 5, '0', STR_PAD_LEFT);
        $totalFinal   = $carrito->total + $data['costo_envio'];

        $carrito->update([
            'estado'           => 'pendiente',
            'fecha_venta'      => now(),
            'numero_pedido'    => $numeroPedido,
            'total'            => $totalFinal,
            'nombre_cliente'   => $data['nombre'],
            'apellido_cliente' => $data['apellido'],
            'email_cliente'    => $data['email'],
            'telefono_cliente' => $data['telefono'],
            'tipo_envio'       => $data['tipo_envio'],
            'transporte'       => $data['transporte'] ?? null,
            'provincia'        => $data['provincia'] ?? null,
            'localidad'        => $data['localidad'] ?? null,
            'calle'            => $data['calle'] ?? null,
            'codigo_postal'    => $data['codigo_postal'] ?? null,
            'metodo_pago'      => $data['metodo_pago'],
            'costo_envio'      => $data['costo_envio'],
        ]);

        return response()->json([
            'redirect'      => route('compra.confirmada'),
            'numero_pedido' => $numeroPedido,
        ]);
    }

    // ─── FUSIONAR CARRITO INVITADO → DB ──────────────────────────────────────

    public static function fusionarCarritoGuest(): void
    {
        $guestCart = session('carrito_guest', []);
        if (empty($guestCart)) return;

        DB::transaction(function () use ($guestCart) {
            $carrito = VentaCabecera::firstOrCreate(
                ['user_id' => auth()->id(), 'estado' => 'carrito'],
                ['total' => 0]
            );

            foreach ($guestCart as $productoId => $entry) {
                $producto = Producto::whereKey($productoId)->lockForUpdate()->first();
                if (!$producto) continue;

                $cantidad = min($entry['cantidad'], $producto->stock);
                if ($cantidad <= 0) continue;

                $item = $carrito->detalles()->where('producto_id', $productoId)->first();

                if ($item) {
                    $adicional = min($cantidad, $producto->stock);
                    if ($adicional > 0) {
                        $item->cantidad += $adicional;
                        $item->subtotal  = $item->cantidad * $item->precio_unitario;
                        $item->save();
                        $producto->decrement('stock', $adicional);
                    }
                } else {
                    $carrito->detalles()->create([
                        'producto_id'     => $productoId,
                        'cantidad'        => $cantidad,
                        'precio_unitario' => $producto->precio_final,
                        'subtotal'        => $producto->precio_final * $cantidad,
                    ]);
                    $producto->decrement('stock', $cantidad);
                }
            }

            $carrito->update(['total' => $carrito->detalles()->sum('subtotal')]);
        });

        session()->forget('carrito_guest');
    }
}

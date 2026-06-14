<?php

namespace App\Http\Controllers;

use App\Models\Resena;
use App\Models\VentaCabecera;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResenaController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'venta_id'     => 'required|exists:venta_cabecera,id',
            'producto_id'  => 'required|exists:productos,id',
            'calificacion' => 'required|integer|min:1|max:5',
            'comentario'   => 'nullable|string|max:1000',
        ]);
        /** @noinspection PhpParamsInspection */
        $venta = VentaCabecera::findOrFail($data['venta_id']);

        abort_unless(
            $venta->detalles()->where('producto_id', $data['producto_id'])->exists(),
            403
        );

        Resena::updateOrCreate(
            ['venta_id' => $venta->id, 'producto_id' => $data['producto_id']],
            [
                'usuario_id'   => Auth::id(),
                'calificacion' => $data['calificacion'],
                'comentario'   => $data['comentario'],
            ]
        );

        return back()->with('success', '¡Gracias por tu reseña!');
    }
}

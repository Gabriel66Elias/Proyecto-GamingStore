<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VentaCabecera extends Model
{
    protected $table = 'venta_cabecera';

    protected $fillable = [
        'user_id', 'estado', 'total', 'fecha_venta',
        'numero_pedido',
        // Facturación
        'nombre_cliente', 'apellido_cliente', 'email_cliente', 'telefono_cliente',
        // Envío
        'tipo_envio', 'transporte', 'provincia', 'localidad', 'calle', 'codigo_postal', 'costo_envio',
        'codigo_seguimiento',
        // Pago
        'metodo_pago',
    ];

    protected $casts = [
        'fecha_venta' => 'datetime',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'user_id');
    }

    public function detalles()
    {
        return $this->hasMany(VentaDetalle::class, 'venta_id');
    }

    // Labels legibles para el estado
    public static function estadoLabel(string $estado): string
    {
        return match($estado) {
            'pendiente'   => 'Pendiente',
            'en_proceso'  => 'En proceso',
            'enviado'     => 'Enviado',
            'en_camino'   => 'En camino',
            'entregado'   => 'Entregado',
            'completado'  => 'Completado',
            'cancelado'   => 'Cancelado',
            'confirmado'  => 'Confirmado',
            default       => ucfirst($estado),
        };
    }

    // Clase CSS para el badge del estado
    public static function estadoBadgeClass(string $estado): string
    {
        return match($estado) {
            'pendiente'   => 'badge-pendiente',
            'en_proceso'  => 'badge-en-proceso',
            'enviado'     => 'badge-enviado',
            'en_camino'   => 'badge-en-camino',
            'entregado'   => 'badge-entregado',
            'completado'  => 'badge-completado',
            'cancelado'   => 'badge-cancelado',
            'confirmado'  => 'badge-pendiente',
            default       => 'badge-secondary',
        };
    }
}

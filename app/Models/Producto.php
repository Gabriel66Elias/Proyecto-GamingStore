<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{
    use SoftDeletes;

    protected $table = 'productos';

    protected $fillable = [
        'nombre', 'categoria_id', 'descripcion', 'especificaciones',
        'precio_compra', 'precio_venta', 'descuento_porcentaje', 'stock', 'imagen',
    ];

    protected $casts = [
        'especificaciones'     => 'array',
        'precio_compra'        => 'decimal:2',
        'precio_venta'         => 'decimal:2',
        'descuento_porcentaje' => 'decimal:2',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    public function tieneDescuento(): bool
    {
        return $this->descuento_porcentaje > 0;
    }

    protected function precioFinal(): \Illuminate\Database\Eloquent\Casts\Attribute
    {
        return \Illuminate\Database\Eloquent\Casts\Attribute::make(
            get: fn () => $this->tieneDescuento()
                ? round($this->precio_venta * (1 - $this->descuento_porcentaje / 100), 2)
                : (float) $this->precio_venta,
        );
    }
}

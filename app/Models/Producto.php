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
        'precio_compra', 'precio_venta', 'stock', 'imagen',
    ];

    protected $casts = [
        'especificaciones' => 'array',
        'precio_compra'    => 'decimal:2',
        'precio_venta'     => 'decimal:2',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }
}

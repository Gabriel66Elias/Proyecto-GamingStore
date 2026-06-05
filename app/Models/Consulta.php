<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    protected $table = 'consultas';

    protected $fillable = ['nombre', 'email', 'mensaje', 'leida'];

    protected $casts = [
        'leida' => 'boolean',
    ];
}

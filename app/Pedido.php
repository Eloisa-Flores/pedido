<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'home';
    protected $fillable = [
        'id',
        'pedido',
        'codigo',
        'descripcion',
        'fabrica',
        'nota',
        'fecha_pedido',
        'fecha_requerida',
        'empaque',
        'cantidad_original',
        'cantidad_recibida',
        'cantidad_pendiente',
        'dias',
    ]; //
}

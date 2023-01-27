<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
    protected $table = 'Ventas';
    protected $primaryKey='id_venta';
    protected $fillable=['id_cuenta','id_carta','cantidad','precio_v'];

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    protected $table = 'inventario';
    protected $primaryKey='id_inventario';
    protected $fillable=['producto','cantidad','minimo','medida'];
}

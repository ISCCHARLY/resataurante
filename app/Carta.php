<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carta extends Model
{
    
     protected $table = 'carta';
    protected $primaryKey='id_carta';
    protected $fillable=['nombre','precio_entrada','precio_publico','medida','estado','id_menu','cantidad','stock'];
}

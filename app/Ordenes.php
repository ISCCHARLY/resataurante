<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ordenes extends Model
{
    protected $table = 'ordenes';
    protected $primaryKey='idorden';
    protected $fillable=['idcarta','idcuenta','cantidad','estatus'];

}

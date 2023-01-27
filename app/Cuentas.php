<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuentas extends Model
{
    protected $table = 'Cuentas';
    protected $primaryKey='id_cuenta';
    protected $fillable=['id_mesero','id_mesa','estado','forma_pago','extra'];

}

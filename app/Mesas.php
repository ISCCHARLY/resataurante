<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mesas extends Model
{
     protected $table = 'mesas';
    protected $primaryKey='id_mesa';
    protected $fillable=['numero','estado'];

}

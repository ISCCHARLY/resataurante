<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meseros extends Model
{
    protected $table = 'meseros';
    protected $primaryKey='id_mesero';
    protected $fillable=['nombre','ap','am','telefono','estado','ip'];
}

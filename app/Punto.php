<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Punto extends Model
{
    protected $table='puntos';

    protected $primaryKeys='id';

    protected $fillable = [
    'nombre',
    'id',
    'condicion'
    ];

     public function scopeSearch($query,$name)
    {
        return $query->where('nombre','LIKE',"%$name%");
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    protected $table='servicios';

    protected $primaryKeys='id';

    protected $fillable = [
    'nombre',
    'numero',
    'tipo_dia',
    'turno',
    'toma',
    'deja',
    'estado',
    'user_id'
    ];

    public function scopeSearch($query,$name)
    {
        return $query->where('numero','LIKE',"%$name%");
    }
    //------------
}

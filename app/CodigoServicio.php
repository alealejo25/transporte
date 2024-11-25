<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CodigoServicio extends Model
{
    protected $table="codigoservicios";

    protected $primaryKeys='id';

    protected $fillable = [
    'id',
    'codigo',
    'nombre'
    ];

    
public function Servicio()
    {
        return $this->hasMany('App\Servicio');
    }
}

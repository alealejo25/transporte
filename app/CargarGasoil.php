<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CargarGasoil extends Model
{
    protected $table="cargargasoil";

    protected $primaryKeys='id';

    protected $fillable = [

        'litros',
        'interno',
        'coche_id',
        'gasoil_id'
    ];

public function Gasoil()
    {
        return $this->belongsTo('App\Gasoil');

    }
public function Coche()
    {
        return $this->belongsTo('App\Coche');
    }
}

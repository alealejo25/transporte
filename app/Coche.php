<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coche extends Model
{

    protected $table="coches";

    protected $primaryKeys='id';

    protected $fillable = [
    'id',
    'interno',
    'nroempresa',
    'patente',
    'activo',
    'fechavtv',
    'vencimientovtv',
    'año',
    'motor',
    'chasis',
    'nroasientos',
    'km',
    'ultimoservice',
    'fecha_ingreso',
    'fecha_egreso',
    'valor',
    'foto',
    'condicion',
    'carroceria_id',
    'modelo_id',
    'marca_id',
    'empresa_id'
    ];
    public function Carroceria()
    {
        return $this->belongsTo('App\Carroceria');
    }
     public function Modelo()
    {
        return $this->belongsTo('App\Modelo');
    }
     public function Marca()
    {
        return $this->belongsTo('App\Marca');
    }
     public function Empresa()
    {
        return $this->belongsTo('App\Empresa');
    }
     public function CocheBoleto()
    {
        return $this->hasMany('App\CocheBoleto');
    }
     public function CargarGasoil()
    {
        return $this->hasMany('App\CargarGasoil');
    }
    public function Servicio()
    {
        return $this->hasMany('App\Servicio');
    }
      
    public function scopeSearch($query,$name)
    {
        return $query->where('interno','LIKE',"%$name%");
    }
}

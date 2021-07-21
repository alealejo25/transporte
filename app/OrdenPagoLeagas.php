<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdenPagoLeagas extends Model
{
    protected $table='ordendepagosleagas';

    protected $primaryKeys='id';

    protected $fillable = [
    'numero',
    'montofinal',
    'fecha',
    'tipo',
    'estado',
    'proveedor_id',
    'chofer_id',
    'empresa_id'

    ];

    public function Proveedor()
    {
        return $this->belongsTo('App\Proveedor');
    }
    public function Empresa()
    {
        return $this->belongsTo('App\Empresa');
    }
    public function Chofer()
    {
        return $this->belongsTo('App\Chofer');
    }
    public function MovimientoOPC()
    {
        return $this->hasMany('App\MovimientoOPC');
    }

    public function MovimientoOPP()
    {
        return $this->hasMany('App\MovimientoOPP');
    }
}

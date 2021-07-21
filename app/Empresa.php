<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $table='empresas';

    protected $primaryKeys='id';

    protected $fillable = [
    'denominacion',
    'cuit',
    'condicion'
    ];


public function ComprasVarias()
    {
        return $this->hasMany('App\ComprasVarias');
    }
    public function MovimientoOPP()
    {
        return $this->hasMany('App\MovimientoOPP');
    }
    
public function CtaCteP()
    {
        return $this->hasMany('App\CtaCteP');
    }
public function CtaCtePLeagas()
    {
        return $this->hasMany('App\CtaCtePLeagas');
    }
    public function OrdenPago()
    {
        return $this->hasMany('App\OrdenPago');
    }
    public function OrdenPagoLeagas()
    {
        return $this->hasMany('App\OrdenPagoLeagas');
    }
}

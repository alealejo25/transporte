<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CtaCtePLeagas extends Model
{
    protected $table="ctasctespleagas";

    protected $primaryKeys='id';

    protected $fillable = [
        'tipocomprobante',
        'nrocomprobante',
        'fechaemision',
        'fechavencimiento',
        'debe',
        'haber',
        'acumulado',
        'observacion',
        'estado',
        'proveedor_id',
        'empresa_id',
        'factura_id'

    ];
    public function Proveedor()
    {
        return $this->belongsTo('App\Proveedor');
    }
    public function Empresa()
    {
        return $this->belongsTo('App\Empresa');
    }
}

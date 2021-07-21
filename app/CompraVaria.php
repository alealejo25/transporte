<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompraVaria extends Model
{
    protected $table="comprasvarias";

    protected $primaryKeys='id';

    protected $fillable = [
    'id',
    'nrocomprobante',
    'tipocomprobante',
    'fecha',
    'importe',
    'observacion',
    'estado',
    'user_id',
    'empresa_id',
    'proveedor_id',
    'opcomprasvarias_id'
    ];

    public function User()
    {
        return $this->belongsTo('App\User');
    }
    public function Empresa()
    {
        return $this->belongsTo('App\Empresa');
    }
    public function Proveedor()
    {
        return $this->belongsTo('App\Proveedor');
    }
    public function OpComprasVarias()
    {
        return $this->belongsTo('App\OpComprasVarias');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MovimientoOPP extends Model
{
protected $table='movimientosopp';

    protected $primaryKeys='id';

    protected $fillable = [
    'importe',
    'forma',
    'nroinstrumento',
    'estado',
    'ordendepago_id',
    'empresa_id'
	];

	public function OrdenPago()
    {
        return $this->belongsTo('App\OrdenPago');
    }
    public function Empresa()
    {
        return $this->belongsTo('App\Empresa');
    }
}

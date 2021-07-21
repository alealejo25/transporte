<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PagoMetropolitana extends Model
{
    protected $table="pagometropolitana";

    protected $primaryKeys='id';

    protected $fillable = [
    'nrocomprobante',
    'fechainicio',
    'fechafin',
    'importe',
    'servmetro',
    'fondo',
    'iibb',
    'totaldeducciones',
    'netoapagar',
    'observacion',
    'estado',
    'caja_id',
    'user_id'
    ];

    public function Caja()
    {
        return $this->belongsTo('App\Caja');
    }
    public function User()
    {
        return $this->belongsTo('App\User');
    }
}

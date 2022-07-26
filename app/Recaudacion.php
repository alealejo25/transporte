<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recaudacion extends Model
{
        protected $table="recaudaciones";

    protected $primaryKeys='id';

    protected $fillable = [
    'id',
    'desde',
    'hasta',
    'fecha',
    'abono',
    'posnet',
    'egresos',
    'totalingresos',
    'montoneto',
    'diez',
    'veinte',
    'cincuenta',
    'cien',
    'doscientos',
    'quinientos',
    'mil',
    'fisico',
    'observacion',
    'condicion',
    'user_id'

    ];

     public function User()
    {
        return $this->belongsTo('App\User');
    }
    public function CierreDiaTafi()
    {
        return $this->hasMany('App\CierreDiaTafi');
    }
}

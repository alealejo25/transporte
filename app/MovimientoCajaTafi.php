<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MovimientoCajaTafi extends Model
{
   protected $table="movimientoscajatafi";

    protected $primaryKeys='id';

    protected $fillable = [
    'tipo',
    'tipo_movimiento',
    'descripcion',
    'fecha',
    'importe',
    'importe_final',
    'cierre',
    'cierre_dia_tafi_id',
    'user_id',
    'condicion'
    ];

    public function CierreDiaTafi()
    {
        return $this->belongsTo('App\CierreDiaTafi');
    }
        public function User()
    {
        return $this->belongsTo('App\User');
    }
}

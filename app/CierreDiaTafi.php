<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CierreDiaTafi extends Model
{
    protected $table="cierresdiatafi";

    protected $primaryKeys='id';

    protected $fillable = [
    'id',
    'fecha',
    'caja_inicial',
    'venta',
    'gastos',
    'nrolote',
    'montolote',
    'caja_final',
    'caja_final_fisica',
    'caja_diferencia',
    'planchas_impresas',
    'planchas_dañada',
    'ganacialnf',
    'ganaciaelrayo',
    'gananciatotallnf',
    'observacion',
    'condicion',
    'user_id',
    'diez',
    'veinte',
    'cicuenta',
    'cien',
    'doscientos',
    'quinientos',
    'mil'

    ];

     public function User()
    {
        return $this->belongsTo('App\User');
    }
    public function MovimentoCajaTafi()
    {
        return $this->hasMany('App\MovimentoCajaTafi');
    }
}

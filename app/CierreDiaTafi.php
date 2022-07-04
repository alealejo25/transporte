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
    'caja_final',
    'caja_diferencia',
    'planchas_impresas',
    'planchas_dañada',
    'ganacialnf',
    'ganaciaelrayo',
    'caja_diferencia',
    'observacion',
    'condicion',
    'user_id'

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

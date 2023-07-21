<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gasoil extends Model
{
    protected $table="gasoil";

    protected $primaryKeys='id';

    protected $fillable = [
        'fecha',
        'numero',
        't1apertura',
        't1cierre',
        't1diferencia',
        't1nivel',
        't1consumo',
        't1saldo',
        't1ingreso',
        't2apertura',
        't2cierre',
        't2diferencia',
        't2nivel',
        't2consumo',
        't2saldo',
        't2ingreso',
        'l10total',
        'l110total',
        'l142total',
        'l118total',
        'l121total',
        'l122total',
        'l131total',
        'responsable',
        'empresa_id',
        'user_id',
        ];

    public function CargarGasoil()
    {
        return $this->hasMany('App\CargarGasoil');
    }
    public function Empresa()
    {
        return $this->belongsTo('App\Empresa');
    }
     public function User()
    {
        return $this->belongsTo('App\User');
    }
}

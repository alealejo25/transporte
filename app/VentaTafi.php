<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VentaTafi extends Model
{
    protected $table="ventastafi";

    protected $primaryKeys='id';

    protected $fillable = [
    'id',
    'fecha',
    'cantidad',
    'numero',
    'impresion',
    'montototal',
    'anulado',
    'boleto',
    'desde',
    'hasta',
    'user_id',
    'abonado_id'

    ];
    public function Abonado()
    {
        return $this->belongsTo('App\Abonado');
    }
    public function User()
    {
        return $this->belongsTo('App\User');
    }
}

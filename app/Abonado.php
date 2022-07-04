<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Abonado extends Model
{
    protected $table="abonados";

    protected $primaryKeys='id';

    protected $fillable = [
    'nombre',
    'apellido',
    'dni',
    'direccion',
    'nrocelular',
    'colegio_empresa',
    'turno',
    'desde',
    'hasta',
    'codigo',
    'tipo_abono_id',
    'estado',
    'boleto'
    ];
    public function TipoAbono()
    {
        return $this->belongsTo('App\TipoAbono');
    }
    public function VentaTafi()
    {
        return $this->hasMany('App\VentaTafi');
    }

     public function scopeSearch($query,$name)
    {
        return $query->where('dni','LIKE',"%$name%");
    }
    
}

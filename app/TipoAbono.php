<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoAbono extends Model
{
    protected $table='tiposabonos';

    protected $primaryKeys='id';

    protected $fillable = [
    'tipo',
    'cantidad',
    'costo101',
    'costo100',
    'costo103'
    ];

    public function Abonado()
    {
        return $this->hasMany('App\Abonado');
    }

    public function scopeSearch($query,$name)
    {
        return $query->where('tipo','LIKE',"%$name%");
    }
}

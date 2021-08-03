<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Boleteria122 extends Model
{
    protected $table='boleteria122';

    protected $primaryKeys='id';

    protected $fillable = [
        'puntodeventa',
        'responsable',
        'observacion',
        'fecha',
        'total',
        'estado'
    ];

    public function Boleteria122Detalle()
    {
        return $this->hasMany('App\Boleteria122Detalle');
    }

    public function scopeSearch($query,$name)
    {
        return $query->where('dominio','LIKE',"%$name%");
    }
    //------------
}

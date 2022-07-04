<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chofer extends Model
{
    protected $table="choferes";

    protected $primaryKeys='id';

    protected $fillable = [
    'nombre',
    'apellido',
    'dni',
    'direccion',
    'fechanac',
    'nrocelular',
    'saldo',
	];

    public function scopeSearch($query,$name)
    {
        return $query->where('nombre','LIKE',"%$name%");
    }


    //------------

}




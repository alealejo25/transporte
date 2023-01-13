<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Turno extends Model
{
protected $table="turnos";

    protected $primaryKeys='id';

    protected $fillable = [
    'id',
    'nombre'
    ];
     public function BoletoLeagas()
    {
        return $this->hasMany('App\BoletoLeagas');
    }


}

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
   
     public function ServicioLeagasLnf()
    {
        return $this->hasMany('App\ServicioLeagasLnf');
    }


}

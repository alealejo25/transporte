<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ramal extends Model
{
    protected $table="ramales";

    protected $primaryKeys='id';

    protected $fillable = [
        'id',
        'nombre',
        'linea_id'
        
    ];
/*    public function ChoferLeagasLnf()
    {
        return $this->hasMany('App\ChoferLeagasLnf');
    }*/
    public function Lineas()
    {
        return $this->belongsTo('App\Lineas');
    }
     public function ServicioLeagasLnf()
    {
        return $this->hasMany('App\ServicioLeagasLnf');
    }
}

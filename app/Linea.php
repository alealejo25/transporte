<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Linea extends Model
{
    protected $table="lineas";

    protected $primaryKeys='id';

    protected $fillable = [
        'id',
        'numero',
        'precioboleto',
        'empresa_id'
    ];
/*    public function ChoferLeagasLnf()
    {
        return $this->hasMany('App\ChoferLeagasLnf');
    }*/
    public function Empresa()
    {
        return $this->belongsTo('App\Empresa');
    }
    public function Ramal()
    {
        return $this->hasMany('App\Ramal');
    }
        public function BoletoLeagas()
    {
        return $this->hasMany('App\BoletoLeagas');
    }
     public function ServicioLeagasLnf()
    {
        return $this->hasMany('App\ServicioLeagasLnf');
    }

    public function scopeSearch($query,$name)
    {
        return $query->where('numero','LIKE',"%$name%");
    }
}

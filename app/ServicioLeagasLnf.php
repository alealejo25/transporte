<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServicioLeagasLnf extends Model
{
    protected $table="serviciosleagaslnf";

    protected $primaryKeys='id';

    protected $fillable = [
        'id',
        'numero',
        'empresa_id',
        'ramal_id',
        'turno_id',
        'linea_id',
        'kmsemana',
        'kmsabado',
        'kmdomingo'
    ];
/*    public function ChoferLeagasLnf()
    {
        return $this->hasMany('App\ChoferLeagasLnf');
    }*/
    public function Empresa()
    {
        return $this->belongsTo('App\Empresa');
    }
    public function Linea()
    {
        return $this->belongsTo('App\Linea');
    }
        public function Ramal()
    {
        return $this->belongsTo('App\Ramal');
    }
        public function Turno()
    {
        return $this->belongsTo('App\Turno');
    }
    public function BoletoLeagas()
    {
        return $this->hasMany('App\BoletoLeagas','id');
    }

    
    public function scopeSearch($query,$name)
    {
        return $query->where('numero','LIKE',"%$name%");
    }
}

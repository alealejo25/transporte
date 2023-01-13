<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BoletoLeagas extends Model
{
    protected $table="boletosleagas";

    protected $primaryKeys='id';

    protected $fillable = [
        'id',
        'fecha',
        'iniciotarjeta',
        'fintarjeta',
        'cantpasajes',
        'recaudacion',
        'horainicio',
        'horafin',
        'horastotal',
        'horassobrantes',
        'valorhorasrestantes',
        'gasoil',
        'toquesanden',
        'valortoquesanden',
        'observaciones',
        'condicion',
        'linea_id',
        'chofer_id',
        'servicio_id',
        'turno_id',
        'use_id',
        'coche_id'
    ];
/*    public function ChoferLeagasLnf()
    {
        return $this->hasMany('App\ChoferLeagasLnf');
    }*/
    public function Linea()
    {
        return $this->belongsTo('App\Linea');
    }
    public function ChoferLeagasLnf()
    {
        return $this->belongsTo('App\ChoferLeagasLnf','chofer_id');
    }
    public function ServicioLeagasLnf()
    {
        return $this->belongsTo('App\ServicioLeagasLnf','servicio_id');
    }
    public function Turno()
    {
        return $this->belongsTo('App\Turno');
    }
    public function Coche()
    {
        return $this->belongsTo('App\Coche');
    }
    public function User()
    {
        return $this->belongsTo('App\User');
    }
    
    public function scopeSearch($query,$name)
    {
        return $query->where('fecha','LIKE',"%$name%");
    }
}

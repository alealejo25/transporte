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
        'recaudaciontotal',
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
        'user_id',
        ];
    /*  return $this->hasMany('App\ChoferLeagasLnf');
    }*/
    public function CocheBoleto()
    {
        return $this->hasMany('App\CocheBoleto');
    }
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
    //    public function Coche()
    // {
    //     return $this->belongsTo('App\Coche');
    // }
    public function User()
    {
        return $this->belongsTo('App\User');
    }
    
    public function scopeSearch($query,$name)
    {
        return $query->where('fecha','LIKE',"%$name%");
    }
}

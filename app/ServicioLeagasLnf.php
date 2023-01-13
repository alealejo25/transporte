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
        'nombre',
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
    public function BoletoLeagas()
    {
        return $this->hasMany('App\BoletoLeagas','id');
    }
    
    public function scopeSearch($query,$name)
    {
        return $query->where('numero','LIKE',"%$name%");
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ObraSocial extends Model
{
    protected $table="obrasociales";

    protected $primaryKeys='id';

    protected $fillable = [
    'id',
    'codigo',
    'nombre'
    ];
    public function ChoferLeagasLnf()
    {
        return $this->hasMany('App\ChoferLeagasLnf');
    }
    public function scopeSearch($query,$name)
    {
        return $query->where('nombre','LIKE',"%$name%");
    }
}

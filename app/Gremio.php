<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gremio extends Model
{
    protected $table="gremios";

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

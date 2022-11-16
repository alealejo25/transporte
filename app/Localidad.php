<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Localidad extends Model
{
    protected $table="localidades";

    protected $primaryKeys='id';

    protected $fillable = [
    'id',
    'nombre',
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

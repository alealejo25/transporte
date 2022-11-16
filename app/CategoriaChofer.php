<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoriaChofer extends Model
{
    protected $table="categorias_cho";

    protected $primaryKeys='id';

    protected $fillable = [
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
    //------------
}

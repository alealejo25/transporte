<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    protected $table="marcas";

    protected $primaryKeys='id';

    protected $fillable = [
    'id',
    'nombre',
    ];
    public function Coche()
    {
        return $this->hasMany('App\Coche');
    }
    public function scopeSearch($query,$name)
    {
        return $query->where('nombre','LIKE',"%$name%");
    }
}

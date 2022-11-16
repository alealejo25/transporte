<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carroceria extends Model
{
    protected $table="carrocerias";

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

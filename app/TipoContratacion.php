<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoContratacion extends Model
{
    protected $table="tiposcontratacion";

    protected $primaryKeys='id';

    protected $fillable = [
    'id',
    'codigo',
    'nombre'
    ];
    
    public function ChoferLeagasLnf()
    {
        return $this->hasMany('App\ChoferLeagasLnf', 'foreign_key', 'tipocontratacion_id');
    }
    public function scopeSearch($query,$name)
    {
        return $query->where('nombre','LIKE',"%$name%");
    }
    //------------
}

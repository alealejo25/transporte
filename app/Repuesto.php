<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Repuesto extends Model
{
    protected $table="repuestos";

    protected $primaryKeys='id';

    protected $fillable = [
    'id',
    'codigo',
    'nombre',
    'cantidad',
    'marca',
    'condicion',
    ];



        public function MantenimientoC()
    {
        return $this->belongsToMany('App\mantenimientoc', 'MantenimientoCManodeObra','repuesto_id','mantenimientoc_id');
    }

    public function scopeSearch($query,$name)
    {
        return $query->where('nombre','LIKE',"%$name%");
    }
         public function MovimientoRemitoRepuesto()
    {
        return $this->hasMany('App\MovimientoRemitoRepuesto');
    }
    //------------
}

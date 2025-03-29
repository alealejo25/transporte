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
    'cantidad_lnf',
    'cantidad_leagas',
    'cantidad_malebo',
    'marca_id',
    
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


    public function marca()
    {
        return $this->belongsTo(MarcaRepuesto::class, 'marca_id');
    }

    public function movimientos()
    {
        return $this->hasMany(MovimientoRepuesto::class, 'repuesto_id');
    }
     // Relación: Un repuesto puede estar en muchos detalles de servicio
    public function detalles()
    {
        return $this->hasMany(ServiceDetalle::class, 'repuesto_id');
    }
    //------------
}

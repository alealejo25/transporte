<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RemitoRepuesto extends Model
{
    protected $table='remitorepuestos';

    protected $primaryKeys='id';

    protected $fillable = [
        'id',
        'fecha',
        'nro_remito',
    ];

     public function MovimientoRemitoRepuesto()
    {
        return $this->hasMany('App\MovimientoRemitoRepuesto');
    }
    

}

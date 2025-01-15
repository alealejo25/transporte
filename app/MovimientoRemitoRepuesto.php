<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MovimientoRemitoRepuesto extends Model
{
 protected $table="remitorepuestos";

    protected $primaryKeys='id';

    protected $fillable = [
    'id',
    'remitorepuestos_id',
    'repuestos_id',
    'cantidad',
    ];

    public function RemitoRepuesto()
    {
        return $this->belongsTo('App\RemitoRepuesto');
    }

        public function Repuesto()
    {
        return $this->belongsTo('App\Repuesto');
    }
 
}

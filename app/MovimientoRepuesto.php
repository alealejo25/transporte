<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MovimientoRepuesto extends Model
{
//use HasFactory;

    protected $table = 'movimientosrepuestos';

    protected $fillable = ['id','repuesto_id', 'cantidad', 'descripcion', 'comprobanterepuesto_id'];
        
    public function repuesto()
    {
        return $this->belongsTo(Repuesto::class, 'repuesto_id');
    }

    public function comprobante()
    {
        return $this->belongsTo(ComprobanteRepuesto::class, 'comprobanterepuesto_id');
    }
}

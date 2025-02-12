<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class ComprobanteRepuesto extends Model
{
//use HasFactory;

    protected $table = 'comprobanterepuestos';

    protected $fillable = [
        'id',
        'nrocomprobante',
        'tipocomprobante_id',
        'turnopañol_id',
        'fecharecepcion',
        'fechacomprobante',
        'proveedor_id',
        'estadocomprobante_id',
    ];

    public function tipoComprobante()
    {
        return $this->belongsTo(TipoComprobante::class, 'tipocomprobante_id');
    }

    public function turnoPanol()
    {
        return $this->belongsTo(TurnoPanol::class, 'turnopañol_id');
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'proveedor_id');
    }

    public function estadoComprobante()
    {
        return $this->belongsTo(EstadoComprobante::class, 'estadocomprobante_id');
    }

    public function movimientos()
    {
        return $this->hasMany(MovimientoRepuesto::class, 'comprobanterepuesto_id');
    }

    public function anulaciones()
    {
        return $this->hasOne(AnulacionComprobante::class, 'comprobanterepuesto_id');
    }
}

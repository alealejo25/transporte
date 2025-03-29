<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceDetalle extends Model
{
    //use HasFactory;

    protected $table = 'service_detalles';
    protected $fillable = ['service_id', 'repuesto_id', 'cantidad'];

    // Relación: Un detalle pertenece a un servicio
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    // Relación: Un detalle pertenece a un repuesto
    public function repuesto()
    {
        return $this->belongsTo(Repuesto::class, 'repuesto_id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceEstado extends Model
{
    //use HasFactory;

    protected $table = 'service_estados';
    protected $fillable = ['service_id', 'empleado_id', 'estado_anterior', 'estado_nuevo', 'fecha_cambio'];

    // Relación: Un estado pertenece a un servicio
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    // Relación: Un estado fue cambiado por un empleado
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    //use HasFactory;

    protected $table = 'services';
    protected $fillable = ['coche_id', 'empleado_id', 'fecha_service', 'estado', 'observaciones'];

    // Relación: Un servicio pertenece a un empleado
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id');
    }

    // Relación: Un servicio pertenece a un coche
    public function coche()
    {
        return $this->belongsTo(Coche::class, 'coche_id');
    }
    public function detalles()
    {
    return $this->hasMany(ServiceDetalle::class, 'service_id');
    }
}

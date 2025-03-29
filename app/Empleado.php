<?php
namespace App;


use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    //use HasFactory;

    protected $table = 'empleados';
    protected $fillable = ['nombre', 'apellido', 'dni', 'puesto'];

    // Relación: Un empleado puede tener muchos servicios asignados
    public function services()
    {
        return $this->hasMany(Service::class, 'empleado_id');
    }
}

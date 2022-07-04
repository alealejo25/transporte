<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmpresasBolTafi extends Model
{
    protected $table='empresasboltafi';

    protected $primaryKeys='id';

    protected $fillable = [
    'id',
    'nombre',
    'nombre_corto',
    'porcentaje'
    ];
}

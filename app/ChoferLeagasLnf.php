<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChoferLeagasLnf extends Model
{
    protected $table="choferesleagaslnf";

    protected $primaryKeys='id';

    protected $fillable = [
    'id',
    'legajo',
    'nombre',
    'apellido',
    'dni',
    'cuil',
    'direccion',
    'codpos',
    'localidad_id',
    'nrocelular',
    'nrofijo',
    'categoriachofer_id',
    'sexo',
    'estadocivil',
    'nacionalidad',
    'email',
    'fechanac',
    'fechaingreso',
    'activo',
    'fechaactivohasta',
    'gremio_id',
    'tipocontratacion_id',
    'obrasocial_id',
    'foto',
    'condicion'
    ];
    public function Localidad()
    {
        return $this->belongsTo('App\Localidad');
    }
     public function CategoriaChofer()
    {
        return $this->belongsTo('App\CategoriaChofer','categoriachofer_id');
    }
     public function TipoContratacion()
    {
        return $this->belongsTo('App\TipoContratacion','tipocontratacion_id');
    }
     public function ObraSocial()
    {
        return $this->belongsTo('App\ObraSocial','obrasocial_id');
    }
      public function Empresa()
    {
        return $this->belongsTo('App\Empresa');
    }
      public function Gremio()
    {
        return $this->belongsTo('App\Gremio');
    }

    public function scopeSearch($query,$name)
    {
        return $query->where('nombre','LIKE',"%$name%");
    }
    //------------
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockBoleto extends Model
{
    protected $table="stockboletos";

    protected $primaryKeys='id';

    protected $fillable = [
        'id',
        'serie',
        'codigo',
        'fecha',
        'inicio',
        'fin',
        'actual',
        'posicion',
        'activo',
        'chofer_id',
        'servicio_id'
    ];

  public function ChoferLeagasLnf()
    {
        return $this->belongsTo('App\ChoferLeagasLnf');
    }
public function Servicio()
    {
        return $this->belongsTo('App\Servicio');
    }
    
}

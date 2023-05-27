<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CocheBoleto extends Model
{
    protected $table="cochesboletos";

    protected $primaryKeys='id';

    protected $fillable = [
        'id',
        'iniciotarjeta',
        'fintarjeta',
        'cantpasajes',
        'recaudacion',
        'taller',
        'motivo_cambio',
        'gasoil',
        'condicion',
        'coche_id',
        'boletosleagas_id'
    ];
    public function BoletoLeagas()
    {
        return $this->belongsTo('App\BoletoLeagas');
    }
       public function Coche()
    {
        return $this->belongsTo('App\Coche');
    }

    
}

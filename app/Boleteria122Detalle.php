<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Boleteria122Detalle extends Model
{
    protected $table='boleteria122detalle';

    protected $primaryKeys='id';

    protected $fillable = [
        'dia',
        'totalarendirp',
        'abonodesdep',
        'abonohastap',
        'totalp',
        'totalarendiru',
        'abonodesdeu',
        'abonohastau',
        'totalu',
        'totalarendirm',
        'cierrelote',
        'totalm',
        'boleteria122_id',
        'estado'
    ];

    public function Boleteria122()
    {
        return $this->belongsTo('App\Boleteria');
    }

    public function scopeSearch($query,$name)
    {
        return $query->where('dominio','LIKE',"%$name%");
    }
    //------------
}

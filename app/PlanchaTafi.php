<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlanchaTafi extends Model
{
    protected $table='planchastafi';

    protected $primaryKeys='id';

    protected $fillable = [
    'id',
    'estado',
    'motivo',
    'color',
    'user_anulacion',
    'fechaanulacion',
    'fechacarga',
    'id_usuario',
    'numero',
    'usercompra_id'
    ];

    public function scopeSearch($query,$name)
    {
        return $query->where('numero','LIKE',"%$name%");
    }
    public function User()
    {
        return $this->belongsTo('App\User');
    }
    public function Abonado()
    {
        return $this->belongsTo('App\Abonado');
    }
    //------------
}

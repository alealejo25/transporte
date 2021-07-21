<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OpComprasVarias extends Model
{
    protected $table="opcomprasvarias";

    protected $primaryKeys='id';

    protected $fillable = [
    'nrocomprobante',
    'fechainicio',
    'fechacierre',
    'montolnf',
    'montol',
    'gastoslnf',
    'gastosl',
    'rendicionlnf',
    'rendicionl',
    'diferencialnf',
    'diferencial',
    'observacion',
    'estado',
    'user_id'
    ];

    public function User()
    {
        return $this->belongsTo('App\User');
    }
    public function ComprasVarias()
    {
        return $this->hasMany('App\ComprasVarias');
    }
}

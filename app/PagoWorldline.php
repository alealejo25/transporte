<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PagoWorldline extends Model
{
    protected $table="pagoworldline";

    protected $primaryKeys='id';

    protected $fillable = [
    'nrocomprobante',
    'fecha',
    'pasajenormal',
    'importenormal',
    'pasajeprim',
    'importeprim',
    'pasajesec',
    'importesec',
    'pasajeuniv',
    'importeuniv',
    'subtotal',

    'mh08',
    'mh09',
    'mh42',
    'mh44',
    'mh45',
    'mh47',
    'mh48',
    'mh49',
    'mh50',
    'mh51',
    'mh52',
    'u429',
    'u430',

    'u431',
    'u462',
    'subtotalretenciones',
    'netoapagar',
    'observacion',
    'estado',
    'caja_id',
    'user_id'

    ];

    public function Caja()
    {
        return $this->belongsTo('App\Caja');
    }
    public function User()
    {
        return $this->belongsTo('App\User');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrecioBoleto extends Model
{

    protected $table='precioboletos';

    protected $primaryKeys='id';

    protected $fillable = [
        'id',
        'fechainicio',
        'fechahasta',
        'abonos',
        'cod6',
        'cod7',
        'cod8',
        'cod10',
        'cod12',
        'cod14',
        'cod15',
        'cod18',
        'cod21',
        'cod23',
        'cod27',
        'cod30',
        'cod32',
        'estado'
    ];

}

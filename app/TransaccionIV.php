<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransaccionIV extends Model
{
    protected $table='transaccioniv';

    protected $primaryKeys='id';

    protected $fillable = [
    'fecha',
    'nroboleto',
    'cantidad_pasajes',
    'montounitario',
    'montototal',
    'destinosivterminal_id'
    ];

    public function VentaIVTerminal()
    {
        return $this->hasMany('App\VentaIVTerminal');
    }
    public function DestinoIVTerminal()
    {
        return $this->belongsTo('App\DestinoIVTerminal');
    }
    public function User()
    {
        return $this->belongsTo('App\User');
    }
    
}

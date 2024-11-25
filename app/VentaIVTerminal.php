<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VentaIVTerminal extends Model
{
    protected $table='ventasivterminal';

    protected $primaryKeys='id';

    protected $fillable = [
    'fecha',
    'nroboleto',
    'cantidad_pasajes',
    'montounitario',
    'montototal',
    'transaccioniv_id'
     ];

    public function TransaccionIV()
    {
        return $this->belongsTo('App\TransaccionIV');
    }
    
    public function scopeSearch($query,$name)
    {
        return $query->where('nroboleto','LIKE',"%$name%");
    }
    //------------
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DestinoIVTerminal extends Model
{
    protected $table="destinosivterminal";

    protected $primaryKeys='id';

    protected $fillable = [
    'nombre',
    'tarifa'
    ];
    public function TransaccionIV()
    {
        return $this->hasMany('App\TransaccionIV');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class AnulacionComprobante extends Model
{
//use HasFactory;

    protected $table = 'anulacioncomprobante';

    protected $fillable = ['id','comprobanterepuesto_id', 'motivo', 'fecha'];

    public function comprobante()
    {
        return $this->belongsTo(ComprobanteRepuesto::class, 'comprobanterepuesto_id');
    }
}

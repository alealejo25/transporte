<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoComprobante extends Model
{
use HasFactory;

    protected $table = 'estadocomprobantes';

    protected $fillable = ['nombre'];

    public function comprobantes()
    {
        return $this->hasMany(ComprobanteRepuesto::class, 'estadocomprobante_id');
    }
}

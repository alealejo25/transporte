<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TipoComprobante extends Model
{
    //use HasFactory;

    protected $table = 'tipocomprobantes';

    protected $fillable = ['id','nombre'];

    public function comprobantes()
    {
        return $this->hasMany(ComprobanteRepuesto::class, 'tipocomprobante_id');
    }
}

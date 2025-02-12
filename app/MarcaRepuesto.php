<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarcaRepuesto extends Model
{
   // use HasFactory;

    protected $table = 'marcarepuestos';

    protected $fillable = ['nombre'];

    public function repuestos()
    {
        return $this->hasMany(Repuesto::class, 'marca_id');
    }
}

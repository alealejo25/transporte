<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class TurnoPanol extends Model
{
    //use HasFactory;

    protected $table = 'turnopañol';

    protected $fillable = ['id','nombre'];

    public function comprobantes()
    {
        return $this->hasMany(ComprobanteRepuesto::class, 'turnopañol_id');
    }
}

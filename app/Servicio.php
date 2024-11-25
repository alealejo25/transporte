<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    protected $table='servicios';

    protected $primaryKeys='id';

    protected $fillable = [
    'id',
'fechaasignacion',
'fechaservicio',
'dia',
'observacion',
'estado',
'inicialcod6a',
'inicialcod6b',
'inicialcod7a',
'inicialcod7b',
'inicialcod8a',
'inicialcod8b',
'inicialcod10a',
'inicialcod10b',
'inicialcod12a',
'inicialcod12b',
'inicialcod14a',
'inicialcod14b',
'inicialcod15a',
'inicialcod15b',
'inicialcod18a',
'inicialcod18b',
'inicialcod21a',
'inicialcod21b',
'inicialcod23a',
'inicialcod23b',
'inicialcod27a',
'inicialcod27b',
'inicialcod30a',
'inicialcod30b',
'inicialcod32a',
'inicialcod32b',
'inicialabonoa',
'inicialabonob',
'fincod6a',
'fincod6b',
'fincod7a',
'fincod7b',
'fincod8a',
'fincod8b',
'fincod10a',
'fincod10b',
'fincod12a',
'fincod12b',
'fincod14a',
'fincod14b',
'fincod15a',
'fincod15b',
'fincod18a',
'fincod18b',
'fincod21a',
'fincod21b',
'fincod23a',
'fincod23b',
'fincod27a',
'fincod27b',
'fincod30a',
'fincod30b',
'fincod32a',
'fincod32b',
'finabonoa',
'finabonob',

'abonosa',
'cod6a',
'cod7a',
'cod8a',
'cod10a',
'cod12a',
'cod14a',
'cod15a',
'cod18a',
'cod21a',
'cod23a',
'cod27a',
'cod30a',
'cod32a',
'abonosb',
'cod6b',
'cod7b',
'cod8b',
'cod10b',
'cod12b',
'cod14b',
'cod15b',
'cod18b',
'cod21b',
'cod23b',
'cod27b',
'cod30b',
'cod32b',
'user_id',
'codservicio_id',
'coche_id',
'choferesleagaslnf_id'
    ];
    public function StockBoleto()
    {
        return $this->hasMany('App\StockBoleto');
    }
    
    public function CodigoServicio()
    {
        return $this->belongsTo('App\CodigoServicio');
    }
    public function Coche()
    {
        return $this->belongsTo('App\Coche');
    }
    public function ChoferLeagasLnf()
    {
        return $this->belongsTo('App\ChoferLeagasLnf');
    }
    //------------
}

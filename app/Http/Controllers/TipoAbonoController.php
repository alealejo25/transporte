<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Abonado;
use App\TipoAbono;
use App\Http\Requests\CategoriaFormRequest;

use Laracasts\Flash\Flash;

use DB;

use Barryvdh\DomPDF\Facade as PDF;


class TipoAbonoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        
        $datos=TipoAbono::search($request->name)->orderBy('tipo','ASC')->paginate(30);
        return view('abms.tiposdeabonos.index')
            ->with('datos',$datos);
    }
    public function create()
    {
        return view('abms.tiposdeabonos.create');
                
    }
    public function store(Request $request)
    {

        /*VALIDACION -----------------------------------------*/
        $campos=[
                'tipo'=>'required|string|max:35',
                'cantidad'=>'required|integer',
                'costo100'=>'required|integer',
                'costo101'=>'required|integer',
                'costo103'=>'required|integer',
                ];
                $Mensaje=["required"=>'El :attribute es requerido'];
                $this->validate($request,$campos,$Mensaje);   
        
        /*--------------------------------------------------------*/

        /* forma de grabar los datos en una variable */
        $datos=new TipoAbono(request()->except('_token'));
        $datos->save();
        /*-------------------------------------------------------*/
       /* otra forma de guardar los datos tambien funciona*/
       /*$datosAcoplado=request()->except('_token');*/
       /*Acoplado::insert($datosAcoplado);*/
       /*-----------------------------------------------------------*/
       //return response()->json($datosCamion);

       flash::success('Se a creado el TIPO DE ABONO'); 
       return Redirect('boltafi/tiposdeabonos/')->with('Mensaje','Tipos de Abonos Agregado con éxito');
    }
}

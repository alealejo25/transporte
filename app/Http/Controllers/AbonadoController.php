<?php
namespace App\Http\Controllers;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Abonado;
use App\TipoAbono;
use App\Http\Requests\CategoriaFormRequest;

use Laracasts\Flash\Flash;

use DB;

use Barryvdh\DomPDF\Facade as PDF;


class AbonadoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        
        $datos=Abonado::search($request->name)->orderBy('nombre','ASC')->paginate(30);

        //esto es para las relacion de la tabla datos con tipo de abono
        $datos->each(function($datos){
            $datos->tipoabono;
        });
        //----------------------------------------------------------
        //dd($datos);
        return view('abms.abonados.index')
            ->with('datos',$datos);

    }
    public function create()
    {
        $datos=TipoAbono::orderBy('tipo','ASC')->pluck('tipo','id');
    
        return view('abms.abonados.create')
                ->with('datos',$datos);
    }


    public function store(Request $request)
    {

        /*VALIDACION -----------------------------------------*/
        $campos=[
                'nombre'=>'required|string|max:25',
                'apellido'=>'required|string|max:25',
                'dni'=>'required|max:8|unique:abonados,dni',
                'direccion'=>'required|string|max:100',
                'nrocelular'=>'required|string|max:11',
                'colegio_empresa'=>'required|string|max:100',
                'turno'=>'required|string|max:7',
                'desde'=>'required|string|max:30',
                'hasta'=>'required|string|max:30',
                'tipo_abono_id'=>'required',
                'boleto'=>'required',
                ];
                $Mensaje=["required"=>'El :attribute es requerido',
                      "unique"=>'Ya existe el DNI para otro ABONADO'
                        ];
                $this->validate($request,$campos,$Mensaje);   
        
        /*--------------------------------------------------------*/


        $datos=new Abonado(request()->except('_token'));
        $datos->save();


       flash::success('Se a creado el ABONADO'); 
       return Redirect('boltafi/abonados')->with('Mensaje','Abonado Agregado con éxito');
    }
}

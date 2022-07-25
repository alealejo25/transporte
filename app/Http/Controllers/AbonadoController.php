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
        $datos->docpresentada='NO';
        $datos->save();


       flash::success('Se a creado el ABONADO'); 
       return Redirect('boltafi/abonados')->with('Mensaje','Abonado Agregado con éxito');
    }
    public function presentaciondoc(Request $request)
    {
        $datos=Abonado::orderBy('apellido','ASC')->get();
        $datos->each(function($datos){
            $datos->tipoabono;
        });
        return view('abms.abonados.documentacion')
            ->with('datos',$datos);

    }
    public function guardardocumentacion(Request $request)
    {
        $fecha=new \DateTime();
        $fechavencimiento=new \DateTime();
        date_add($fechavencimiento, date_interval_create_from_date_string("1 year"));


        /*VALIDACION -----------------------------------------*/
        $campos=[
                'abonado_id'=>'required',
                'documentacion'=>'required|string|max:75',
                
                ];
                $Mensaje=["required"=>'El :attribute es requerido'];
                $this->validate($request,$campos,$Mensaje);   
        
        /*--------------------------------------------------------*/
        $actualizarplancha=Abonado::where('id',$request->abonado_id)
                        ->update([
                                'documentacion'=>$request->documentacion,
                                'docpresentada'=>'SI',
                                'fechapresentacion'=>$fecha,
                                'fechavencimiento'=>$fechavencimiento
                                ]);

       flash::success('Se agrego la documentacion'); 
       return Redirect('boltafi/abonados/presentaciondoc')->with('Mensaje','Abonado Agregado con éxito');
    }

    public function edit($id)
    {



        $abonados=Abonado::find($id);

        $tiposdeabonos= TipoAbono::orderBy('id','DESC')->pluck('tipo','id');

        return view('abms.abonados.edit')
            ->with('abonados',$abonados)
            ->with('tiposdeabonos',$tiposdeabonos);
           
    }


    public function guardareditarabonado(Request $request)
    {
         /*VALIDACION -----------------------------------------*/
        $campos=[
                'nombre'=>'required|string|max:25',
                'apellido'=>'required|string|max:25',
                //'dni'=>'required|max:8|unique:abonados,dni',
                'direccion'=>'required|string|max:100',
                'nrocelular'=>'required|string|max:11',
                'colegio_empresa'=>'required|string|max:100',
                
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
        $datos=request()->except(['_token','_method']);
      

        Abonado::where('id','=',$request->id)->update($datos);
       flash::success('Se a Actualizado el ABONADO'); 
       return Redirect('boltafi/abonados')->with('Mensaje','Abonado Actualizado con éxito');
    }
}

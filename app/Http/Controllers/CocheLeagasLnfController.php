<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Coche;
use App\Carroceria;
use App\Empresa;
use App\Modelo;
use App\Marca;

use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Storage;

use DB;
use Dompdf\Dompdf;

class CocheLeagasLnfController extends Controller
{
    public function index(Request $request)
    {
        $coches=Coche::search($request->interno)->where('activo','1')->orderBy('interno','ASC')->paginate(30);

        //esto es para las relacion de la tabla acoplados con camion
        $coches->each(function($coches){
            $coches->carroceria;
            $coches->empresa;
            $coches->modelo;
            $coches->marca; 
            
           
       });

        return view('abms.coches.index')
            ->with('coches',$coches);
    }

          public function create()
    {
        $carrocerias=Carroceria::orderBy('nombre','ASC')->pluck('nombre','id');
        $empresas=Empresa::orderBy('denominacion','ASC')->pluck('denominacion','id');
        $modelos=Modelo::orderBy('nombre','ASC')->pluck('nombre','id');
        $marcas=Marca::orderBy('nombre','ASC')->pluck('nombre','id');
       
        return view('abms.coches.create')
               ->with('carrocerias',$carrocerias)
               ->with('empresas',$empresas)
               ->with('modelos',$modelos)
               ->with('marcas',$marcas);
    }
    public function store(Request $request)
    {   
                /*VALIDACION -----------------------------------------*/

     /*   $campos=[
            'interno'=>'required',
            'nroempresa'=>'required',
            'patente'=>'required|string|max:10',
            'año'=>'required',
            'motor'=>'required|string|max:30',
            'chasis'=>'required|string|max:30',
            'nroasientos'=>'required',
            'km'=>'required',
            'fecha_ingreso'=>'required',
            'valor'=>'required',
            'carroceria_id'=>'required',
            'modelo_id'=>'required',
            'marca_id'=>'required',
            'empresa_id'=>'required',
            'foto'=>'required|image|mimes:jpf,jpeg,png,gif,svg|max:2048',
            
        ];
        $Mensaje=["required"=>'El :attribute es requerido'];
        $this->validate($request,$campos,$Mensaje);

/*        $imagen=$request->file('foto');
        $nombre=time().'.'.$imagen->getClientOriginalExtension();
        $destino= public_path('img/uploads');
        $request->foto->move($destino,$nombre);
        $datos=new Coche(request()->except('_token'));
        $datos->foto=$nombre;
        $datos->activo=1;
        $datos->save();*/

        $imagen=$request->file('foto')->store('public/coches');
        //$imagen=$request->file('foto')->store('public/coches');
        $url=Storage::url($imagen);
        
        $datos=new Coche(request()->except('_token'));
        $datos->foto=$url;
        $datos->activo=1;
        $datos->save();        


        
        /*-------------------------------------------------------*/
       /* otra forma de guardar los datos tambien funciona*/
       /*$datosAcoplado=request()->except('_token');*/
       /*Acoplado::insert($datosAcoplado);*/
       /*-----------------------------------------------------------*/
       //return response()->json($datosCamion);

       flash::success('Se a creado el Coche'); 
       return Redirect('abms/cocheleagaslnf/')->with('Mensaje','Coche Agregado con éxito');
    }
    public function edit($id)
    {
        $coches=Coche::find($id);
        $carrocerias=Carroceria::orderBy('nombre','ASC')->pluck('nombre','id');
        $modelos=Modelo::orderBy('nombre','ASC')->pluck('nombre','id');
        $marcas=Marca::orderBy('nombre','ASC')->pluck('nombre','id');
        $empresas=Empresa::orderBy('denominacion','ASC')->pluck('denominacion','id');
      
         return view('abms.coches.edit')
                ->with('coches',$coches)
               ->with('carrocerias',$carrocerias)
               ->with('marcas',$marcas)
               ->with('empresas',$empresas)
               ->with('modelos',$modelos);
    }
     public function guardaredicioncoche(Request $request)
    {


        if($request->foto===null){
           $datos=request()->except(['_token','_method']);
          Coche::where('id','=',$request->id)->update($datos);
        }
        else
        {
           $imagen=$request->file('foto')->store('public/coches');
           $url=Storage::url($imagen);


           $datos=request()->except(['_token','_method']);
           Coche::where('id','=',$request->id)->update($datos);
           $actualizarcoche=Coche::where('id',$request->id)
                        ->update([
                                'foto'=>$url
                                 ]);
        }
        
        
        flash::success('Se a modificado el Coche'); 
        return Redirect('abms/cocheleagaslnf/');

    }
    public function informecoche($id)
    {

       $datos=Coche::where('id',$id)->get();

        //esto es para las relacion de la tabla acoplados con camion
        $datos->each(function($datos){
            $datos->carroceria;
            $datos->empresa;
            $datos->modelo;
            $datos->marca; 
        });
        $cadena=$datos[0]->foto;
        $foto = substr($cadena, 1);
        //dd($foto);
        $pdf=\PDF::loadView('abms.coches.reportecoche',['datos'=>$datos,'foto'=>$foto])
        ->setPaper('a4');
        return $pdf->download('reportecoche.pdf');
        
    }
}

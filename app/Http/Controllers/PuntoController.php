<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Punto;

use Laracasts\Flash\Flash;

class PuntoController extends Controller
{
        public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $datos=Punto::search($request->name)->orderBy('nombre','ASC')->paginate(30);

        //esto es para las relacion de la tabla acoplados con camion
    
        return view('abms.puntos.index')
            ->with('datos',$datos);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function create()
    {
        return view('abms.puntos.create');
               
    }

    public function store(Request $request)
    {
           
        /*VALIDACION -----------------------------------------*/
        $campos=[
            'nombre'=>'required|string|max:50',
           
        ];
        $Mensaje=["required"=>'El :attribute es requerido'];
        $this->validate($request,$campos,$Mensaje);

        /* forma de grabar los datos en una variable */
        $datos=new Punto(request()->except('_token'));
        $datos->save();
        /*-------------------------------------------------------*/
       /* otra forma de guardar los datos tambien funciona*/
       /*$datosAcoplado=request()->except('_token');*/
       /*Acoplado::insert($datosAcoplado);*/
       /*-----------------------------------------------------------*/
       //return response()->json($datosCamion);

       flash::success('Se a creado el Punto'); 
       return Redirect('abms/puntos/');
    }

     public function edit($id)
    {

        $datos=Punto::find($id);
        return view('abms.puntos.edit')
            ->with('datos',$datos);
    }

    public function update(Request $request, $id)
    {

            $campos=[
            'nombre'=>'required|string|max:50',
            
        ];
            $Mensaje=["required"=>'El :attribute es requerido'];
            $this->validate($request,$campos,$Mensaje);
 

        $datos=request()->except(['_token','_method']);
        Punto::where('id','=',$id)->update($datos);
        flash::success('Se a modificado el Punto'); 
        return Redirect('abms/puntos');
    }
}

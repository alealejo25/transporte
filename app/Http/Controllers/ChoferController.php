<?php

namespace App\Http\Controllers;

use App\Chofer;
use App\Camion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

use App\Http\Controllers\Controller;
use App\Http\Requests;


use App\Http\Requests\CategoriaFormRequest;

use Laracasts\Flash\Flash;

use DB;

class ChoferController extends Controller
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
        $choferes=Chofer::search($request->name)->orderBy('nombre','ASC')->get();

        //esto es para las relacion de la tabla acoplados con camion
        $choferes->each(function($choferes){
            $choferes->camion;
       });
        return view('abms.choferes.index')
            ->with('choferes',$choferes);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $localidades=Localidad::orderBy('dominio','ASC')->pluck('nombre','id');

        return view('abms.choferes.create')
               ->with('camiones',$camiones);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
                /*VALIDACION -----------------------------------------*/
        /*VALIDACION -----------------------------------------*/
        $campos=[
            'nombre'=>'required|string|max:60',
            'apellido'=>'required|string|max:60',
            'dni'=>'required|max:8',
            'direccion'=>'required|string|max:100',
            'fechanac'=>'required',
        ];
        $Mensaje=["required"=>'El :attribute es requerido'];
        $this->validate($request,$campos,$Mensaje);

        /* forma de grabar los datos en una variable */
        $datosChofer=new Chofer(request()->except('_token'));
        $datosChofer->save();
        /*-------------------------------------------------------*/
       /* otra forma de guardar los datos tambien funciona*/
       /*$datosAcoplado=request()->except('_token');*/
       /*Acoplado::insert($datosAcoplado);*/
       /*-----------------------------------------------------------*/
       //return response()->json($datosCamion);

       flash::success('Se a creado el Chofer'); 
       return Redirect('abms/choferes/')->with('Mensaje','Chofer Agregado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Chofer  $chofer
     * @return \Illuminate\Http\Response
     */
    public function show(Chofer $chofer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Chofer  $chofer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $choferes=Chofer::find($id);
        
        return view('abms.choferes.edit')
                ->with('choferes',$choferes);
    }




    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Chofer  $chofer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

            $campos=[
            'nombre'=>'required|string|max:60',
            'apellido'=>'required|string|max:60',
            'dni'=>'required|max:8',
            'direccion'=>'required|string|max:100',
            'fechanac'=>'required',
        ];
            $Mensaje=["required"=>'El :attribute es requerido'];
            $this->validate($request,$campos,$Mensaje);
 

        $datosChoferes=request()->except(['_token','_method']);
        Chofer::where('id','=',$id)->update($datosChoferes);
        flash::success('Se a modificado el Chofer'); 
        return Redirect('abms/choferes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Chofer  $chofer
     * @return \Illuminate\Http\Response
     */

    
    public function destroy($id)
    {
        Chofer::destroy($id);
        return Redirect('abms/choferes')->with('Mensaje','Chofer Eliminado con éxito!!!!!!');
    }
}

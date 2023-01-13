<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gremio;

class GremioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $datos=Gremio::search($request->name)->orderBy('nombre','ASC')->paginate(10);
        return view('abms.choferes.gremio.index')
        ->with('datos',$datos);

    }

     public function create()
    {
        return view('abms.choferes.gremio.create');
    }

     public function store(Request $request)
    {
        /*VALIDACION -----------------------------------------*/
        $campos=[
            'nombre'=>'required|string|max:50'
        ];
        $Mensaje=["required"=>'El :attribute es requerido'];
        $this->validate($request,$campos,$Mensaje);
       $datosGremio=request()->except('_token');
       Gremio::insert($datosGremio);
       
       return Redirect('abms/gremio')->with('Mensaje','Gremio Agregado con éxito');
    }

     public function update(Request $request, $id)
    {
        $datos=request()->except(['_token','_method']);
      

        Gremio::where('id','=',$id)->update($datos);
       return Redirect('abms/gremio')->with('Mensaje','Gremio Modificada con éxito!!!!!');
    }

    public function edit($id)
    {
        $datos=Gremio::find($id);
        return view('abms.choferes.gremio.edit')
            ->with('datos',$datos);
    }
     public function destroy($id)
        {
            Gremio::destroy($id);
            return Redirect('abms/gremio')->with('Mensaje','Gremio Eliminado con éxito!!!!!!');
        }


}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modelo;

class ModeloController extends Controller
{
    public function index(Request $request)
    {
        $datos=Modelo::search($request->name)->orderBy('nombre','ASC')->paginate(20);
        return view('abms.coches.modelo.index')
        ->with('datos',$datos);
    }
    public function create()
    {
        return view('abms.coches.modelo.create');
    }
     public function store(Request $request)
    {
        /*VALIDACION -----------------------------------------*/
        $campos=[
            'nombre'=>'required|string|max:50',
        ];
        $Mensaje=["required"=>'El :attribute es requerido'];
        $this->validate($request,$campos,$Mensaje);
       $datos=request()->except('_token');
       Modelo::insert($datos);
       
       return Redirect('abms/modelo')->with('Mensaje','Modelo agregada con éxito');
    }
     public function edit($id)
    {
        $datos=Modelo::find($id);
        return view('abms.coches.modelo.edit')
            ->with('datos',$datos);
    }
    public function update(Request $request, $id)
    {
        $datos=request()->except(['_token','_method']);
      

        Modelo::where('id','=',$id)->update($datos);
        return Redirect('abms/modelo')->with('Mensaje','Modelo Modificada con éxito!!!!!');
    }
}

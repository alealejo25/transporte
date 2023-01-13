<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Marca;

class MarcaController extends Controller
{
    public function index(Request $request)
    {
        $datos=Marca::search($request->name)->orderBy('nombre','ASC')->paginate(20);
        return view('abms.coches.marca.index')
        ->with('datos',$datos);
    }
    public function create()
    {
        return view('abms.coches.marca.create');
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
       Marca::insert($datos);
       
       return Redirect('abms/marca')->with('Mensaje','Marca agregada con éxito');
    }
     public function edit($id)
    {
        $datos=Marca::find($id);
        return view('abms.coches.marca.edit')
            ->with('datos',$datos);
    }
    public function update(Request $request, $id)
    {
        $datos=request()->except(['_token','_method']);
      

        Marca::where('id','=',$id)->update($datos);
        return Redirect('abms/marca')->with('Mensaje','Marca Modificada con éxito!!!!!');
    }
}

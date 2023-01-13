<?php

namespace App\Http\Controllers;
use App\Carroceria;

use Illuminate\Http\Request;

class CarroceriaController extends Controller
{
        public function index(Request $request)
    {
        $datos=Carroceria::search($request->name)->orderBy('nombre','ASC')->paginate(20);
        return view('abms.coches.carroceria.index')
        ->with('datos',$datos);
    }
    public function create()
    {
        return view('abms.coches.carroceria.create');
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
       Carroceria::insert($datos);
       
       return Redirect('abms/carroceria')->with('Mensaje','Carroceria agregada con éxito');
    }
     public function edit($id)
    {
        $datos=Carroceria::find($id);
        return view('abms.coches.carroceria.edit')
            ->with('datos',$datos);
    }
    public function update(Request $request, $id)
    {
        $datos=request()->except(['_token','_method']);
      

        Carroceria::where('id','=',$id)->update($datos);
        return Redirect('abms/carroceria')->with('Mensaje','Carroceria Modificada con éxito!!!!!');
    }
}

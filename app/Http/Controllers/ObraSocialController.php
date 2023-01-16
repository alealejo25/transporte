<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ObraSocial;

class ObraSocialController extends Controller
{
    public function index(Request $request)
    {
        $datos=ObraSocial::search($request->name)->orderBy('nombre','ASC')->paginate(20);
        return view('abms.choferes.obrasocial.index')
        ->with('datos',$datos);
    }
    public function create()
    {
        return view('abms.choferes.obrasocial.create');
    }
     public function store(Request $request)
    {
        /*VALIDACION -----------------------------------------*/
        $campos=[
            'nombre'=>'required|string|max:50',
            'codigo'=>'required|string|max:10',
        ];
        $Mensaje=["required"=>'El :attribute es requerido'];
        $this->validate($request,$campos,$Mensaje);
       $datos=request()->except('_token');
       ObraSocial::insert($datos);
       
       return Redirect('abms/obrasocial')->with('Mensaje','Obra Social agregada con éxito');
    }
     public function edit($id)
    {
        $datos=ObraSocial::find($id);
        return view('abms.choferes.obrasocial.edit')
            ->with('datos',$datos);
    }
    public function update(Request $request, $id)
    {
        $datos=request()->except(['_token','_method']);
      

        ObraSocial::where('id','=',$id)->update($datos);
        return Redirect('abms/obrasocial')->with('Mensaje','Obra Social Modificado con éxito!!!!!');
    }
}

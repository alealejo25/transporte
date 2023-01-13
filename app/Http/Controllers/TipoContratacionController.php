<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoContratacion;
class TipoContratacionController extends Controller
{
    public function index(Request $request)
    {
        $datos=TipoContratacion::search($request->name)->orderBy('nombre','ASC')->paginate(20);
        return view('abms.choferes.tipocontratacion.index')
        ->with('datos',$datos);
    }
    public function create()
    {
        return view('abms.choferes.tipocontratacion.create');
    }
     public function store(Request $request)
    {
        /*VALIDACION -----------------------------------------*/
        $campos=[
            'nombre'=>'required|string|max:50',
            'codigo'=>'required|string|max:4',
        ];
        $Mensaje=["required"=>'El :attribute es requerido'];
        $this->validate($request,$campos,$Mensaje);
       $datos=request()->except('_token');
       TipoContratacion::insert($datos);
       
       return Redirect('abms/tiposdecontratacion')->with('Mensaje','Tipo de Contratacion agregada con éxito');
    }
     public function edit($id)
    {
        $datos=TipoContratacion::find($id);
        return view('abms.choferes.tipocontratacion.edit')
            ->with('datos',$datos);
    }
    public function update(Request $request, $id)
    {
        $datos=request()->except(['_token','_method']);
      

        TipoContratacion::where('id','=',$id)->update($datos);
        return Redirect('abms/tiposdecontratacion')->with('Mensaje','Tipo de Contratacion Modificado con éxito!!!!!');
    }
}

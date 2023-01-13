<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CategoriaChofer;

class CategoriaController extends Controller
{

        public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $datos=CategoriaChofer::search($request->name)->orderBy('nombre','ASC')->paginate(10);
        return view('abms.choferes.categoria.index')
        ->with('datos',$datos);

    }

     public function create()
    {
        return view('abms.choferes.categoria.create');
    }

     public function store(Request $request)
    {
        /*VALIDACION -----------------------------------------*/
        $campos=[
            'nombre'=>'required|string|max:50'
        ];
        $Mensaje=["required"=>'El :attribute es requerido'];
        $this->validate($request,$campos,$Mensaje);
       $datosCategoria=request()->except('_token');
       CategoriaChofer::insert($datosCategoria);
       
       return Redirect('abms/categoria')->with('Mensaje','Categoria Agregada con éxito');
    }

     public function update(Request $request, $id)
    {
        $datosCategorias=request()->except(['_token','_method']);
      

        CategoriaChofer::where('id','=',$id)->update($datosCategorias);
       return Redirect('abms/categoria')->with('Mensaje','Categoria Modificada con éxito!!!!!');
    }

    public function edit($id)
    {
        $datos=CategoriaChofer::find($id);
        return view('abms.choferes.categoria.edit')
            ->with('datos',$datos);
    }
     public function destroy($id)
        {
            CategoriaChofer::destroy($id);
            return Redirect('abms/categoria')->with('Mensaje','Categoria Eliminada con éxito!!!!!!');
        }


}

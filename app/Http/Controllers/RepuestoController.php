<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repuesto;
use Laracasts\Flash\Flash;
use App\Empresa;
use App\MarcaRepuesto;

class RepuestoController extends Controller
{    public function __construct()
    {
        $this->middleware('auth');
    }
/*	public function index(Request $request)
    {
        $repuestos=Repuesto::search($request->name)->orderBy('nombre','ASC')->paginate(10);
        return view('abms.repuestos.index')
        ->with('repuestos',$repuestos);
    }*/
    public function listar()
    {
        return Repuesto::with('marca')->get();
    }
    //cargar marca para listar 
    public function cargarMarcas()
    {
        return MarcaRepuesto::all();
    }

    public function create()
    {
        return view('abms.repuestos.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
        'codigo' => 'required|unique:repuestos,codigo',
        'nombre' => 'required|string|max:255',
        'cantidad_lnf' => 'required|integer|min:0',
        'cantidad_leagas' => 'required|integer|min:0',
        'cantidad_malebo' => 'required|integer|min:0',
        'marca_id' => 'required|exists:marcarepuestos,id',
        'condicion' => 'required|boolean',
    ]);

    // Crea el repuesto
    Repuesto::create($validatedData);

    return response()->json(['success' => true, 'message' => 'Repuesto creado con éxito']);
    }
/*    public function store(Request $request)
    {


        $campos=[
            'codigo'=>'required|string',
            'nombre'=>'required|string|max:40',
            'cantidad'=>'required|integer',
            'marca'=>'required|string|max:40'
        ];
        $Mensaje=["required"=>'El :attribute es requerido'];
        $this->validate($request,$campos,$Mensaje);



        $datosRepuesto=new Repuesto(request()->except('_token'));
        $datosRepuesto->save();


       flash::success('se a creado el Repuesto'); 
       return Redirect('abms/repuestos/')->with('Mensaje','Repuesto Agregado con éxito');
    }
*/
    public function edit($id)
    {
        $repuestos=Repuesto::find($id);
        return view('abms.repuestos.edit')
            ->with('repuestos',$repuestos);
           
    }
     public function update(Request $request, $id)
    {
        $datosRepuesto=request()->except(['_token','_method']);
      

        Repuesto::where('id','=',$id)->update($datosRepuesto);
       // $camion=Camion::findOrFail($id);
       // return view('abms.camiones.edit',compact('camion'));
        return Redirect('abms/repuestos')->with('Mensaje','Repuesto Modificado con éxito!!!!!');
    }

     public function destroy($id)
        {
            
            Repuesto::destroy($id);
            return Redirect('abms/repuestos')->with('Mensaje','Repuesto Eliminado con éxito!!!!!!');

            //codigo para eliminar fotos
            // $camion=Camion::findOrFail($id);
            // if (Storage::delete('public/'.$camion->foto)){
            //     Camion::destroy($id);
            // }
            
            // return redirect('/abms/camiones');
        }

}

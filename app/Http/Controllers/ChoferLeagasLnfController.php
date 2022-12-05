<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ChoferLeagasLnf;
use App\CategoriaChofer;
use App\ObraSocial;
use App\Gremio;
use App\Localidad;
use App\TipoContratacion;
use App\Empresa;
use Illuminate\Support\Facades\Storage;

use DB;
use Dompdf\Dompdf;
use Laracasts\Flash\Flash;
class ChoferLeagasLnfController extends Controller
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
        $choferes=ChoferLeagasLnf::search($request->name)->where('activo','1')->orderBy('nombre','ASC')->paginate(30);

        //esto es para las relacion de la tabla acoplados con camion
        $choferes->each(function($choferes){
            $choferes->localidad;
            $choferes->empresa;
            $choferes->gremio;
            $choferes->categoriachofer; 
            $choferes->tipocontratacion;
            $choferes->obrasocial;
       });
        //dd($choferes);

        return view('abms.choferes.index')
            ->with('choferes',$choferes);
    }

       public function create()
    {
        $localidades=Localidad::orderBy('nombre','ASC')->pluck('nombre','id');
        $gremios=Gremio::orderBy('nombre','ASC')->pluck('nombre','id');
        $categoriaschofer=CategoriaChofer::orderBy('nombre','ASC')->pluck('nombre','id');
        $obrasociales=ObraSocial::orderBy('nombre','ASC')->pluck('nombre','id');
        $empresas=Empresa::orderBy('denominacion','ASC')->pluck('denominacion','id');
        $tiposcontratacion=TipoContratacion::orderBy('nombre','ASC')->pluck('nombre','id');

        return view('abms.choferes.create')
               ->with('localidades',$localidades)
               ->with('gremios',$gremios)
               ->with('categoriaschofer',$categoriaschofer)
               ->with('obrasociales',$obrasociales)
               ->with('empresas',$empresas)
               ->with('tiposcontratacion',$tiposcontratacion);
    }
   public function eliminar($id)
        {
}
    public function store(Request $request)
    {

        /*VALIDACION -----------------------------------------*/
        $campos=[
            'legajo'=>'required|unique:choferesleagaslnf|numeric',
            'nombre'=>'required|string|max:30',
            'apellido'=>'required|string|max:30',
            'dni'=>'required|numeric',
            'cuil'=>'required|numeric',
            'direccion'=>'required|string|max:100',
            'codpos'=>'required|numeric',
            'localidad_id'=>'required',
            'nrocelular'=>'required|numeric',
            'nrofijo'=>'required|numeric',
            'sexo'=>'required',
            'estadocivil'=>'required',
            'fechanac'=>'required',
            'nacionalidad'=>'required|string|max:25',
            'email'=>'required|string|email|max:255',
            'fechaingreso'=>'required',
            'obrasocial_id'=>'required',
            'empresa_id'=>'required',
            'gremio_id'=>'required',
            'categoriachofer_id'=>'required',
            'tipocontratacion_id'=>'required',

        ];
        $Mensaje=["required"=>'El :attribute es requerido'];
        $this->validate($request,$campos,$Mensaje);
        /*--------------------------------------------------------*/
        /*$datos=new ChoferLeagasLnf(request()->except('_token'));
        
        $datos->activo='1';
        $datos->empresa_id=$request->empresa_id;
        $datos->save();*/

        $imagen=$request->file('foto')->store('public/choferes');
        $url=Storage::url($imagen);
        $datos=new ChoferLeagasLnf(request()->except('_token'));
        $datos->foto=$url;
        $datos->activo=1;
        $datos->save();    

        flash::success('Chofer ingresado!!!');
       
       return Redirect('abms/choferesleagaslnf');
    }

    public function edit($id)
    {
        $choferes=ChoferLeagasLnf::find($id);
        $localidades=Localidad::orderBy('nombre','ASC')->pluck('nombre','id');
        $gremios=Gremio::orderBy('nombre','ASC')->pluck('nombre','id');
        $categoriaschofer=CategoriaChofer::orderBy('nombre','ASC')->pluck('nombre','id');
        $obrasociales=ObraSocial::orderBy('nombre','ASC')->pluck('nombre','id');
        $empresas=Empresa::orderBy('denominacion','ASC')->pluck('denominacion','id');
        $tiposcontratacion=TipoContratacion::orderBy('nombre','ASC')->pluck('nombre','id');
         return view('abms.choferes.edit')
                ->with('choferes',$choferes)
               ->with('localidades',$localidades)
               ->with('gremios',$gremios)
               ->with('categoriaschofer',$categoriaschofer)
               ->with('obrasociales',$obrasociales)
               ->with('empresas',$empresas)
               ->with('tiposcontratacion',$tiposcontratacion);
    }
     public function update(Request $request)
    {


    /*VALIDACION -----------------------------------------*/
        $campos=[
            'legajo'=>'required|numeric',
            'nombre'=>'required|string|max:30',
            'apellido'=>'required|string|max:30',
            'dni'=>'required|numeric',
            'cuil'=>'required|numeric',
            'direccion'=>'required|string|max:100',
            'codpos'=>'required|numeric',
            'localidad_id'=>'required',
            'nrocelular'=>'required|numeric',
            'nrofijo'=>'required|numeric',
            'sexo'=>'required',
            'fechanac'=>'required',
            'nacionalidad'=>'required|string|max:25',
            'email'=>'required|string|email|max:255',
            'fechaingreso'=>'required',
            'obrasocial_id'=>'required',
            'empresa_id'=>'required',
            'gremio_id'=>'required',
            'categoriachofer_id'=>'required',
            'tipocontratacion_id'=>'required',
        ];
        $Mensaje=["required"=>'El :attribute es requerido'];
        $this->validate($request,$campos,$Mensaje);
        /*--------------------------------------------------------*/
 
        if($request->foto===null){
           $datos=request()->except(['_token','_method']);
          ChoferLeagasLnf::where('id','=',$request->id)->update($datos);
        }
        else
        {
           $imagen=$request->file('foto')->store('public/choferes');
           $url=Storage::url($imagen);


           $datos=request()->except(['_token','_method']);
           ChoferLeagasLnf::where('id','=',$request->id)->update($datos);
           $actualizarchofer=ChoferLeagasLnf::where('id',$request->id)
                        ->update([
                                'foto'=>$url
                                 ]);
        }

        
        flash::success('Se a modificado el Chofer'); 
        return Redirect('abms/choferesleagaslnf');
    }

    public function desactivar($id)
    {
        $choferes=ChoferLeagasLnf::find($id);
        return view('abms.choferes.desactivar')
        ->with('choferes',$choferes);
    }
     public function guardardesactivar(Request $request)
    {

    /*VALIDACION -----------------------------------------*/
        $campos=[
           
            'motivodesactivar'=>'required|string|max:250',
            'fechaactivohasta'=>'required'
            
        ];
        $Mensaje=["required"=>'El :attribute es requerido'];
        $this->validate($request,$campos,$Mensaje);
        /*--------------------------------------------------------*/
 
        $actualizarproveedor=ChoferLeagasLnf::where('id',$request->id)
                        ->update([
                                'motivodesactivar'=>$request->motivodesactivar,
                                'fechaactivohasta'=>$request->fechaactivohasta,
                                'activo'=>'0'
                                 ]);
        flash::success('Se Desactivo el Chofer'); 
        return Redirect('abms/choferesleagaslnf');
    }
}

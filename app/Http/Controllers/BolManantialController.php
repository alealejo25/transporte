<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BoletoLeagas;
use App\ChoferLeagasLnf;
use App\ServicioLeagasLnf;
use App\Coche;
use App\Turno;
use App\Linea;
use App\Empresa;
use App\Ramal;
use Laracasts\Flash\Flash;

use Dompdf\Dompdf;
use Luecano\NumeroALetras\NumeroALetras;
use Carbon\Carbon;
use App;
use \PDF;
use DateTime;
use DB;


class BolManantialController extends Controller
{
 public function index(Request $request)
    {
       //  $datos=BoletoLeagas::search($request->name)->orderBy('fecha','DESC')->paginate(40);
    


        $datos=BoletoLeagas::select('*','choferesleagaslnf.nombre as nombrechofer','boletosleagas.id as id_boleto')->join('serviciosleagaslnf','boletosleagas.servicio_id','=','serviciosleagaslnf.id')->join('choferesleagaslnf','boletosleagas.chofer_id','=','choferesleagaslnf.id')->join('turnos','serviciosleagaslnf.turno_id','=','turnos.id')->where('serviciosleagaslnf.empresa_id',1)->get();
        $datos->each(function($datos){
             $datos->linea;
             $datos->choferleagaslnf;
             $datos->servicioleagaslnf;
             $datos->coche;
        });

        return view('bolmanantial.boletos.index')
            ->with('datos',$datos);
    }
     public function create()
    {
        //--------- ESTO ES PARA LOS SERVICIOS DE LA NUEVA FOUNUIER ------------//
        $linea=Linea::where('empresa_id',1)->orderBy('numero','ASC')->get();

        //$choferleagaslnf=ChoferLeagaslnf::orderBy('nombre','ASC')->pluck('nombre','id');
        $choferleagaslnf=ChoferLeagaslnf::orderBy('nombre','ASC')->get();
        $servicioleagaslnf=ServicioLeagasLnf::where('empresa_id',1)->orderBy('numero','ASC')->get();
        $servicioleagaslnf->each(function($servicioleagaslnf){
            $servicioleagaslnf->linea;
            $servicioleagaslnf->ramal;
            $servicioleagaslnf->empresa;
       });
       // $servicioleagaslnf=ServicioLeagasLnf::orderBy('nombre','ASC')->pluck('nombre','id');
        $coche=Coche::orderBy('interno','ASC')->pluck('interno','id');
        $turno=Turno::orderBy('nombre','ASC')->pluck('nombre','id');
       

        return view('bolmanantial.boletos.create')
               ->with('linea',$linea)
               ->with('choferleagaslnf',$choferleagaslnf)
               ->with('servicioleagaslnf',$servicioleagaslnf)
               ->with('coche',$coche);
    }
    public function store(Request $request)
     {

        $date = new \DateTime();
        /*VALIDACION -----------------------------------------*/
        /*  $campos=[
            'chofer_id'=>'required',
            'anticipo'=>'required',
  
         ];
        $Mensaje=["required"=>'El :attribute es requerido'];
        $this->validate($request,$campos,$Mensaje);
        */
        /*--------------------------------------------------------*/
        $docenoche=new DateTime('23:59');
        $horainicio=new DateTime($request->horainicio);
        $horafin=new DateTime($request->horafin);
        $rest = substr($request->horafin, 0,-3); // extraigo los 2 primeros caracteres
        $rest1 = substr($request->horafin, -3);// estraido los 3 ultimos caracteres
        if($rest == 0 || $rest == 1 || $rest == 2 || $rest == 3){
            if($rest==0){
                //$horainicio=new DateTime($request->horainicio);
                $rest=20;
                $horarestadas=$rest.$rest1;
                $newhorafin=new DateTime($horarestadas);
                $newhorainicio=$horainicio->modify('-4 hours');
                $canths = $newhorainicio->diff($newhorafin);
                $canthorastrabajadas=$canths->format('%H:%I');
                            $horastrabajadas=new DateTime($canthorastrabajadas);

            }
            else{
                if($rest==1){
                    //$horainicio=new DateTime($request->horainicio);
                    $rest=21;
                    $horarestadas=$rest.$rest1;
                    $newhorafin=new DateTime($horarestadas);
                    $newhorainicio=$horainicio->modify('-4 hours');
                    
                    $canths = $newhorainicio->diff($newhorafin);
                    $canthorastrabajadas=$canths->format('%H:%I');
                            $horastrabajadas=new DateTime($canthorastrabajadas);


                }
                else{
                    if($rest==2){
                       //$horainicio=new DateTime($request->horainicio);
                        $rest=22;
                        $horarestadas=$rest.$rest1;
                        $newhorafin=new DateTime($horarestadas);
                        $newhorainicio=$horainicio->modify('-4 hours');
                        $canths = $newhorainicio->diff($newhorafin);
                        $canthorastrabajadas=$canths->format('%H:%I');
                            $horastrabajadas=new DateTime($canthorastrabajadas);
 
                    }
                    else{
                       if($rest==3){
                            //$horainicio=new DateTime($request->horainicio);
                            $rest=23;
                            $horarestadas=$rest.$rest1;
                            $newhorafin=new DateTime($horarestadas);
                            $newhorainicio=$horainicio->modify('-4 hours');
                            $canths = $newhorainicio->diff($newhorafin);
                            $canthorastrabajadas=$canths->format('%H:%I');
                            $horastrabajadas=new DateTime($canthorastrabajadas);

                        } 
                    }
                }
            
            }
        }
        else{
            $canths = $horainicio->diff($horafin);
            $canthorastrabajadas=$canths->format('%H:%I');
            $horastrabajadas=new DateTime($canthorastrabajadas);
        }

       
        $horasdetrabajo=new DateTime('07:30');

        $datos=new BoletoLeagas(request()->except('_token'));

        $datos->valorhorasrestantes=0;
        $datos->valortoquesanden=$request->toquesanden*90;
        $datos->horastotal=$canthorastrabajadas;
        $datos->user_id=$request->user_id;
        if($horastrabajadas>$horasdetrabajo){
            $diferenciacanths=$horasdetrabajo->diff($horastrabajadas);  
            $horassobrantes=$diferenciacanths->format('%H:%I');
            $datos->horassobrantes=$horassobrantes;
        }
        else{
           // $cero=new DateTime('0:0');
            //$cerohs=$cero->format('%H:%I');
            $datos->horassobrantes=0;
        }
       
        $datos->save(); 
      
       Flash::success('Servicio agregado correctamente');
       return Redirect('bolmanantial/boletosleagas');
        }
    public function informeboletoleagas($id)
    {

       // $datos=BoletoLeagas::where('id',$id)->get();
            
       //  $datos->each(function($datos){
       //      $datos->linea;
       //      $datos->choferleagaslnf;
       //      $datos->servicioleagaslnf;
       //      $datos->turno; 
       //      $datos->coche;
       //      $datos->user;
       // });


        $datos=BoletoLeagas::select('*','choferesleagaslnf.nombre as nombrechofer','boletosleagas.id as id_boleto')->join('serviciosleagaslnf','boletosleagas.servicio_id','=','serviciosleagaslnf.id')->join('choferesleagaslnf','boletosleagas.chofer_id','=','choferesleagaslnf.id')->join('turnos','serviciosleagaslnf.turno_id','=','turnos.id')->where('boletosleagas.id',$id)->get();
        $datos->each(function($datos){
             $datos->linea;
             $datos->choferleagaslnf;
             $datos->servicioleagaslnf;
             $datos->coche;
        });
        $taller=$datos[0]->taller;

 
        $pdf=\PDF::loadView('bolmanantial.boletos.informeboletoleagas',['datos'=>$datos,'taller'=>$taller])
        ->setPaper('a4');
        return $pdf->download('informeboletoleagas.pdf');
        
    }

    public function boletosleagas()
    {
      /*  $fi = Carbon::parse($request->fechai)->format('Y-m-d').' 00:00:00';
        $ff = Carbon::parse($request->fechaf)->format('Y-m-d').' 23:59:59';
        //$datos=BoletoLeagas::select('id')->groupBy('chofer_id')->get();
        $datos=BoletoLeagas::select('chofer_id')->selectRaw('SEC_TO_TIME(SUM(TIME_TO_SEC(horastotal))) as horastotal')->selectRaw('SEC_TO_TIME(SUM(TIME_TO_SEC(horassobrantes))) as horassobrantes')->selectRaw('SUM(cantpasajes) as pasajes')->selectRaw('SUM(toquesanden) as toqueanden')->selectRaw('SUM(valortoquesanden) as valortoquesanden')->selectRaw('SUM(gasoil) as gasoil')->selectRaw('count(*) as cantidaddeservicios')->whereBetween('fecha',[$fi, $ff])->groupBy('chofer_id')->get();
        $datos->each(function($datos){
            $datos->linea;
            $datos->choferleagaslnf;
            $datos->servicioleagaslnf;
            $datos->turno; 
            $datos->coche;
            $datos->user;
       });
*/
        $chofer=ChoferLeagaslnf::orderBy('nombre','ASC')->pluck('nombre','id');
        return view('bolmanantial.reportes.boletoleagas')
         ->with('chofer',$chofer);
       
    }
    public function reporteboletosleagas(Request $request)
    {   
        $fi = Carbon::parse($request->fechai)->format('Y-m-d').' 00:00:00';
        $ff = Carbon::parse($request->fechaf)->format('Y-m-d').' 23:59:59';
      
        // $datos=BoletoLeagas::select('chofer_id','choferleagaslnf.apellido','choferleagaslnf.nombre')->selectRaw('SEC_TO_TIME(SUM(TIME_TO_SEC(horastotal))) as horastotal')->selectRaw('SEC_TO_TIME(SUM(TIME_TO_SEC(horassobrantes))) as horassobrantes')->selectRaw('SUM(cantpasajes) as cantpasajes')->selectRaw('SUM(recaudacion) as recaudacion')->selectRaw('SUM(toquesanden) as toquesanden')->selectRaw('SUM(valortoquesanden) as valortoquesanden')->selectRaw('SUM(gasoil) as gasoil')->selectRaw('count(*) as cantidaddeservicios')->whereBetween('fecha',[$fi, $ff])->groupBy('chofer_id')->get();

        $datos=BoletoLeagas::select('boletosleagas.chofer_id','choferesleagaslnf.apellido','choferesleagaslnf.nombre')->selectRaw('SEC_TO_TIME(SUM(TIME_TO_SEC(horastotal))) as horastotal')->selectRaw('SEC_TO_TIME(SUM(TIME_TO_SEC(horassobrantes))) as horassobrantes')->selectRaw('SUM(cantpasajes) as cantpasajes')->selectRaw('SUM(recaudacion) as recaudacion')->selectRaw('SUM(toquesanden) as toquesanden')->selectRaw('SUM(valortoquesanden) as valortoquesanden')->selectRaw('SUM(gasoil) as gasoil')->selectRaw('count(*) as cantidaddeservicios')->join('choferesleagaslnf','boletosleagas.chofer_id','=','choferesleagaslnf.id')->whereBetween('fecha',[$fi, $ff])->groupBy('chofer_id')->orderby('choferesleagaslnf.apellido')->get();
        $datos->each(function($datos){
            $datos->linea;
            $datos->choferleagaslnf;
            $datos->servicioleagaslnf;
            $datos->turno; 
            $datos->coche;
            $datos->user;
       });
        //dd($datos);
        $chofer=ChoferLeagaslnf::orderBy('nombre','ASC')->get();
        $pdf=\PDF::loadView('bolmanantial.reportes.reporteboletosleagas',['datos'=>$datos, 'chofer'=>$chofer, 'fi'=>$fi, 'ff'=>$ff])
        ->setPaper('a4','landscape');
        return $pdf->download('reporteboletosleagas.pdf');       
    }

 public function buscarservicios(Request $request)
    {
        $linea=Linea::where('id',$request->linea)->get();

        $datos=ServicioLeagasLnf::where('linea_id',$linea[0]->id)->orderBy('numero','ASC')->get();
        $datos->each(function($datos){
            $datos->linea;
            $datos->ramal;
            $datos->turno; 
            $datos->empresa;
       });
       return $datos;
    }

    public function servicios(Request $request)
    {
        $datos=ServicioLeagasLnf::orderBy('numero','ASC')->get();

        //esto es para las relacion de la tabla acoplados con camion
        $datos->each(function($datos){
            $datos->empresa;
            $datos->linea;
            $datos->ramal;
            $datos->turno;
        });
        //----------------------------------------------------------
        //dd($servicios);
        return view('bolmanantial.boletos.servicios')
            ->with('datos',$datos);
       
        $datos=BoletoLeagas::select('*','choferesleagaslnf.nombre as nombrechofer','boletosleagas.id as id_boleto')->join('serviciosleagaslnf','boletosleagas.servicio_id','=','serviciosleagaslnf.id')->join('choferesleagaslnf','boletosleagas.chofer_id','=','choferesleagaslnf.id')->join('turnos','serviciosleagaslnf.turno_id','=','turnos.id')->where('serviciosleagaslnf.empresa_id',1)->get();
        $datos->each(function($datos){
             $datos->linea;
             $datos->choferleagaslnf;
             $datos->servicioleagaslnf;
             $datos->coche;
        });

        return view('bolmanantial.boletos.index')
            ->with('datos',$datos);
    }
public function createservicio()
    {
        $turno=Turno::orderBy('nombre','ASC')->get();
        $empresa=Empresa::orderBy('denominacion','ASC')->get();
        $linea=Linea::orderBy('numero','ASC')->get();
        $ramal=Ramal::orderBy('nombre','ASC')->get();

        return view('bolmanantial.boletos.createservicio')
               ->with('turno',$turno)
               ->with('empresa',$empresa)
               ->with('linea',$linea)
               ->with('ramal',$ramal);
    }


    public function storeservicio(Request $request)
    {

        /*VALIDACION -----------------------------------------*/
        $campos=[
            'numero'=>'required|integer',
            'empresa'=>'required',
            'turno'=>'required',
            'ramal'=>'required',
            'linea'=>'required',
            ];

        $Mensaje=["required"=>'El :attribute es requerido'];
        $this->validate($request,$campos,$Mensaje);
        
        
            $datos=new ServicioLeagasLnf(request()->except('_token'));
            $datos->linea_id=$request->linea;
            $datos->empresa_id=$request->empresa;
            $datos->turno_id=$request->turno;
            $datos->ramal_id=$request->ramal;

            $datos->save();
               

        Flash::success('Se creo el servicio!!!!');
       
       return Redirect('bolmanantial/boletos/servicios')->with('Mensaje','Se creo el servicio!!!!');
    }

     public function editarservicio($id)
    {
        $servicios=ServicioLeagasLnf::find($id);
         $turno=Turno::orderBy('nombre','ASC')->pluck('nombre','id');
        //$turno=Turno::orderBy('nombre','ASC')->get();
        $empresa=Empresa::orderBy('denominacion','ASC')->pluck('denominacion','id');
        $linea=Linea::orderBy('numero','ASC')->pluck('numero','id');
        $ramal=Ramal::orderBy('nombre','ASC')->pluck('nombre','id');
        return view('bolmanantial.boletos.editarservicio')
            ->with('servicios',$servicios)
            ->with('turno',$turno)
            ->with('ramal',$ramal)
            ->with('empresa',$empresa)
            ->with('linea',$linea);
    }

public function guardaredicionservicios(Request $request)
    {
        $campos=[
            'numero'=>'required|integer',
            'turno_id'=>'required',
            'empresa_id'=>'required',
            'ramal_id'=>'required',
            'linea_id'=>'required',


        ];
        $Mensaje=["required"=>'El :attribute es requerido'];
        $this->validate($request,$campos,$Mensaje);
       $datos=request()->except('_token');
  
        $datos=request()->except(['_token','_method']);
        ServicioLeagasLnf::where('id','=',$request->id)->update($datos);
 
       return Redirect('bolmanantial/boletos/servicios')->with('Mensaje','Se modifico el servicio!!!!');
    }

        public function ramal(Request $request)
    {
        $datos=Ramal::orderBy('nombre','ASC')->get();
        return view('bolmanantial.boletos.ramal')
        ->with('datos',$datos);
    }


public function createramal()
    {
        return view('bolmanantial.boletos.createramal');
               
    }

public function storeramal(Request $request)
    {

        /*VALIDACION -----------------------------------------*/
        $campos=[
            'nombre'=>'required|string|max:50',
            
            ];

        $Mensaje=["required"=>'El :attribute es requerido'];
        $this->validate($request,$campos,$Mensaje);
        
        
            $datos=new Ramal(request()->except('_token'));

            $datos->save();
               

        Flash::success('Se creo el Ramal!!!!');
       
       return Redirect('bolmanantial/boletos/ramal')->with('Mensaje','Se creo el Ramal!!!!');
    }
    
    
}

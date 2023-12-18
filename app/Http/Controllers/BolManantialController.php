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
use App\CargarGasoil;
use App\Gasoil;
use Laracasts\Flash\Flash;
use App\CocheBoleto;
use Dompdf\Dompdf;
use Luecano\NumeroALetras\NumeroALetras;
use Carbon\Carbon;
use App;
use \PDF;
use DateTime;
use DB;
use DatePeriod;
use DateInterval;
use Ndum\Laravel\Snmp;
use Ndum\Laravel\SnmpTrapServer;
use App\Exports\GasOilExport;
//use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;



class BolManantialController extends Controller
{




 public function index(Request $request)
    {


        $datos=DB::table('vistaserviciosleagas')->select('*')->orderBy('fecha','DESC')->get();
        return view('bolmanantial.boletos.index')
            ->with('datos',$datos);



          /*  $datos=BoletoLeagas::select('coches.interno','choferesleagaslnf.nombre as nombrechofer','boletosleagas.id as id_boleto','boletosleagas.numero as num')->join('serviciosleagaslnf','boletosleagas.servicio_id','=','serviciosleagaslnf.id')->join('choferesleagaslnf','boletosleagas.chofer_id','=','choferesleagaslnf.id')->join('turnos','serviciosleagaslnf.turno_id','=','turnos.id')->join('cochesboletos','cochesboletos.boletosleagas_id','=','boletosleagas.id')->join('coches','cochesboletos.coche_id','=','coches.id')->where('serviciosleagaslnf.empresa_id',2)->orderBy('num','DESC')->get();*/
    }

    public function indexlnf(Request $request)
    {
 
        $datos=BoletoLeagas::select('*','coches.interno','choferesleagaslnf.nombre as nombrechofer','boletosleagas.id as id_boleto','boletosleagas.numero as num')->join('serviciosleagaslnf','boletosleagas.servicio_id','=','serviciosleagaslnf.id')->join('choferesleagaslnf','boletosleagas.chofer_id','=','choferesleagaslnf.id')->join('turnos','serviciosleagaslnf.turno_id','=','turnos.id')->join('cochesboletos','cochesboletos.boletosleagas_id','=','boletosleagas.id')->join('coches','cochesboletos.coche_id','=','coches.id')->where('serviciosleagaslnf.empresa_id',1)->orderBy('num','DESC')->get();

        //dd($datos);
        $datos->each(function($datos){
             $datos->linea;
             $datos->choferleagaslnf;
             $datos->servicioleagaslnf;

        });
        //dd($datos);

        return view('bolmanantial.boletos.indexlnf')
            ->with('datos',$datos);
    }


     public function create()
    {
        //--------- ESTO ES PARA LOS SERVICIOS DE LEAGAS ------------//
        $linea=Linea::where('empresa_id',2)->orderBy('numero','ASC')->get();

        //$choferleagaslnf=ChoferLeagaslnf::orderBy('nombre','ASC')->pluck('nombre','id');
        $choferleagaslnf=ChoferLeagaslnf::where('empresa_id',2)->orderBy('legajo','ASC')->get();
        $servicioleagaslnf=ServicioLeagasLnf::where('empresa_id',2)->orderBy('numero','ASC')->get();
        $servicioleagaslnf->each(function($servicioleagaslnf){
            $servicioleagaslnf->linea;
            $servicioleagaslnf->ramal;
            $servicioleagaslnf->empresa;
       });
       // $servicioleagaslnf=ServicioLeagasLnf::orderBy('nombre','ASC')->pluck('nombre','id');
        $coche=Coche::where('empresa_id',2)->orderBy('interno','ASC')->get();
        $turno=Turno::orderBy('nombre','ASC')->pluck('nombre','id');
        //      $fecha=null;

        return view('bolmanantial.boletos.create')
               ->with('linea',$linea)
        //        ->with('fecha',$fecha)
               ->with('choferleagaslnf',$choferleagaslnf)
               ->with('servicioleagaslnf',$servicioleagaslnf)
               ->with('empresa',2)
               ->with('coche',$coche);
    }
     public function createlnf()
    {
        
        //--------- ESTO ES PARA LOS SERVICIOS DE LA NUEVA FOUNUIER ------------//
        $linea=Linea::where('empresa_id',1)->orderBy('numero','ASC')->get();

        $choferleagaslnf=ChoferLeagaslnf::where('empresa_id',1)->orderBy('legajo','ASC')->get();
        $servicioleagaslnf=ServicioLeagasLnf::where('empresa_id',1)->orderBy('numero','ASC')->get();
        $servicioleagaslnf->each(function($servicioleagaslnf){
            $servicioleagaslnf->linea;
            $servicioleagaslnf->ramal;
            $servicioleagaslnf->empresa;
       });
        $coche=Coche::where('empresa_id',1)->orderBy('interno','ASC')->get();
        $turno=Turno::orderBy('nombre','ASC')->pluck('nombre','id');
       
       //$fecha=null;

        return view('bolmanantial.boletos.create')
               ->with('linea',$linea)
         //      ->with('fecha',$fecha)
               ->with('choferleagaslnf',$choferleagaslnf)
               ->with('servicioleagaslnf',$servicioleagaslnf)
                ->with('empresa',1)
               ->with('coche',$coche);
    }
    public function store(Request $request)
     {

 

  /*      VALIDACION -----------------------------------------*/
            $campos=[
            'numero'=>'required|max:8|unique:boletosleagas,numero',
            'chofer_id'=>'required',
            'linea_id'=>'required',
            'servicio_id'=>'required',
            'fecha'=>'required',
            'horainicio'=>'required',
            'horafin'=>'required',
            'toquesanden'=>'numeric|required|min:0|max:10',
            'coche_id.*'=>'required',
            'iniciotarjeta.*'=>'numeric|required',
            'fintarjeta.*'=>'numeric|required',
            'taller.*'=>'required',
            'motivo_cambio.*'=>'max:150',
        ];
        $Mensaje=["required"=>'El :attribute es requerido',
                      "unique"=>'YA EXISTE EL NUMERO DE PLANILLA'];
        $this->validate($request,$campos,$Mensaje);







        /*--------------------------------------------------------*/
        $coches=$request->all();

        // --------- calculo de horas trabajadas
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
        // ------ fin de calculo de hs trabajasdas
       
        $horasdetrabajo=new DateTime('07:30');
        //$datos=new BoletoLeagas(request()->except('_token'));
        $datos=new BoletoLeagas();
        $datos->numero=$request->numero;
        $datos->valorhorasrestantes=0;
        $datos->valortoquesanden=$request->toquesanden*170;
        
        $datos->user_id=$request->user_id;

        // calculo por tipos de servicios normal alargue cortado/////
        if($request->tiposervicio=='NORMAL'){
            //$datos->normal=1;
            $normal=BoletoLeagas::where('chofer_id',$request->chofer_id)->where('normal',1)->where('fecha',$request->fecha)->orderBy('id','DESC')->limit(1)->get();
            $datos->horastotal=$canthorastrabajadas;

            if(count($normal)>0){
                $datos->doblenegro=1;
                $datos->horassobrantes=0;
            }
            else{
                $datos->normal=1;
                if($horastrabajadas>$horasdetrabajo){
                $diferenciacanths=$horasdetrabajo->diff($horastrabajadas);  
                $horassobrantes=$diferenciacanths->format('%H:%I');
                $datos->horassobrantes=$horassobrantes;
                }
                else{
                    $datos->horassobrantes=0;
                }
            }
            
        }

        else{
            // LOS ALARGUES NORMAL/CORTADO NORMAL/NORMAL/CORTADO
            if($request->tiposervicio=='ALARGUE'){
                $datos->alargue=1;
                $datos->horastotalalargue=$canthorastrabajadas;
                $datos->horastotal=$canthorastrabajadas; 
                $datos->horassobrantes=0; 
            }
            //ESTO ES CORTADO/CORTADO
            else{

                $cortado=BoletoLeagas::where('chofer_id',$request->chofer_id)->where('cortado',1)->where('fecha',$request->fecha)->orderBy('id','DESC')->limit(1)->get();
                
                if(count($cortado)>0){
                    $normal=BoletoLeagas::where('chofer_id',$request->chofer_id)->where('normal',1)->where('fecha',$request->fecha)->orderBy('id','DESC')->limit(1)->get();
                    if(count($normal)>0){
                        $datos->cortado=2;
                        $datos->horastotal=$canthorastrabajadas;
                        $datos->horassobrantes=0;
                        $datos->doblenegro=1;
                    }
                    else
                    {
                        $horastrabajadasanterior=$cortado[0]->horastotal;
                        list($h, $m, $s) = explode(':', $horastrabajadasanterior); //Separo los elementos de la segunda hora
                        $a = new DateTime($canthorastrabajadas); //Creo un DateTime
                        $b = new DateInterval(sprintf('PT%sH%sM%sS', $h, $m, $s)); //Creo un DateInterval
                        $a->add($b); //SUMO las horas
                        $horassumadas=$a->format('H:i'); //Retorno la Suma
                        $horassumadasformateada=new DateTime($horassumadas);
                        $actualizarboletos=BoletoLeagas::where('chofer_id',$request->chofer_id)->where('cortado',1)->where('fecha',$request->fecha)->update([
                                    'cortado'=>'2',
                                     ]);

                        $datos->cortado=2;

                        if($horassumadasformateada>$horasdetrabajo){
                            $diferenciacanths=$horasdetrabajo->diff($horassumadasformateada);  
                            $horassobrantes=$diferenciacanths->format('%H:%I');
                            $datos->horassobrantes=$horassobrantes;
                            $datos->horastotal=$canthorastrabajadas;
                            //$datos->cortado=2;
                        }
                        else
                        {
                           // $cero=new DateTime('0:0');
                            //$cerohs=$cero->format('%H:%I');
                            $datos->horassobrantes=0;
                            $datos->horastotal=$canthorastrabajadas;
                            //$datos->cortado=2;
                        }
                    }
                }else{
                    $datos->cortado=1;
                    $datos->horastotal=$canthorastrabajadas;
                    $datos->horassobrantes=0;
                }
        }
    }
       $datos->chofer_id=$request->chofer_id;
       $datos->linea_id=$request->linea_id;
       $datos->servicio_id=$request->servicio_id;
       $datos->fecha=$request->fecha;
       $datos->horainicio=$request->horainicio;
       $datos->horafin=$request->horafin;
       //$datos->gasoil=$request->gasoil;
       $datos->toquesanden=$request->toquesanden;
       $datos->save();
       $idBoletoLeagas=BoletoLeagas::orderBy('id','DESC')->limit(1)->get();
       $idBoleto=$idBoletoLeagas[0]->id;

       $recaudaciontotal=0;
       $pasajestotal=0;
       $linea=Linea::where('id',$request->linea_id)->limit(1)->get();

       $precioboleto=$linea[0]->precioboleto;

        foreach($coches['coche_id'] as $key => $value){
            $boletos=new CocheBoleto();
                $boletos->iniciotarjeta=$coches["iniciotarjeta"][$key];
                $boletos->fintarjeta=$coches["fintarjeta"][$key];
                $boletos->cantpasajes=$coches["fintarjeta"][$key]-$coches["iniciotarjeta"][$key];
               $boletos->recaudacion=$precioboleto*$boletos->cantpasajes;    
            
                
                $boletos->taller=$coches["taller"][$key];
                $boletos->motivo_cambio=$coches["motivo_cambio"][$key];
                $boletos->coche_id=$coches["coche_id"][$key];
                $boletos->km=$coches["km"][$key];
                $boletos->boletosleagas_id=$idBoleto;
                $recaudaciontotal=$recaudaciontotal+$boletos->recaudacion;
                $pasajestotal=$pasajestotal+$boletos->cantpasajes;
                $boletos->save();    
        }
      
        $actualizarboletos=BoletoLeagas::where('id',$idBoleto)
                        ->update([
                                'recaudaciontotal'=>$recaudaciontotal,
                                'pasajestotal'=>$pasajestotal
                                 ]);
       if($request->empresa==2){
//--------- ESTO ES PARA LOS SERVICIOS DE LEAGAS ------------//
        $linea=Linea::where('empresa_id',2)->orderBy('numero','ASC')->get();

        //$choferleagaslnf=ChoferLeagaslnf::orderBy('nombre','ASC')->pluck('nombre','id');
        $choferleagaslnf=ChoferLeagaslnf::where('empresa_id',2)->orderBy('legajo','ASC')->get();
        $servicioleagaslnf=ServicioLeagasLnf::where('empresa_id',2)->orderBy('numero','ASC')->get();
        $servicioleagaslnf->each(function($servicioleagaslnf){
            $servicioleagaslnf->linea;
            $servicioleagaslnf->ramal;
            $servicioleagaslnf->empresa;
       });
       // $servicioleagaslnf=ServicioLeagasLnf::orderBy('nombre','ASC')->pluck('nombre','id');
        $coche=Coche::where('empresa_id',2)->orderBy('interno','ASC')->get();
        $turno=Turno::orderBy('nombre','ASC')->pluck('nombre','id');
        Flash::success('Servicio agregado correctamente');
        return view('bolmanantial.boletos.create')
               ->with('linea',$linea)
               ->with('fecha',$request->fecha)
               ->with('choferleagaslnf',$choferleagaslnf)
               ->with('servicioleagaslnf',$servicioleagaslnf)
                ->with('empresa',2)
               ->with('coche',$coche);

       }else
       {

//--------- ESTO ES PARA LOS SERVICIOS DE LA NUEVA FOUNUIER ------------//
        $linea=Linea::where('empresa_id',1)->orderBy('numero','ASC')->get();

        //$choferleagaslnf=ChoferLeagaslnf::orderBy('nombre','ASC')->pluck('nombre','id');
        $choferleagaslnf=ChoferLeagaslnf::where('empresa_id',1)->orderBy('legajo','ASC')->get();
        $servicioleagaslnf=ServicioLeagasLnf::where('empresa_id',1)->orderBy('numero','ASC')->get();
        $servicioleagaslnf->each(function($servicioleagaslnf){
            $servicioleagaslnf->linea;
            $servicioleagaslnf->ramal;
            $servicioleagaslnf->empresa;
       });
       // $servicioleagaslnf=ServicioLeagasLnf::orderBy('nombre','ASC')->pluck('nombre','id');
        $coche=Coche::where('empresa_id',1)->orderBy('interno','ASC')->get();
        $turno=Turno::orderBy('nombre','ASC')->pluck('nombre','id');
       

        
        Flash::success('Servicio agregado correctamente');
        return view('bolmanantial.boletos.create')
               ->with('linea',$linea)
               ->with('fecha',$request->fecha)
               ->with('choferleagaslnf',$choferleagaslnf)
               ->with('servicioleagaslnf',$servicioleagaslnf)
                ->with('empresa',1)
               ->with('coche',$coche);




       //return Redirect('bolmanantial/boletoslnf');
       }
    }

        public function modificarservicio($id){
        $datos=BoletoLeagas::find($id);
        // $turno=Turno::orderBy('nombre','ASC')->pluck('nombre','id');
        // $empresa=Empresa::orderBy('denominacion','ASC')->pluck('denominacion','id');
        // $linea=Linea::orderBy('numero','ASC')->pluck('numero','id');
        // $ramal=Ramal::orderBy('nombre','ASC')->pluck('nombre','id');
        // return view('bolmanantial.boletos.editarservicio')
        //     ->with('servicios',$servicios)
        //     ->with('turno',$turno)
        //     ->with('ramal',$ramal)
        //     ->with('empresa',$empresa)
        //     ->with('linea',$linea);
        }
    public function informeboletoleagas($id){

        $datos=BoletoLeagas::select('*','choferesleagaslnf.nombre as nombrechofer','turnos.nombre as nombreturno','boletosleagas.id as id_boleto')
            ->join('serviciosleagaslnf','boletosleagas.servicio_id','=','serviciosleagaslnf.id')
            ->join('choferesleagaslnf','boletosleagas.chofer_id','=','choferesleagaslnf.id')
            ->join('turnos','serviciosleagaslnf.turno_id','=','turnos.id')
            ->where('boletosleagas.id',$id)->get();

            $servicios=CocheBoleto::select('*','cochesboletos.id as id_co')->join('coches','cochesboletos.coche_id','=','coches.id')->where('cochesboletos.boletosleagas_id',$id)->get();
            $emp=BoletoLeagas::where('id',$id)->limit(1)->get();

            $linea=Linea::where('id',$emp[0]->linea_id)->limit(1)->get();
            $empresa=$linea[0]->empresa_id;
            
            

        $pdf=\PDF::loadView('bolmanantial.boletos.informeboletoleagas',['datos'=>$datos,'empresa'=>$empresa,'servicios'=>$servicios])
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
        $empresa=Empresa::orderBy('denominacion','ASC')->pluck('denominacion','id');
        //$linea=Linea::orderBy('numero','ASC')->pluck('numero','id');
        //$linea=Linea::where('empresa_id',1)->orderBy('numero','ASC')->get();
        $linea=Linea::orderBy('numero','ASC')->get();
        //$choferleagaslnf=ChoferLeagaslnf::where('empresa_id',1)->orderBy('legajo','ASC')->get();
        $choferleagaslnf=ChoferLeagaslnf::orderBy('legajo','ASC')->get();


        return view('bolmanantial.reportes.boletoleagas')
        ->with('linea',$linea)
        ->with('choferleagaslnf',$choferleagaslnf)
         ->with('empresa',$empresa);
       
    }
    public function reporteboletosleagas(Request $request)
    {   


        /*VALIDACION -----------------------------------------*/
            $campos=[
            'fechai'=>'required',
            'fechaf'=>'required',
            'empresa_id'=>'required',
            'linea_id'=>'required',
            
        ];
        $Mensaje=["required"=>'El :attribute es requerido'];
        $this->validate($request,$campos,$Mensaje);

        /*--------------------------------------------------------*/
          

        $fi = Carbon::parse($request->fechai)->format('Y-m-d').' 00:00:00';
        $ff = Carbon::parse($request->fechaf)->format('Y-m-d').' 23:59:59';
      
      if($request->linea_id == "TODAS"){
        if($request->chofer_id==NULL){
            $datos=BoletoLeagas::select('boletosleagas.chofer_id','choferesleagaslnf.apellido','choferesleagaslnf.nombre')->selectRaw('SEC_TO_TIME(SUM(TIME_TO_SEC(horastotal))) as horastotal')->selectRaw('SEC_TO_TIME(SUM(TIME_TO_SEC(horassobrantes))) as horassobrantes')->selectRaw('SEC_TO_TIME(SUM(TIME_TO_SEC(horastotalalargue))) as horastotalalargue')->selectRaw('SUM(pasajestotal) as pasajes')->selectRaw('SUM(recaudaciontotal) as recaudacion')->selectRaw('SUM(toquesanden) as toquesanden')->selectRaw('SUM(valortoquesanden) as valortoquesanden')->selectRaw('SUM(gasoiltotal) as gasoil')->selectRaw('SUM(normal) as normal')->selectRaw('SUM(doblenegro) as doblenegro')->selectRaw('count(*) as cantidaddeservicios')->join('choferesleagaslnf','boletosleagas.chofer_id','=','choferesleagaslnf.id')->where('empresa_id',$request->empresa_id)->whereBetween('fecha',[$fi, $ff])->groupBy('chofer_id')->orderby('choferesleagaslnf.apellido')->get();

        }
        else{
            $datos=BoletoLeagas::select('boletosleagas.chofer_id','choferesleagaslnf.apellido','choferesleagaslnf.nombre')->selectRaw('SEC_TO_TIME(SUM(TIME_TO_SEC(horastotal))) as horastotal')->selectRaw('SEC_TO_TIME(SUM(TIME_TO_SEC(horassobrantes))) as horassobrantes')->selectRaw('SEC_TO_TIME(SUM(TIME_TO_SEC(horastotalalargue))) as horastotalalargue')->selectRaw('SUM(pasajestotal) as pasajes')->selectRaw('SUM(recaudaciontotal) as recaudacion')->selectRaw('SUM(toquesanden) as toquesanden')->selectRaw('SUM(valortoquesanden) as valortoquesanden')->selectRaw('SUM(gasoiltotal) as gasoil')->selectRaw('SUM(normal) as normal')->selectRaw('SUM(doblenegro) as doblenegro')->selectRaw('count(*) as cantidaddeservicios')->join('choferesleagaslnf','boletosleagas.chofer_id','=','choferesleagaslnf.id')->where('empresa_id',$request->empresa_id)->where('chofer_id',$request->chofer_id)->whereBetween('fecha',[$fi, $ff])->groupBy('chofer_id')->orderby('choferesleagaslnf.apellido')->get();

        }
        }
        else{
            if($request->chofer_id==NULL){
           $datos=BoletoLeagas::select('boletosleagas.chofer_id','choferesleagaslnf.apellido','choferesleagaslnf.nombre')->selectRaw('SEC_TO_TIME(SUM(TIME_TO_SEC(horastotal))) as horastotal')->selectRaw('SEC_TO_TIME(SUM(TIME_TO_SEC(horassobrantes))) as horassobrantes')->selectRaw('SEC_TO_TIME(SUM(TIME_TO_SEC(horastotalalargue))) as horastotalalargue')->selectRaw('SUM(pasajestotal) as pasajes')->selectRaw('SUM(recaudaciontotal) as recaudacion')->selectRaw('SUM(normal) as normal')->selectRaw('SUM(doblenegro) as doblenegro')->selectRaw('SUM(toquesanden) as toquesanden')->selectRaw('SUM(valortoquesanden) as valortoquesanden')->selectRaw('SUM(gasoiltotal) as gasoil')->selectRaw('count(*) as cantidaddeservicios')->join('choferesleagaslnf','boletosleagas.chofer_id','=','choferesleagaslnf.id')->where('empresa_id',$request->empresa_id)->where('linea_id',$request->linea_id)->whereBetween('fecha',[$fi, $ff])->groupBy('chofer_id')->orderby('choferesleagaslnf.apellido')->get();
       }
       else{
         $datos=BoletoLeagas::select('boletosleagas.chofer_id','choferesleagaslnf.apellido','choferesleagaslnf.nombre')->selectRaw('SEC_TO_TIME(SUM(TIME_TO_SEC(horastotal))) as horastotal')->selectRaw('SEC_TO_TIME(SUM(TIME_TO_SEC(horassobrantes))) as horassobrantes')->selectRaw('SEC_TO_TIME(SUM(TIME_TO_SEC(horastotalalargue))) as horastotalalargue')->selectRaw('SUM(pasajestotal) as pasajes')->selectRaw('SUM(recaudaciontotal) as recaudacion')->selectRaw('SUM(normal) as normal')->selectRaw('SUM(doblenegro) as doblenegro')->selectRaw('SUM(toquesanden) as toquesanden')->selectRaw('SUM(valortoquesanden) as valortoquesanden')->selectRaw('SUM(gasoiltotal) as gasoil')->selectRaw('count(*) as cantidaddeservicios')->join('choferesleagaslnf','boletosleagas.chofer_id','=','choferesleagaslnf.id')->where('empresa_id',$request->empresa_id)->where('chofer_id',$request->chofer_id)->where('linea_id',$request->linea_id)->whereBetween('fecha',[$fi, $ff])->groupBy('chofer_id')->orderby('choferesleagaslnf.apellido')->get();
       }
   }
       
       

            $datos->each(function($datos){
            $datos->linea;
            $datos->choferleagaslnf;
            $datos->servicioleagaslnf;
            $datos->turno; 
            $datos->coche;
            $datos->user;
       });

             $empresa=$request->empresa_id;
        $chofer=ChoferLeagaslnf::orderBy('nombre','ASC')->get();
        $pdf=\PDF::loadView('bolmanantial.reportes.reporteboletosleagas',['datos'=>$datos,'empresa'=>$empresa, 'chofer'=>$chofer, 'fi'=>$fi, 'ff'=>$ff])
        ->setPaper('a4','landscape');
        return $pdf->download('reporteboletosleagas.pdf');       
    }


public function hstrabajadas()
    {
       $choferleagaslnf=ChoferLeagaslnf::orderBy('legajo','ASC')->get();
        $empresa=Empresa::orderBy('denominacion','ASC')->pluck('denominacion','id');
        $linea=Linea::orderBy('numero','ASC')->pluck('numero','id');
        return view('bolmanantial.reportes.hstrabajadas')
            ->with('empresa',$empresa)
            ->with('linea',$linea)
            ->with('choferleagaslnf',$choferleagaslnf);
    }

public function reportehstrabajadas(Request $request)
    {   
         /*VALIDACION -----------------------------------------*/
            $campos=[
            'fechai'=>'required',
            'fechaf'=>'required',
            'empresa_id'=>'required',
            
            'chofer_id'=>'required',
        ];
        $Mensaje=["required"=>'El :attribute es requerido'];
        $this->validate($request,$campos,$Mensaje);

        /*--------------------------------------------------------*/

        $fi = Carbon::parse($request->fechai)->format('Y-m-d').' 00:00:00';
        $ff = Carbon::parse($request->fechaf)->format('Y-m-d').' 23:59:59';
        if($request->chofer_id=='TODOS'){
/*
      $datos=BoletoLeagas::select('lineas.numero as numlinea','choferesleagaslnf.id as idchofer','choferesleagaslnf.apellido','choferesleagaslnf.nombre','choferesleagaslnf.legajo','boletosleagas.fecha','boletosleagas.numero','boletosleagas.pasajestotal','boletosleagas.horastotal','boletosleagas.horassobrantes','boletosleagas.horastotalalargue','boletosleagas.alargue','boletosleagas.cortado','boletosleagas.doblenegro','boletosleagas.normal')->join('choferesleagaslnf','boletosleagas.chofer_id','=','choferesleagaslnf.id')->join('lineas','boletosleagas.linea_id','=','lineas.id')->where('choferesleagaslnf.empresa_id',$request->empresa_id)->whereBetween('fecha',[$fi, $ff])->orderby('choferesleagaslnf.apellido','ASC')->orderby('boletosleagas.fecha','ASC')->get();

*/


 $datos=BoletoLeagas::select('turnos.nombre as nomturno','ramales.nombre as nomramal','serviciosleagaslnf.numero as numservicio','lineas.numero as numlinea','choferesleagaslnf.id as idchofer','choferesleagaslnf.apellido','choferesleagaslnf.nombre','choferesleagaslnf.legajo','boletosleagas.fecha','boletosleagas.numero','boletosleagas.pasajestotal','boletosleagas.horastotal','boletosleagas.horassobrantes','boletosleagas.horastotalalargue','boletosleagas.alargue','boletosleagas.cortado','boletosleagas.doblenegro','boletosleagas.normal')->join('choferesleagaslnf','boletosleagas.chofer_id','=','choferesleagaslnf.id')->join('lineas','boletosleagas.linea_id','=','lineas.id')->join('serviciosleagaslnf','boletosleagas.servicio_id','=','serviciosleagaslnf.id')->join('turnos','serviciosleagaslnf.turno_id','=','turnos.id')->join('ramales','serviciosleagaslnf.ramal_id','=','ramales.id')->where('choferesleagaslnf.empresa_id',$request->empresa_id)->whereBetween('fecha',[$fi, $ff])->orderby('choferesleagaslnf.apellido','ASC')->orderby('boletosleagas.fecha','ASC')->get();

    $datos1=BoletoLeagas::select('choferesleagaslnf.id as idchofer1','choferesleagaslnf.apellido','choferesleagaslnf.nombre','choferesleagaslnf.legajo','boletosleagas.fecha','boletosleagas.numero','boletosleagas.pasajestotal','boletosleagas.horastotal','boletosleagas.horassobrantes','boletosleagas.horastotalalargue','boletosleagas.alargue','boletosleagas.cortado','boletosleagas.doblenegro','boletosleagas.normal')->selectRaw('SEC_TO_TIME(SUM(TIME_TO_SEC(boletosleagas.horassobrantes))) as sumhorassobrantes')->join('choferesleagaslnf','boletosleagas.chofer_id','=','choferesleagaslnf.id')->where('empresa_id',$request->empresa_id)->whereBetween('fecha',[$fi, $ff])->orderby('choferesleagaslnf.apellido')->orderby('boletosleagas.fecha','ASC')->groupby('choferesleagaslnf.id')->get();


             $pdf=\PDF::loadView('bolmanantial.reportes.reportehstrabajadas',['datos'=>$datos,'datos1'=>$datos1,'fi'=>$fi, 'ff'=>$ff])
        ->setPaper('a4','portrait');
        return $pdf->download('reportehstrabajadas.pdf');
        }
        else
        {
    /*        $datos=BoletoLeagas::select('lineas.numero as numlinea','choferesleagaslnf.id as idchofer','choferesleagaslnf.apellido','choferesleagaslnf.nombre','choferesleagaslnf.legajo','boletosleagas.fecha','boletosleagas.numero','boletosleagas.pasajestotal','boletosleagas.horastotal','boletosleagas.horassobrantes','boletosleagas.horastotalalargue','boletosleagas.alargue','boletosleagas.cortado','boletosleagas.doblenegro','boletosleagas.normal')->join('choferesleagaslnf','boletosleagas.chofer_id','=','choferesleagaslnf.id')->join('lineas','boletosleagas.linea_id','=','lineas.id')->where('chofer_id',$request->chofer_id)->whereBetween('fecha',[$fi, $ff])->orderby('choferesleagaslnf.apellido')->orderby('boletosleagas.fecha','ASC')->get();*/


$datos=BoletoLeagas::select('turnos.nombre as nomturno','ramales.nombre as nomramal','serviciosleagaslnf.numero as numservicio','lineas.numero as numlinea','choferesleagaslnf.id as idchofer','choferesleagaslnf.apellido','choferesleagaslnf.nombre','choferesleagaslnf.legajo','boletosleagas.fecha','boletosleagas.numero','boletosleagas.pasajestotal','boletosleagas.horastotal','boletosleagas.horassobrantes','boletosleagas.horastotalalargue','boletosleagas.alargue','boletosleagas.cortado','boletosleagas.doblenegro','boletosleagas.normal')->join('choferesleagaslnf','boletosleagas.chofer_id','=','choferesleagaslnf.id')->join('lineas','boletosleagas.linea_id','=','lineas.id')->join('serviciosleagaslnf','boletosleagas.servicio_id','=','serviciosleagaslnf.id')->join('turnos','serviciosleagaslnf.turno_id','=','turnos.id')->join('ramales','serviciosleagaslnf.ramal_id','=','ramales.id')->where('boletosleagas.chofer_id',$request->chofer_id)->whereBetween('fecha',[$fi, $ff])->orderby('choferesleagaslnf.apellido','ASC')->orderby('boletosleagas.fecha','ASC')->get();



            $datos1=BoletoLeagas::select('choferesleagaslnf.id as idchofer1','choferesleagaslnf.apellido','choferesleagaslnf.nombre','choferesleagaslnf.legajo','boletosleagas.fecha','boletosleagas.numero','boletosleagas.pasajestotal','boletosleagas.horastotal','boletosleagas.horassobrantes','boletosleagas.horastotalalargue','boletosleagas.alargue','boletosleagas.cortado','boletosleagas.doblenegro','boletosleagas.normal')->selectRaw('SEC_TO_TIME(SUM(TIME_TO_SEC(boletosleagas.horassobrantes))) as sumhorassobrantes')->join('choferesleagaslnf','boletosleagas.chofer_id','=','choferesleagaslnf.id')->where('chofer_id',$request->chofer_id)->whereBetween('fecha',[$fi, $ff])->orderby('choferesleagaslnf.apellido')->orderby('boletosleagas.fecha','ASC')->get();

             $pdf=\PDF::loadView('bolmanantial.reportes.reportehstrabajadas',['datos'=>$datos,'datos1'=>$datos1,'fi'=>$fi, 'ff'=>$ff])
        ->setPaper('a4','portrait');
        return $pdf->download('reportehstrabajadas.pdf');
                    
        }

      
 

}

public function cargargasoil($id)
    {

    $servicios=CocheBoleto::select('*','cochesboletos.id as id_co')->join('coches','cochesboletos.coche_id','=','coches.id')->where('cochesboletos.boletosleagas_id',$id)->get();
        return view('bolmanantial.boletos.cargargasoil')
            ->with('servicios',$servicios)
            ->with('id',$id);
    }

    public function guardarcargagasoil(Request $request)
    {

       
       
       /* $campos=[
            '$boletos["gasoil"][$key]'=>'required',
        ];
        $Mensaje=["required"=>'El :attribute es requerido'];
        $this->validate($request,$campos,$Mensaje);
        }*/
        
        
        $boletos=$request->all();
        $gasoiltotal=0;
        foreach($boletos['cochesboletos_id'] as $key => $value){
            $gasoiltotal=$gasoiltotal+$boletos["gasoil"][$key];
            $editacocheboletos=CocheBoleto::where('id',$boletos["cochesboletos_id"][$key])
                ->update([
                          'gasoil'=>$boletos["gasoil"][$key]
                          ]);
              
        }
        
        $editacocheboletos=BoletoLeagas::where('id',$request->id)
                ->update([
                          'gasoiltotal'=>$gasoiltotal
                          ]);
              

       return Redirect('bolmanantial/boletosleagas')->with('Mensaje','Se modifico el servicio!!!!');
    }

public function gasoildiario()
{
    $empresa=Empresa::orderBy('denominacion','ASC')->pluck('denominacion','id');
    return view('bolmanantial.reportes.reportegasoildiario')
         ->with('empresa',$empresa);

}
public function reportegasoildiario(Request $request)
    {

        $fi = Carbon::parse($request->fechai)->format('Y-m-d').' 00:00:00';
        $ff = Carbon::parse($request->fechaf)->format('Y-m-d').' 23:59:59';

        //para la nueva fournier LA NUEVA FOURNIER
        if($request->empresa_id==1){
            $datos=Gasoil::Select('gasoil.fecha','gasoil.l118total as l118','gasoil.l121total','gasoil.l122total','gasoil.l131total')->whereBetween('fecha',[$fi, $ff])->where('empresa_id',1)->get();
            dd($datos);
            $linea118=CargarGasoil::Select('cargargasoil.litros as litros','cargargasoil.interno as interno','coches.nroempresa as nroempresa','gasoil.fecha as fecha')->join('gasoil','cargargasoil.gasoil_id','=','gasoil.id')->join('coches','cargargasoil.coche_id','=','coches.id')->whereBetween('fecha',[$fi, $ff])->where('coches.nroempresa',118)->get();

            $linea121=CargarGasoil::Select('cargargasoil.litros as litros','cargargasoil.interno as interno','coches.nroempresa as nroempresa','gasoil.fecha as fecha')->join('gasoil','cargargasoil.gasoil_id','=','gasoil.id')->join('coches','cargargasoil.coche_id','=','coches.id')->whereBetween('fecha',[$fi, $ff])->where('coches.nroempresa',121)->get();
            $linea122=CargarGasoil::Select('cargargasoil.litros as litros','cargargasoil.interno as interno','coches.nroempresa as nroempresa','gasoil.fecha as fecha')->join('gasoil','cargargasoil.gasoil_id','=','gasoil.id')->join('coches','cargargasoil.coche_id','=','coches.id')->whereBetween('fecha',[$fi, $ff])->where('coches.nroempresa',122)->get();
            $linea131=CargarGasoil::Select('cargargasoil.litros as litros','cargargasoil.interno as interno','coches.nroempresa as nroempresa','gasoil.fecha as fecha')->join('gasoil','cargargasoil.gasoil_id','=','gasoil.id')->join('coches','cargargasoil.coche_id','=','coches.id')->whereBetween('fecha',[$fi, $ff])->where('coches.nroempresa',131)->get();

         $pdf=\PDF::loadView('bolmanantial.reportes.reportegasoildiariolnf',['datos'=>$datos,'linea118'=>$linea118, 'linea121'=>$linea121,'linea122'=>$linea122,'linea131'=>$linea131, 'fi'=>$fi, 'ff'=>$ff])
        ->setPaper('a4','portrait');
        return $pdf->download('reportegasoildiariolnf.pdf');

        }
        else
        {
            $datos=Gasoil::Select('gasoil.fecha','gasoil.l10total','gasoil.l110total','gasoil.l142total')->whereBetween('fecha',[$fi, $ff])->where('empresa_id',2)->get();
            
            $linea10=CargarGasoil::Select('cargargasoil.litros as litros','cargargasoil.interno as interno','coches.nroempresa as nroempresa','gasoil.fecha as fecha')->join('gasoil','cargargasoil.gasoil_id','=','gasoil.id')->join('coches','cargargasoil.coche_id','=','coches.id')->whereBetween('fecha',[$fi, $ff])->where('coches.nroempresa',10)->get();
            $linea110=CargarGasoil::Select('cargargasoil.litros as litros','cargargasoil.interno as interno','coches.nroempresa as nroempresa','gasoil.fecha as fecha')->join('gasoil','cargargasoil.gasoil_id','=','gasoil.id')->join('coches','cargargasoil.coche_id','=','coches.id')->whereBetween('fecha',[$fi, $ff])->where('coches.nroempresa',110)->get();
            $linea142=CargarGasoil::Select('cargargasoil.litros as litros','cargargasoil.interno as interno','coches.nroempresa as nroempresa','gasoil.fecha as fecha')->join('gasoil','cargargasoil.gasoil_id','=','gasoil.id')->join('coches','cargargasoil.coche_id','=','coches.id')->whereBetween('fecha',[$fi, $ff])->where('coches.nroempresa',142)->get();

            $pdf=\PDF::loadView('bolmanantial.reportes.reportegasoildiarioleagas',['datos'=>$datos,'linea10'=>$linea10, 'linea110'=>$linea110,'linea142'=>$linea142,'fi'=>$fi, 'ff'=>$ff])
        ->setPaper('a4','landscape');
        return $pdf->download('reportegasoildiarioleagas.pdf');
        }
        
              
       
        

        }
//reporte de gasoil pedido por guillermo
        public function gasoil()
    {
        $empresa=Empresa::orderBy('denominacion','ASC')->pluck('denominacion','id');
        //$linea=Linea::orderBy('numero','ASC')->pluck('numero','id');
        return view('bolmanantial.reportes.gasoil')
         ->with('empresa',$empresa);
       
    }
    public function reportegasoil(Request $request)
    {   



function convertirFechaATexto($fecha) {

    $fecha_actual = strtotime($fecha);
    $dia_semana = date('l', $fecha_actual);
    $dia = date('d', $fecha_actual);
    $mes = date('F', $fecha_actual);
    $anio = date('Y', $fecha_actual);

    // Obtener el día de la semana en español
    $dias_semana = array(
        'Monday' => 'Lunes',
        'Tuesday' => 'Martes',
        'Wednesday' => 'Miércoles',
        'Thursday' => 'Jueves',
        'Friday' => 'Viernes',
        'Saturday' => 'Sábado',
        'Sunday' => 'Domingo'
    );
    $dia_semana_espanol = $dias_semana[$dia_semana];

    // Obtener el mes en español
    $meses = array(
        'January' => 'enero',
        'February' => 'febrero',
        'March' => 'marzo',
        'April' => 'abril',
        'May' => 'mayo',
        'June' => 'junio',
        'July' => 'julio',
        'August' => 'agosto',
        'September' => 'septiembre',
        'October' => 'octubre',
        'November' => 'noviembre',
        'December' => 'diciembre'
    );
    $mes_espanol = $meses[$mes];

    // Construir el texto de la fecha
    $texto_fecha = $dia_semana_espanol . ', ' . $dia . ' de ' . $mes_espanol . ' de ' . $anio;
    return $texto_fecha;
}



        /*VALIDACION -----------------------------------------*/
            $campos=[
            'fechai'=>'required',
            'fechaf'=>'required',
            'empresa_id'=>'required',
            
        ];
        $Mensaje=["required"=>'El :attribute es requerido'];
        $this->validate($request,$campos,$Mensaje);

        /*--------------------------------------------------------*/
          

        $fi = Carbon::parse($request->fechai)->format('Y-m-d').' 00:00:00';
        $ff = Carbon::parse($request->fechaf)->format('Y-m-d').' 23:59:59';


        //empresa LA NUEVA FOURNIER 118 121 122 131
        if($request->empresa_id==1){
            $empresa=$request->empresa_id;
        //LINEA118 
        $datos118=BoletoLeagas::select('boletosleagas.fecha','cochesboletos.id','lineas.empresa_id')->selectRaw('SUM(cochesboletos.cantpasajes) as pasajestotal')->selectRaw('SUM(gasoiltotal) as gasoiltotal')->selectRaw('count(DISTINCT boletosleagas.id) as ids')->selectRaw('count(DISTINCT cochesboletos.coche_id) as idcoches')->join('cochesboletos','boletosleagas.id','=','cochesboletos.boletosleagas_id')->join('lineas','boletosleagas.linea_id','=','lineas.id')->where('lineas.numero',118)->whereBetween('fecha',[$fi, $ff])->groupBy('boletosleagas.fecha')->orderby('boletosleagas.fecha')->get();
        $cantidad=count($datos118);
        $i=0;

        // para llenar el gasoil en la tabla 118

       $gasoil118=Gasoil::select('gasoil.l118total','gasoil.fecha')->where('empresa_id',1)->whereBetween('fecha',[$fi, $ff])->get(); 

       //dd($gasoil118);
       foreach($gasoil118 as $indice => $descripcion)
        {
            foreach($datos118 as $indice118 => $datos)
            {
                if($descripcion->fecha==$datos->fecha){
                    $datos->gasoiltotal=$descripcion->l118total;
                    if($datos->gasoiltotal==0 || $datos->gasoiltotal==null)
                    {

                        $datos->prompax=0;
                        $datos->promservicios=0;
                        $datos->promcoches=0;
                    }
                    else{
                        if($datos->pasajestotal==0)//CUANDO NO SE COBRO BOLETOS POR EJEMPLO ELECCIONES
                        {   $datos->prompax=0;
                        }
                        else
                        {
                            $datos->prompax=$datos->gasoiltotal/$datos->pasajestotal;
                        }
                    $datos->promservicios=$datos->gasoiltotal/$datos->ids;
                    $datos->promcoches=$datos->gasoiltotal/$datos->idcoches;    
                    }
                    

                }
            }
        }
        //////////////////// termina de poner el gasoil en la tabla
        if($cantidad==0){
            $datos118=0;
        }
        else
        {
            while($cantidad>$i){
                $datos118[$i]->fecha=convertirFechaATexto($datos118[$i]->fecha);
                $i=$i+1;
            }
        }
        $datos121=BoletoLeagas::select('boletosleagas.fecha','cochesboletos.id','lineas.empresa_id')->selectRaw('SUM(cochesboletos.cantpasajes) as pasajestotal')->selectRaw('SUM(gasoiltotal) as gasoiltotal')->selectRaw('count(DISTINCT boletosleagas.id) as ids')->selectRaw('count(DISTINCT cochesboletos.coche_id) as idcoches')->join('cochesboletos','boletosleagas.id','=','cochesboletos.boletosleagas_id')->join('lineas','boletosleagas.linea_id','=','lineas.id')->where('lineas.numero',121)->whereBetween('fecha',[$fi, $ff])->groupBy('boletosleagas.fecha')->orderby('boletosleagas.fecha')->get();
        $cantidad=count($datos121);
        $i=0;

        // para llenar el gasoil en la tabla

       $gasoil121=Gasoil::select('gasoil.l121total','gasoil.fecha')->where('empresa_id',1)->whereBetween('fecha',[$fi, $ff])->get(); 
       foreach($gasoil121 as $indice => $descripcion)
        {
            foreach($datos121 as $indice121 => $datos)
            {
                if($descripcion->fecha==$datos->fecha){
                    $datos->gasoiltotal=$descripcion->l121total;
                     if($datos->gasoiltotal==0 || $datos->gasoiltotal==null)
                    {

                        $datos->prompax=0;
                        $datos->promservicios=0;
                        $datos->promcoches=0;
                    }
                    else{
                    if($datos->pasajestotal==0)//CUANDO NO SE COBRO BOLETOS POR EJEMPLO ELECCIONES
                        {   $datos->prompax=0;
                        }
                        else
                        {
                            $datos->prompax=$datos->gasoiltotal/$datos->pasajestotal;
                        }
                    $datos->promservicios=$datos->gasoiltotal/$datos->ids;
                    $datos->promcoches=$datos->gasoiltotal/$datos->idcoches;    
                    }
                    

                }
            }
        }
        //////////////////// termina de poner el gasoil en la tabla
        if($cantidad==0){
            $datos121=0;
        }
        else
        {
            while($cantidad>$i){
                $datos121[$i]->fecha=convertirFechaATexto($datos121[$i]->fecha);
                $i=$i+1;
            }
        }
        $datos122=BoletoLeagas::select('boletosleagas.fecha','cochesboletos.id','lineas.empresa_id')->selectRaw('SUM(cochesboletos.cantpasajes) as pasajestotal')->selectRaw('SUM(gasoiltotal) as gasoiltotal')->selectRaw('count(DISTINCT boletosleagas.id) as ids')->selectRaw('count(DISTINCT cochesboletos.coche_id) as idcoches')->join('cochesboletos','boletosleagas.id','=','cochesboletos.boletosleagas_id')->join('lineas','boletosleagas.linea_id','=','lineas.id')->where('lineas.numero',122)->whereBetween('fecha',[$fi, $ff])->groupBy('boletosleagas.fecha')->orderby('boletosleagas.fecha')->get();

        $cantidad=count($datos122);
        $i=0;

         // para llenar el gasoil en la tabla

       $gasoil122=Gasoil::select('gasoil.l122total','gasoil.fecha')->where('empresa_id',1)->whereBetween('fecha',[$fi, $ff])->get(); 
       foreach($gasoil122 as $indice => $descripcion)
        {
            foreach($datos122 as $indice122 => $datos)
            {
                if($descripcion->fecha==$datos->fecha){
                    $datos->gasoiltotal=$descripcion->l122total;
                     if($datos->gasoiltotal==0 || $datos->gasoiltotal==null)
                    {

                        $datos->prompax=0;
                        $datos->promservicios=0;
                        $datos->promcoches=0;
                    }
                    else{
                    if($datos->pasajestotal==0)//CUANDO NO SE COBRO BOLETOS POR EJEMPLO ELECCIONES
                        {   $datos->prompax=0;
                        }
                        else
                        {
                            $datos->prompax=$datos->gasoiltotal/$datos->pasajestotal;
                        }
                    $datos->promservicios=$datos->gasoiltotal/$datos->ids;
                    $datos->promcoches=$datos->gasoiltotal/$datos->idcoches;    
                    }
                    

                }
            }
        }
        //////////////////// termina de poner el gasoil en la tabla

        if($cantidad==0){
            $datos122=0;
        }
        else
        {
            while($cantidad>$i){
                $datos122[$i]->fecha=convertirFechaATexto($datos122[$i]->fecha);
                $i=$i+1;
            }
        }
      /*  $datos131=BoletoLeagas::select('boletosleagas.fecha','cochesboletos.id','lineas.empresa_id')->selectRaw('SUM(pasajestotal) as pasajestotal')->selectRaw('SUM(gasoiltotal) as gasoiltotal')->selectRaw('count(DISTINCT boletosleagas.id) as ids')->selectRaw('count(DISTINCT cochesboletos.coche_id) as idcoches')->join('cochesboletos','boletosleagas.id','=','cochesboletos.boletosleagas_id')->join('lineas','boletosleagas.linea_id','=','lineas.id')->where('lineas.numero',131)->whereBetween('fecha',[$fi, $ff])->groupBy('boletosleagas.fecha')->orderby('boletosleagas.fecha')->get();*/

    $datos131=BoletoLeagas::select('boletosleagas.fecha','cochesboletos.id','lineas.empresa_id')->selectRaw('SUM(cochesboletos.cantpasajes) as pasajestotal')->selectRaw('SUM(gasoiltotal) as gasoiltotal')->selectRaw('count(DISTINCT boletosleagas.id) as ids')->selectRaw('count(DISTINCT cochesboletos.coche_id) as idcoches')->join('cochesboletos','boletosleagas.id','=','cochesboletos.boletosleagas_id')->join('lineas','boletosleagas.linea_id','=','lineas.id')->where('lineas.numero',131)->whereBetween('fecha',[$fi, $ff])->groupBy('boletosleagas.fecha')->orderby('boletosleagas.fecha')->get();

        $cantidad=count($datos131);
        $i=0;


         // para llenar el gasoil en la tabla 131

       $gasoil131=Gasoil::select('gasoil.l131total','gasoil.fecha')->where('empresa_id',1)->whereBetween('fecha',[$fi, $ff])->get(); 
       foreach($gasoil131 as $indice => $descripcion)
        {
            foreach($datos131 as $indice131 => $datos)
            {
                if($descripcion->fecha==$datos->fecha){
                    $datos->gasoiltotal=$descripcion->l131total;
                     if($datos->gasoiltotal==0 || $datos->gasoiltotal==null)
                    {

                        $datos->prompax=0;
                        $datos->promservicios=0;
                        $datos->promcoches=0;
                    }
                    else{
                    if($datos->pasajestotal==0)//CUANDO NO SE COBRO BOLETOS POR EJEMPLO ELECCIONES
                        {   $datos->prompax=0;
                        }
                        else
                        {
                            $datos->prompax=$datos->gasoiltotal/$datos->pasajestotal;
                        }
                    $datos->promservicios=$datos->gasoiltotal/$datos->ids;
                    $datos->promcoches=$datos->gasoiltotal/$datos->idcoches;    
                    }

                }
            }
        }
        //////////////////// termina de poner el gasoil en la tabla
        if($cantidad==0){
            $datos131=0;
        }
        else
        {
            while($cantidad>$i){
                $datos131[$i]->fecha=convertirFechaATexto($datos131[$i]->fecha);
                $i=$i+1;
            }
        }
       // dd($datos131);
        $pdf=\PDF::loadView('bolmanantial.reportes.reportegasoil',['empresa'=>$empresa,'datos118'=>$datos118, 'datos121'=>$datos121,'datos122'=>$datos122,'datos131'=>$datos131, 'fi'=>$fi, 'ff'=>$ff])
        ->setPaper('a4','portrait');
        return $pdf->download('reportegasoillnf.pdf');
        }
        else
        {
        //empresa LEAGAS 10 110 142
        $empresa=$request->empresa_id;

        $datos10=BoletoLeagas::select('boletosleagas.fecha','cochesboletos.id','lineas.empresa_id')->selectRaw('SUM(cochesboletos.cantpasajes) as pasajestotal')->selectRaw('SUM(gasoiltotal) as gasoiltotal')->selectRaw('count(DISTINCT boletosleagas.id) as ids')->selectRaw('count(DISTINCT cochesboletos.coche_id) as idcoches')->join('cochesboletos','boletosleagas.id','=','cochesboletos.boletosleagas_id')->join('lineas','boletosleagas.linea_id','=','lineas.id')->where('lineas.numero',10)->whereBetween('fecha',[$fi, $ff])->groupBy('boletosleagas.fecha')->orderby('boletosleagas.fecha')->get();
        $cantidad=count($datos10);
        $i=0;
 // para llenar el gasoil en la tabla 10
       $gasoil10=Gasoil::select('gasoil.l10total','gasoil.fecha')->where('empresa_id',2)->whereBetween('fecha',[$fi, $ff])->get(); 
       foreach($gasoil10 as $indice => $descripcion)
        {
            foreach($datos10 as $indice10 => $datos)
            {
                if($descripcion->fecha==$datos->fecha){
                    $datos->gasoiltotal=$descripcion->l10total;
                     if($datos->gasoiltotal==0 || $datos->gasoiltotal==null)
                    {

                        $datos->prompax=0;
                        $datos->promservicios=0;
                        $datos->promcoches=0;
                    }
                    else{
                    if($datos->pasajestotal==0)//CUANDO NO SE COBRO BOLETOS POR EJEMPLO ELECCIONES
                        {   $datos->prompax=0;
                        }
                        else
                        {
                            $datos->prompax=$datos->gasoiltotal/$datos->pasajestotal;
                        }
                    $datos->promservicios=$datos->gasoiltotal/$datos->ids;
                    $datos->promcoches=$datos->gasoiltotal/$datos->idcoches;    
                    }
                }
            }
        }
        
        //////////////////// termina de poner el gasoil en la tabla
         if($cantidad==0){
            $datos10=0;
        }
        else
        {
            while($cantidad>$i){
                $datos10[$i]->fecha=convertirFechaATexto($datos10[$i]->fecha);
                
                $i=$i+1;
            }
        }

        $datos110=BoletoLeagas::select('boletosleagas.fecha','cochesboletos.id','lineas.empresa_id')->selectRaw('SUM(cochesboletos.cantpasajes) as pasajestotal')->selectRaw('SUM(gasoiltotal) as gasoiltotal')->selectRaw('count(DISTINCT boletosleagas.id) as ids')->selectRaw('count(DISTINCT cochesboletos.coche_id) as idcoches')->join('cochesboletos','boletosleagas.id','=','cochesboletos.boletosleagas_id')->join('lineas','boletosleagas.linea_id','=','lineas.id')->where('lineas.numero',110)->whereBetween('fecha',[$fi, $ff])->groupBy('boletosleagas.fecha')->orderby('boletosleagas.fecha')->get();
        

        $cantidad=count($datos110);
        $i=0;

        // para llenar el gasoil en la tabla

       $gasoil110=Gasoil::select('gasoil.l110total','gasoil.fecha')->where('empresa_id',2)->whereBetween('fecha',[$fi, $ff])->get(); 
       foreach($gasoil110 as $indice => $descripcion)
        {
            foreach($datos110 as $indice110 => $datos)
            {
                if($descripcion->fecha==$datos->fecha){
                    $datos->gasoiltotal=$descripcion->l110total;
                     if($datos->gasoiltotal==0 || $datos->gasoiltotal==null)
                    {

                        $datos->prompax=0;
                        $datos->promservicios=0;
                        $datos->promcoches=0;
                    }
                    else{
                    if($datos->pasajestotal==0)//CUANDO NO SE COBRO BOLETOS POR EJEMPLO ELECCIONES
                        {   $datos->prompax=0;
                        }
                        else
                        {
                            $datos->prompax=$datos->gasoiltotal/$datos->pasajestotal;
                        }
                    $datos->promservicios=$datos->gasoiltotal/$datos->ids;
                    $datos->promcoches=$datos->gasoiltotal/$datos->idcoches;    
                    }
                }
            }
        }
        //////////////////// termina de poner el gasoil en la tabla
        if($cantidad==0){
            $datos110=0;
        }
        else
        {

            while($cantidad>$i){
                $datos110[$i]->fecha=convertirFechaATexto($datos110[$i]->fecha);
                $i=$i+1;
            }
        }
                //dd($datos110);
        $datos142=BoletoLeagas::select('boletosleagas.fecha','cochesboletos.id','lineas.empresa_id')->selectRaw('SUM(recaudaciontotal) as recaudaciontotal')->selectRaw('SUM(cochesboletos.cantpasajes) as pasajestotal')->selectRaw('SUM(gasoiltotal) as gasoiltotal')->selectRaw('count(DISTINCT boletosleagas.id) as ids')->selectRaw('count(DISTINCT cochesboletos.coche_id) as idcoches')->join('cochesboletos','boletosleagas.id','=','cochesboletos.boletosleagas_id')->join('lineas','boletosleagas.linea_id','=','lineas.id')->where('lineas.numero',142)->whereBetween('fecha',[$fi, $ff])->groupBy('boletosleagas.fecha')->orderby('boletosleagas.fecha')->get();
        $cantidad=count($datos142);
        $i=0;

        // para llenar el gasoil en la tabla 142
       $gasoil142=Gasoil::select('gasoil.l142total','gasoil.fecha')->where('empresa_id',2)->whereBetween('fecha',[$fi, $ff])->get(); 
       foreach($gasoil142 as $indice => $descripcion)
        {
            foreach($datos142 as $indice142 => $datos)
            {
                if($descripcion->fecha==$datos->fecha){
                    $datos->gasoiltotal=$descripcion->l142total;
                     if($datos->gasoiltotal==0 || $datos->gasoiltotal==null)
                    {

                        $datos->prompax=0;
                        $datos->promservicios=0;
                        $datos->promcoches=0;
                    }
                    else{
                    if($datos->pasajestotal==0)//CUANDO NO SE COBRO BOLETOS POR EJEMPLO ELECCIONES
                        {   $datos->prompax=0;
                        }
                        else
                        {
                            $datos->prompax=$datos->gasoiltotal/$datos->pasajestotal;
                        }
                    $datos->promservicios=$datos->gasoiltotal/$datos->ids;
                    $datos->promcoches=$datos->gasoiltotal/$datos->idcoches;    
                    }

                }
            }
        }
        //////////////////// termina de poner el gasoil en la tabla


        if($cantidad==0){
            $datos142=0;
        }
        else
        {
            while($cantidad>$i){
                $datos142[$i]->fecha=convertirFechaATexto($datos142[$i]->fecha);
                $i=$i+1;
            }
        }
        $pdf=\PDF::loadView('bolmanantial.reportes.reportegasoil',['empresa'=>$empresa,'datos10'=>$datos10, 'datos110'=>$datos110,'datos142'=>$datos142,'fi'=>$fi, 'ff'=>$ff])
        ->setPaper('a4','portrait');
        return $pdf->download('reportegasoilleagas.pdf');
        }

        $chofer=ChoferLeagaslnf::orderBy('nombre','ASC')->get();
        $pdf=\PDF::loadView('bolmanantial.reportes.reportegasoil',['empresa'=>$empresa,'datos'=>$datos, 'chofer'=>$chofer, 'fi'=>$fi, 'ff'=>$ff])
        ->setPaper('a4','landscape');
        return $pdf->download('reporteboletosleagas.pdf');       
    }
 

    

//-------------------------------------------
public function asistencia()
    {
        $empresa=Empresa::orderBy('denominacion','ASC')->pluck('denominacion','id');
        return view('bolmanantial.reportes.asistencia')
            ->with('empresa',$empresa);
    }


    public function reporteasistencia(Request $request)
    {   

function convertirFechaATextoDia($fecha) {
    //dd($fecha);
    $fecha_actual = strtotime($fecha);
    $dia_semana = date('l', $fecha_actual);
    $dia = date('d', $fecha_actual);
    $mes = date('F', $fecha_actual);
    $anio = date('Y', $fecha_actual);

    // Obtener el día de la semana en español
    $dias_semana = array(
        'Monday' => 'Lunes',
        'Tuesday' => 'Martes',
        'Wednesday' => 'Miércoles',
        'Thursday' => 'Jueves',
        'Friday' => 'Viernes',
        'Saturday' => 'Sábado',
        'Sunday' => 'Domingo'
    );
    $dia_semana_espanol = $dias_semana[$dia_semana];

    // Obtener el mes en español
    $meses = array(
        'January' => 'enero',
        'February' => 'febrero',
        'March' => 'marzo',
        'April' => 'abril',
        'May' => 'mayo',
        'June' => 'junio',
        'July' => 'julio',
        'August' => 'agosto',
        'September' => 'septiembre',
        'October' => 'octubre',
        'November' => 'noviembre',
        'December' => 'diciembre'
    );
    $mes_espanol = $meses[$mes];

    // Construir el texto de la fecha
    $texto_fecha = $dia_semana_espanol;
    return $texto_fecha;
}

        /*VALIDACION -----------------------------------------*/
            $campos=[
            'fechai'=>'required',
            'fechaf'=>'required',
            'empresa_id'=>'required',
            
        ];
        $Mensaje=["required"=>'El :attribute es requerido'];
        $this->validate($request,$campos,$Mensaje);

        /*--------------------------------------------------------*/
          

        $fi = Carbon::parse($request->fechai)->format('Y-m-d').' 00:00:00';
        $ff = Carbon::parse($request->fechaf)->format('Y-m-d').' 23:59:59';

        $empresa=$request->empresa_id;
        $datos=BoletoLeagas::select('choferesleagaslnf.apellido','choferesleagaslnf.nombre','choferesleagaslnf.legajo','boletosleagas.fecha','boletosleagas.chofer_id')->join('choferesleagaslnf','boletosleagas.chofer_id','=','choferesleagaslnf.id')->where('empresa_id',$request->empresa_id)->whereBetween('fecha',[$fi, $ff])->groupBy('boletosleagas.chofer_id','boletosleagas.fecha')->orderby('boletosleagas.fecha')->get();
        $cantidad=count($datos);
        $i=0;
        if($cantidad==0){
            $datos=0;
        }
        else
        {
            while($cantidad>$i){
                $fecha=$datos[$i]->fecha;
                //$datos[$i]->fechaconvertida=convertirFechaATexto($fecha);
                $datos[$i]->fechadia=convertirFechaATextoDia($fecha);
                
                $i=$i+1;
            }
        }

        //dd($datos);
         $pdf=\PDF::loadView('bolmanantial.reportes.reporteasistencia',['empresa'=>$empresa,'datos'=>$datos,'fi'=>$fi, 'ff'=>$ff])
        ->setPaper('a4','portrait');
        return $pdf->download('reporteasistencia.pdf');

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

public function buscarkms(Request $request)
    {

        $datos=ServicioLeagasLnf::where('id',$request->servicio)->get();
        if($request->dia=='kmsemana'){
            $kms=$datos[0]->kmsemana;
        }
        else
        {
            if($request->dia=='kmsabado'){
                $kms=$datos[0]->kmsabado;
            }else{
                if($request->dia=='kmdomingo'){
                    $kms=$datos[0]->kmdomingo;;
                }
                else{
                    $kms=0;
                }
                
            }
        }
        
        return $kms;
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
            'kmsemana'=>'required|integer',
            'kmsabado'=>'required|integer',
            'kmdomingo'=>'required|integer',
            ];

        $Mensaje=["required"=>'El :attribute es requerido'];
        $this->validate($request,$campos,$Mensaje);
        
        
            $datos=new ServicioLeagasLnf(request()->except('_token'));
            $datos->linea_id=$request->linea;
            $datos->empresa_id=$request->empresa;
            $datos->turno_id=$request->turno;
            $datos->ramal_id=$request->ramal;
            $datos->kmsemana=$request->kmsemana;
            $datos->kmsabado=$request->kmsabado;
            $datos->kmdomingo=$request->kmdomingo;

            $datos->save();
               

        Flash::success('Se creo el servicio!!!!');
       
       return Redirect('bolmanantial/boletos/servicios')->with('Mensaje','Se creo el servicio!!!!');
    }

     public function editarservicio($id)
    {
        $servicios=ServicioLeagasLnf::find($id);
        $turno=Turno::orderBy('nombre','ASC')->pluck('nombre','id');
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
        //dd($request);
        $campos=[
            'numero'=>'required|integer',
            'turno_id'=>'required',
            'empresa_id'=>'required',
            'ramal_id'=>'required',
            'linea_id'=>'required',
            'kmsemana'=>'required|integer',
            'kmsabado'=>'required|integer',
            'kmdomingo'=>'required|integer'


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
        $datos->each(function($datos){
             $datos->linea;
        });
        return view('bolmanantial.boletos.ramal')
            ->with('datos',$datos);
    }


public function createramal()
    {
        $linea=Linea::orderBy('numero','ASC')->get();
        return view('bolmanantial.boletos.createramal')
            ->with('linea',$linea);
               
    }

public function storeramal(Request $request)
    {
    //    dd($request);

        /*VALIDACION -----------------------------------------*/
        $campos=[
            'nombre'=>'required|string|max:50',
            'linea_id'=>'required',
            ];

        $Mensaje=["required"=>'El :attribute es requerido'];
        $this->validate($request,$campos,$Mensaje);
        
        
            $datos=new Ramal(request()->except('_token'));

            $datos->save();
               

        Flash::success('Se creo el Ramal!!!!');
       
       return Redirect('bolmanantial/boletos/ramal
        ')->with('Mensaje','Se creo el Ramal!!!!');
    }
public function gasoilleagas()
{

      $datos=Gasoil::select('*')->join('users','gasoil.user_id','=','users.id')->where('gasoil.empresa_id',2)->get();
//dd($datos);
            return view('bolmanantial.gasoil.indexleagas')
                ->with('datos',$datos);
}
public function gasoillnf()
{

      $datos=Gasoil::select('*')->join('users','gasoil.user_id','=','users.id')->where('gasoil.empresa_id',1)->get();

            return view('bolmanantial.gasoil.indexlnf')
                ->with('datos',$datos);
}

     public function cargargasoilleagas()
    {



    $linea10=Coche::where('nroempresa',10)->orderby('interno')->get();
    $linea142=Coche::where('nroempresa',142)->orderby('interno')->get();
    $linea110=Coche::where('nroempresa',110)->orderby('interno')->get();
    //$linea118=Coche::where('nroempresa',118)->orderby('interno')->get();

    return view('bolmanantial.boletos.cargargasoilleagas')
            ->with('linea10',$linea10)
            ->with('linea142',$linea142)
            ->with('linea110',$linea110);
      //      ->with('linea118',$linea118);
    
    }
     public function cargargasoillnf()
    {

    $linea118=Coche::where('nroempresa',118)->orderby('interno')->get();
    $linea121=Coche::where('nroempresa',121)->orderby('interno')->get();
    $linea122=Coche::where('nroempresa',122)->orderby('interno')->get();
    $linea131=Coche::where('nroempresa',131)->orderby('interno')->get();
    //$linea118=Coche::where('nroempresa',118)->orderby('interno')->get();

    return view('bolmanantial.boletos.cargargasoillnf')
            ->with('linea118',$linea118)
            ->with('linea121',$linea121)
            ->with('linea122',$linea122)
            ->with('linea131',$linea131);
    
    }
   public function guardarcargagasoillnf(Request $request)
    {


  
/* calculos de totales de carga de litros por lineas */
//------------------------------------------------------
    $cantidad118=count($request->linea118);
    $linea118=Coche::where('nroempresa','118')->orderby('interno')->get();
    $total118=0;
    for($i=0;$i<$cantidad118;$i++){
        $total118=$total118+$request->linea118[$linea118[$i]->interno];
     }

    $cantidad121=count($request->linea121);
    $linea121=Coche::where('nroempresa','121')->orderby('interno')->get();
    $total121=0;
    for($i=0;$i<$cantidad121;$i++){
        $total121=$total121+$request->linea121[$linea121[$i]->interno];
     }

    $cantidad122=count($request->linea122);
    $linea122=Coche::where('nroempresa','122')->orderby('interno')->get();
    $total122=0;
    for($i=0;$i<$cantidad122;$i++){
        $total122=$total122+$request->linea122[$linea122[$i]->interno];
     }

   $cantidad131=count($request->linea131);
    $linea131=Coche::where('nroempresa','131')->orderby('interno')->get();
    $total131=0;
    for($i=0;$i<$cantidad131;$i++){
        $total131=$total131+$request->linea131[$linea131[$i]->interno];
     }

     $total=$total118+$total121+$total122+$total131;
//-------------------------------------------------------------------------
//---- FIN DE CALCULO DE TOTAL DE CARGA DE GASOIL X LINEAS ----------------


//---- carga de tabla de gasoil
    $datos=new Gasoil(request()->except('_token'));
    $datos->t1diferencia=$request->t1apertura-$request->t1cierre;
    $datos->t2diferencia=$request->t2apertura-$request->t2cierre;
    $datos->t1saldo=$request->t1nivel-$request->t1consumo;
    $datos->t2saldo=$request->t2nivel-$request->t2consumo;
    $datos->l118total=$total118;
    $datos->l121total=$total121;
    $datos->l122total=$total122;
    $datos->l131total=$total131;
    //$datos->l118total=$total118;
    $datos->empresa_id=1;
    $datos->save();
//-----------------------------------------------------------------------------------

$gasoil=Gasoil::orderBy('id','DESC')->limit(1)->get();

// carga en la tabla cargargasoil de cada interno x linea
      for($i=0;$i<$cantidad118;$i++){
        if($request->linea118[$linea118[$i]->interno]<>null){
            $datos=new CargarGasoil();
            $datos->litros=$request->linea118[$linea118[$i]->interno];    
            $datos->interno=$linea118[$i]->interno;    
            $datos->coche_id=$linea118[$i]->id;    
            $datos->gasoil_id=$gasoil[0]->id;  
            $datos->save();
            
            }
        }
        
        for($i=0;$i<$cantidad121;$i++){
        if($request->linea121[$linea121[$i]->interno]<>null){
            $datos=new CargarGasoil();
            $datos->litros=$request->linea121[$linea121[$i]->interno];    
            $datos->interno=$linea121[$i]->interno;    
            $datos->coche_id=$linea121[$i]->id;    
            $datos->gasoil_id=$gasoil[0]->id;   
            $datos->save();
            
            }
        }
         for($i=0;$i<$cantidad122;$i++){
        if($request->linea122[$linea122[$i]->interno]<>null){
            $datos=new CargarGasoil();
            $datos->litros=$request->linea122[$linea122[$i]->interno];    
            $datos->interno=$linea122[$i]->interno;    
            $datos->coche_id=$linea122[$i]->id;    
            $datos->gasoil_id=$gasoil[0]->id;   
            $datos->save();
            
            }
        }
         for($i=0;$i<$cantidad131;$i++){
        if($request->linea131[$linea131[$i]->interno]<>null){
            $datos=new CargarGasoil();
            $datos->litros=$request->linea131[$linea131[$i]->interno];    
            $datos->interno=$linea131[$i]->interno;    
            $datos->coche_id=$linea131[$i]->id;    
            $datos->gasoil_id=$gasoil[0]->id;   
            $datos->save();
            
            }
        }
//--------------------------------------------------------
// FIN carga en la tabla cargargasoil de cada interno x linea
        

Flash::success('SE CARGO UNA NUEVA PLANILLA DE GASOIL LA NUEVA FOURNIER!!!!');
       return Redirect('bolmanantial/boletos/cargargasoillnf')->with('Mensaje','SE CARGO UNA NUEVA PLANILLA DE GASOIL LA NUEVA FOURNIER!!!!');
    }
    public function guardarcargagasoilleagas(Request $request)
    {


  
/* calculos de totales de carga de litros por lineas */
//------------------------------------------------------
    $cantidad10=count($request->linea10);
    $linea10=Coche::where('nroempresa','10')->orderby('interno')->get();
    $total10=0;
    for($i=0;$i<$cantidad10;$i++){
        $total10=$total10+$request->linea10[$linea10[$i]->interno];
     }

    $cantidad142=count($request->linea142);
    $linea142=Coche::where('nroempresa','142')->orderby('interno')->get();
    $total142=0;
    for($i=0;$i<$cantidad142;$i++){
        $total142=$total142+$request->linea142[$linea142[$i]->interno];
     }

    $cantidad110=count($request->linea110);
    $linea110=Coche::where('nroempresa','110')->orderby('interno')->get();
    $total110=0;
    for($i=0;$i<$cantidad110;$i++){
        $total110=$total110+$request->linea110[$linea110[$i]->interno];
     }

   /* $cantidad118=count($request->linea118);
    $linea118=Coche::where('nroempresa','118')->orderby('interno')->get();
    $total118=0;
    for($i=0;$i<$cantidad118;$i++){
        $total118=$total118+$request->linea118[$linea118[$i]->interno];
     }*/

     $total=$total10+$total110+$total142;
//-------------------------------------------------------------------------
//---- FIN DE CALCULO DE TOTAL DE CARGA DE GASOIL X LINEAS ----------------


//---- carga de tabla de gasoil
    $datos=new Gasoil(request()->except('_token'));
    $datos->t1diferencia=$request->t1apertura-$request->t1cierre;
    $datos->t2diferencia=$request->t2apertura-$request->t2cierre;
    $datos->t1saldo=$request->t1nivel-$request->t1consumo;
    $datos->t2saldo=$request->t2nivel-$request->t2consumo;
    $datos->l10total=$total10;
    $datos->l142total=$total142;
    $datos->l110total=$total110;
    //$datos->l118total=$total118;
    $datos->empresa_id=2;
    $datos->save();
//-----------------------------------------------------------------------------------

$gasoil=Gasoil::orderBy('id','DESC')->limit(1)->get();

// carga en la tabla cargargasoil de cada interno x linea
      for($i=0;$i<$cantidad10;$i++){
        if($request->linea10[$linea10[$i]->interno]<>null){
            $datos=new CargarGasoil();
            $datos->litros=$request->linea10[$linea10[$i]->interno];    
            $datos->interno=$linea10[$i]->interno;    
            $datos->coche_id=$linea10[$i]->id;    
            $datos->gasoil_id=$gasoil[0]->id;  
            $datos->save();
            
            }
        }
        
        for($i=0;$i<$cantidad142;$i++){
        if($request->linea142[$linea142[$i]->interno]<>null){
            $datos=new CargarGasoil();
            $datos->litros=$request->linea142[$linea142[$i]->interno];    
            $datos->interno=$linea142[$i]->interno;    
            $datos->coche_id=$linea142[$i]->id;    
            $datos->gasoil_id=$gasoil[0]->id;   
            $datos->save();
            
            }
        }
         for($i=0;$i<$cantidad110;$i++){
        if($request->linea110[$linea110[$i]->interno]<>null){
            $datos=new CargarGasoil();
            $datos->litros=$request->linea110[$linea110[$i]->interno];    
            $datos->interno=$linea110[$i]->interno;    
            $datos->coche_id=$linea110[$i]->id;    
            $datos->gasoil_id=$gasoil[0]->id;   
            $datos->save();
            
            }
        }
       /*  for($i=0;$i<$cantidad118;$i++){
        if($request->linea118[$linea118[$i]->interno]<>null){
            $datos=new CargarGasoil();
            $datos->litros=$request->linea118[$linea118[$i]->interno];    
            $datos->interno=$linea118[$i]->interno;    
            $datos->coche_id=$linea118[$i]->id;    
            $datos->gasoil_id=$gasoil[0]->id;   
            $datos->save();
            
            }
        }*/
//--------------------------------------------------------
// FIN carga en la tabla cargargasoil de cada interno x linea
        

Flash::success('SE CARGO UNA NUEVA PLANILLA DE GASOIL LEAGAS!!!!');
       return Redirect('bolmanantial/boletos/cargargasoilleagas')->with('Mensaje','Mensaje','SE CARGO UNA NUEVA PLANILLA DE GASOIL LEAGAS!!!!');
    }
    public function cambiocoche($id)
    {
        
        $servicios=BoletoLeagas::find($id);
        $coches=Coche::find($servicios->coche_id);
        $nroempresa=$coches->nroempresa;
        $coche=Coche::orderBy('interno','ASC')->where('empresa_id','1')->where('nroempresa',$nroempresa)->get();
        return view('bolmanantial.boletos.cambiocoche')
            ->with('servicios',$servicios)
            ->with('coche',$coche)
            ->with('id',$id);
    }
    public function guardarcambiocoche(Request $request)
    {

        $campos=[
            'coche_id_cambio'=>'required|integer',
            'motivo_cambio'=>'required|string|max:150',
        ];
        $Mensaje=["required"=>'El :attribute es requerido'];
        $this->validate($request,$campos,$Mensaje);
       
      $editalservicio=BoletoLeagas::where('id',$request->id)
                ->update([
                          'coche_id_cambio'=>$request->coche_id_cambio,
                          'motivo_cambio'=>$request->motivo_cambio
                          ]);
 
       return Redirect('bolmanantial/boletosleagas')->with('Mensaje','Se modifico el servicio!!!!');
    }

public function reportechoferesleagas()
    {
        $datos=ChoferLeagaslnf::where('empresa_id',2)->orderBy('apellido')->get();

        $datos->each(function($datos){
            $datos->tipocontratacion;
            $datos->obrasocial;
            $datos->categoriachofer; 
            
       });

        //dd($datos);
        $pdf=\PDF::loadView('bolmanantial.reportes.reportechoferes',['empresa'=>2,'datos'=>$datos])
        ->setPaper('a4','landscape');
        return $pdf->download('reportechoferes.pdf');
    }

    public function reportechofereslnf()
    {
         $datos=ChoferLeagaslnf::where('empresa_id',1)->orderBy('apellido')->get();

        $datos->each(function($datos){
            $datos->tipocontratacion;
            $datos->obrasocial;
            $datos->categoriachofer; 
            
       });

        //dd($datos);
        $pdf=\PDF::loadView('bolmanantial.reportes.reportechoferes',['empresa'=>1,'datos'=>$datos])
        ->setPaper('a4','landscape');
        return $pdf->download('reportechoferes.pdf');
    }
    public function monitoreo()
    {
$options = [
        'ip' => '192.168.101.212',
        'port' => 162,
        'transport' => 'udp',
        'version' => null,
        'community' => null,
        'whitelist' => null,
        'timeout_connect' => 5,
    ];

$listener = new TrapListener(); ### your in step 1 created listener-class

$server = new SnmpTrapServer();
$server->prepare($listener, $options); # $options only needed if other than default
$server->listen();

# in addition: (only if needed)
$server->getOptions(); # to get the options
$server->setOptions($options); # to set the options
    }
 

}

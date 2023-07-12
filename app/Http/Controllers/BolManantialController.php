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


class BolManantialController extends Controller
{
 public function index(Request $request)
    {
 
        $datos=BoletoLeagas::select('*','choferesleagaslnf.nombre as nombrechofer','boletosleagas.id as id_boleto')->join('serviciosleagaslnf','boletosleagas.servicio_id','=','serviciosleagaslnf.id')->join('choferesleagaslnf','boletosleagas.chofer_id','=','choferesleagaslnf.id')->join('turnos','serviciosleagaslnf.turno_id','=','turnos.id')->where('serviciosleagaslnf.empresa_id',2)->get();
        $datos->each(function($datos){
             $datos->linea;
             $datos->choferleagaslnf;
             $datos->servicioleagaslnf;

        });

        return view('bolmanantial.boletos.index')
            ->with('datos',$datos);
    }

    public function indexlnf(Request $request)
    {
 
        $datos=BoletoLeagas::select('*','choferesleagaslnf.nombre as nombrechofer','boletosleagas.id as id_boleto')->join('serviciosleagaslnf','boletosleagas.servicio_id','=','serviciosleagaslnf.id')->join('choferesleagaslnf','boletosleagas.chofer_id','=','choferesleagaslnf.id')->join('turnos','serviciosleagaslnf.turno_id','=','turnos.id')->where('serviciosleagaslnf.empresa_id',1)->get();
        $datos->each(function($datos){
             $datos->linea;
             $datos->choferleagaslnf;
             $datos->servicioleagaslnf;

        });

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
              $fecha=null;

        return view('bolmanantial.boletos.create')
               ->with('linea',$linea)
                ->with('fecha',$fecha)
               ->with('choferleagaslnf',$choferleagaslnf)
               ->with('servicioleagaslnf',$servicioleagaslnf)
               ->with('empresa',2)
               ->with('coche',$coche);
    }
     public function createlnf()
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
       
       $fecha=null;

        return view('bolmanantial.boletos.create')
               ->with('linea',$linea)
               ->with('fecha',$fecha)
               ->with('choferleagaslnf',$choferleagaslnf)
               ->with('servicioleagaslnf',$servicioleagaslnf)
                ->with('empresa',1)
               ->with('coche',$coche);
    }
    public function store(Request $request)
     {

 

  /*      VALIDACION -----------------------------------------*/
            $campos=[
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
        $Mensaje=["required"=>'El :attribute es requerido'];
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

        $datos->valorhorasrestantes=0;
        $datos->valortoquesanden=$request->toquesanden*117;
        
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
        $linea=Linea::orderBy('numero','ASC')->pluck('numero','id');
        return view('bolmanantial.reportes.boletoleagas')
        ->with('linea',$linea)
         ->with('empresa',$empresa);
       
    }
    public function reporteboletosleagas(Request $request)
    {   

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
      
      if($request->linea_id == NULL){

       $datos=BoletoLeagas::select('boletosleagas.chofer_id','choferesleagaslnf.apellido','choferesleagaslnf.nombre')->selectRaw('SEC_TO_TIME(SUM(TIME_TO_SEC(horastotal))) as horastotal')->selectRaw('SEC_TO_TIME(SUM(TIME_TO_SEC(horassobrantes))) as horassobrantes')->selectRaw('SEC_TO_TIME(SUM(TIME_TO_SEC(horastotalalargue))) as horastotalalargue')->selectRaw('SUM(pasajestotal) as pasajes')->selectRaw('SUM(recaudaciontotal) as recaudacion')->selectRaw('SUM(toquesanden) as toquesanden')->selectRaw('SUM(valortoquesanden) as valortoquesanden')->selectRaw('SUM(gasoiltotal) as gasoil')->selectRaw('SUM(normal) as normal')->selectRaw('SUM(doblenegro) as doblenegro')->selectRaw('count(*) as cantidaddeservicios')->join('choferesleagaslnf','boletosleagas.chofer_id','=','choferesleagaslnf.id')->where('empresa_id',$request->empresa_id)->whereBetween('fecha',[$fi, $ff])->groupBy('chofer_id')->orderby('choferesleagaslnf.apellido')->get();
   }
   else{


           $datos=BoletoLeagas::select('boletosleagas.chofer_id','choferesleagaslnf.apellido','choferesleagaslnf.nombre')->selectRaw('SEC_TO_TIME(SUM(TIME_TO_SEC(horastotal))) as horastotal')->selectRaw('SEC_TO_TIME(SUM(TIME_TO_SEC(horassobrantes))) as horassobrantes')->selectRaw('SEC_TO_TIME(SUM(TIME_TO_SEC(horastotalalargue))) as horastotalalargue')->selectRaw('SUM(pasajestotal) as pasajes')->selectRaw('SUM(recaudaciontotal) as recaudacion')->selectRaw('SUM(normal) as normal')->selectRaw('SUM(doblenegro) as doblenegro')->selectRaw('SUM(toquesanden) as toquesanden')->selectRaw('SUM(valortoquesanden) as valortoquesanden')->selectRaw('SUM(gasoiltotal) as gasoil')->selectRaw('count(*) as cantidaddeservicios')->join('choferesleagaslnf','boletosleagas.chofer_id','=','choferesleagaslnf.id')->where('empresa_id',$request->empresa_id)->where('linea_id',$request->linea_id)->whereBetween('fecha',[$fi, $ff])->groupBy('chofer_id')->orderby('choferesleagaslnf.apellido')->get();
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
    $texto_fecha = $dia_semana_espanol . ', ' . $dia . ' de ' . $mes_espanol . ' de ' . $anio;
    return $texto_fecha;
}

// Ejemplo de uso
//$fecha = '2023-06-20';
//$texto_fecha = convertirFechaATexto($fecha);
//echo $texto_fecha;




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
        $datos118=BoletoLeagas::select('boletosleagas.fecha','cochesboletos.id','lineas.empresa_id')->selectRaw('SUM(pasajestotal) as pasajestotal')->selectRaw('SUM(gasoiltotal) as gasoiltotal')->selectRaw('count(DISTINCT boletosleagas.id) as ids')->selectRaw('count(DISTINCT cochesboletos.coche_id) as idcoches')->join('cochesboletos','boletosleagas.id','=','cochesboletos.boletosleagas_id')->join('lineas','boletosleagas.linea_id','=','lineas.id')->where('lineas.numero',118)->whereBetween('fecha',[$fi, $ff])->groupBy('boletosleagas.fecha')->orderby('boletosleagas.fecha')->get();
        //dd($datos118[0]->fecha);
        $cantidad=count($datos118);
        $i=0;
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
        $datos121=BoletoLeagas::select('boletosleagas.fecha','cochesboletos.id','lineas.empresa_id')->selectRaw('SUM(pasajestotal) as pasajestotal')->selectRaw('SUM(gasoiltotal) as gasoiltotal')->selectRaw('count(DISTINCT boletosleagas.id) as ids')->selectRaw('count(DISTINCT cochesboletos.coche_id) as idcoches')->join('cochesboletos','boletosleagas.id','=','cochesboletos.boletosleagas_id')->join('lineas','boletosleagas.linea_id','=','lineas.id')->where('lineas.numero',121)->whereBetween('fecha',[$fi, $ff])->groupBy('boletosleagas.fecha')->orderby('boletosleagas.fecha')->get();
        $cantidad=count($datos121);
        $i=0;
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
        $datos122=BoletoLeagas::select('boletosleagas.fecha','cochesboletos.id','lineas.empresa_id')->selectRaw('SUM(pasajestotal) as pasajestotal')->selectRaw('SUM(gasoiltotal) as gasoiltotal')->selectRaw('count(DISTINCT boletosleagas.id) as ids')->selectRaw('count(DISTINCT cochesboletos.coche_id) as idcoches')->join('cochesboletos','boletosleagas.id','=','cochesboletos.boletosleagas_id')->join('lineas','boletosleagas.linea_id','=','lineas.id')->where('lineas.numero',122)->whereBetween('fecha',[$fi, $ff])->groupBy('boletosleagas.fecha')->orderby('boletosleagas.fecha')->get();

        $cantidad=count($datos122);
        $i=0;
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
        $datos131=BoletoLeagas::select('boletosleagas.fecha','cochesboletos.id','lineas.empresa_id')->selectRaw('SUM(pasajestotal) as pasajestotal')->selectRaw('SUM(gasoiltotal) as gasoiltotal')->selectRaw('count(DISTINCT boletosleagas.id) as ids')->selectRaw('count(DISTINCT cochesboletos.coche_id) as idcoches')->join('cochesboletos','boletosleagas.id','=','cochesboletos.boletosleagas_id')->join('lineas','boletosleagas.linea_id','=','lineas.id')->where('lineas.numero',131)->whereBetween('fecha',[$fi, $ff])->groupBy('boletosleagas.fecha')->orderby('boletosleagas.fecha')->get();

        $cantidad=count($datos131);
        $i=0;
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
        //dd($datos131);
        $pdf=\PDF::loadView('bolmanantial.reportes.reportegasoil',['empresa'=>$empresa,'datos118'=>$datos118, 'datos121'=>$datos121,'datos122'=>$datos122,'datos131'=>$datos131, 'fi'=>$fi, 'ff'=>$ff])
        ->setPaper('a4','portrait');
        return $pdf->download('reportegasoillnf.pdf');
        }
        else
        {
        //empresa LEAGAS 10 110 142
        $empresa=$request->empresa_id;
        $datos10=BoletoLeagas::select('boletosleagas.fecha','cochesboletos.id','lineas.empresa_id')->selectRaw('SUM(pasajestotal) as pasajestotal')->selectRaw('SUM(gasoiltotal) as gasoiltotal')->selectRaw('count(DISTINCT boletosleagas.id) as ids')->selectRaw('count(DISTINCT cochesboletos.coche_id) as idcoches')->join('cochesboletos','boletosleagas.id','=','cochesboletos.boletosleagas_id')->join('lineas','boletosleagas.linea_id','=','lineas.id')->where('lineas.numero',10)->whereBetween('fecha',[$fi, $ff])->groupBy('boletosleagas.fecha')->orderby('boletosleagas.fecha')->get();
        $cantidad=count($datos10);
        $i=0;

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
        //dd($datos10);
        $datos110=BoletoLeagas::select('boletosleagas.fecha','cochesboletos.id','lineas.empresa_id')->selectRaw('SUM(pasajestotal) as pasajestotal')->selectRaw('SUM(gasoiltotal) as gasoiltotal')->selectRaw('count(DISTINCT boletosleagas.id) as ids')->selectRaw('count(DISTINCT cochesboletos.coche_id) as idcoches')->join('cochesboletos','boletosleagas.id','=','cochesboletos.boletosleagas_id')->join('lineas','boletosleagas.linea_id','=','lineas.id')->where('lineas.numero',110)->whereBetween('fecha',[$fi, $ff])->groupBy('boletosleagas.fecha')->orderby('boletosleagas.fecha')->get();
        $cantidad=count($datos110);
        $i=0;
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
        $datos142=BoletoLeagas::select('boletosleagas.fecha','cochesboletos.id','lineas.empresa_id')->selectRaw('SUM(recaudaciontotal) as recaudaciontotal')->selectRaw('SUM(pasajestotal) as pasajestotal')->selectRaw('SUM(gasoiltotal) as gasoiltotal')->selectRaw('count(DISTINCT boletosleagas.id) as ids')->selectRaw('count(DISTINCT cochesboletos.coche_id) as idcoches')->join('cochesboletos','boletosleagas.id','=','cochesboletos.boletosleagas_id')->join('lineas','boletosleagas.linea_id','=','lineas.id')->where('lineas.numero',142)->whereBetween('fecha',[$fi, $ff])->groupBy('boletosleagas.fecha')->orderby('boletosleagas.fecha')->get();
        $cantidad=count($datos142);
        $i=0;
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
//dd($request);
function convertirFechaATexto($fecha) {
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
                $datos[$i]->fecha=convertirFechaATexto($datos[$i]->fecha);
                $i=$i+1;
            }
        }
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

     public function cargargasoil()
    {

    $linea10=Coche::where('nroempresa',10)->get();
    $linea142=Coche::where('nroempresa',142)->get();
    $linea110=Coche::where('nroempresa',110)->get();
    $linea118=Coche::where('nroempresa',118)->get();

    return view('bolmanantial.boletos.cargargasoil')
            ->with('linea10',$linea10)
            ->with('linea142',$linea142)
            ->with('linea110',$linea110)
            ->with('linea118',$linea118);
    
    }

    public function guardarcargagasoil(Request $request)
    {

       dd($request);
       
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
    
}

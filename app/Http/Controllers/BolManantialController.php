<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BoletoLeagas;
use App\ChoferLeagasLnf;
use App\ServicioLeagasLnf;
use App\Coche;
use App\Turno;
use App\Linea;
use Laracasts\Flash\Flash;
use Dompdf\Dompdf;
use Luecano\NumeroALetras\NumeroALetras;
use Carbon\Carbon;
use App;
use \PDF;
use DateTime;


class BolManantialController extends Controller
{
 public function index(Request $request)
    {
        $datos=BoletoLeagas::search($request->name)->orderBy('fecha','DESC')->paginate(30);
    
        $datos->each(function($datos){
            $datos->linea;
            $datos->choferleagaslnf;
            $datos->servicioleagaslnf;
            $datos->turno; 
            $datos->coche;
       });

        return view('bolmanantial.boletos.index')
            ->with('datos',$datos);
    }
     public function create()
    {
        $linea=Linea::orderBy('numero','ASC')->pluck('numero','id');
        $choferleagaslnf=ChoferLeagaslnf::orderBy('nombre','ASC')->pluck('nombre','id');
        $servicioleagaslnf=ServicioLeagasLnf::orderBy('nombre','ASC')->pluck('nombre','id');
        $coche=Coche::orderBy('interno','ASC')->pluck('interno','id');
        $turno=Turno::orderBy('nombre','ASC')->pluck('nombre','id');
       

        return view('bolmanantial.boletos.create')
               ->with('linea',$linea)
               ->with('choferleagaslnf',$choferleagaslnf)
               ->with('servicioleagaslnf',$servicioleagaslnf)
               ->with('coche',$coche)
               ->with('turno',$turno);
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
        $rest = substr($request->horafin, 0,-3);
        $rest1 = substr($request->horafin, -3);
        if($rest==0){
            $horainicio=new DateTime($request->horainicio);
            $rest=20;
            $horarestadas=$rest.$rest1;
            $horarestadas=new DateTime($horarestadas);
             $newhorafin=$horainicio->modify('-4 hours');
             dd($newhorafin);
        }
        else{
            if($rest==1){
                $horainicio=new DateTime($request->horainicio);
                $rest=21;
                $horarestadas=$rest.$rest1;
                $horarestadas=new DateTime($horarestadas);
                 $newhorafin=$horainicio->modify('-3 hours');
                 dd($newhorafin);
            }
            else{
                if($rest==2){
                    $horainicio=new DateTime($request->horainicio);
                $rest=22;
                $horarestadas=$rest.$rest1;
                $horarestadas=new DateTime($horarestadas);
                $newhorafin=$horainicio->modify('-2 hours');
                 dd($newhorafin);
                }
                else{
                   if($rest==3){
                    $horainicio=new DateTime($request->horainicio);
                    $rest=23;

                    $horarestadas=$rest.$rest1;
                    $horarestadas=new DateTime($horarestadas);
                    $newhorafin=$horainicio->modify('-1 hours');
                    dd($newhorafin);
                    } 
                }
            }
            
        }
      
        $horainicio=new DateTime($request->horainicio);
        $horafin=new DateTime($request->horafin);
       
        $horasdetrabajo=new DateTime('07:30');
        $horaspararestar=new DateTime('12:00');
        $docenoche=new DateTime('00:00');


        if($horafin>=$docenoche){
            //dd($horafin);
          $newhorafin=$horafin->modify('-2 hours');//HACER ALGO CON ESTO
          $newhorainicio=$horainicio->modify('-2 hours');
            $canths = $newhorainicio->diff($newhorafin);          
          
        }

        $canths = $horainicio->diff($horafin);

        $canthorastrabajadas=$canths->format('%H:%I');

        $horastrabajadas=new DateTime($canthorastrabajadas);


        $datos=new BoletoLeagas(request()->except('_token'));

        $datos->valorhorasrestantes=0;
        $datos->valortoquesanden=$request->toquesanden*63;
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
}

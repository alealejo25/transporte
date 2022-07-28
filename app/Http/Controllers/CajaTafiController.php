<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VentaTafi;
use App\MovimientoCajaTafi;
use App\CierreDiaTafi;
use App\EmpresasBolTafi;
use App\Abonado;
use App\Recaudacion;
use Laracasts\Flash\Flash;
use Dompdf\Dompdf;
use Luecano\NumeroALetras\NumeroALetras;
use Carbon\Carbon;
use App;
use \PDF;


class CajaTafiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function movimiento(Request $request)
    {
        return view('boltafi.cajas.movimiento');
    }

    public function guardarmovimiento(Request $request)
    {

         $fecha=new \DateTime();
        /*VALIDACION -----------------------------------------*/
        $campos=[
            'descripcion'=>'required|string|max:50',
            'tipo'=>'required',
            'importe'=>'required|integer'
        ];
        $Mensaje=["required"=>'El :attribute es requerido'];
        $this->validate($request,$campos,$Mensaje);

        $datos=new MovimientoCajaTafi(request()->except('_token'));
        $datosmovimientos=MovimientoCajaTafi::orderBy('id','DESC')->limit(1)->get();

        if($request->tipo ==='INICIAR CAJA'){
            $datos->importe_final=$request->importe;
            $datos->tipo_movimiento="INGRESO";
            $datos->fecha=$fecha;
            $datos->user_id=$request->user_id;
            $datos->save();
            flash::success('SE REALIZO INICIO DE CAJA'); 
            return Redirect('boltafi/cajas/movimiento')->with('Mensaje','SE REALIZO INICIO DE CAJA');
        }
        else{
           $datosmovimientos=MovimientoCajaTafi::where('tipo','INICIAR CAJA')->where('cierre',0)->orderBy('id','DESC')->limit(1)->get();
            if(count($datosmovimientos)==0)
            {
                Flash::warning('DEBE TENER UN INICIO DE CAJA PARA REALIZAR EL GASTO');
                return view('boltafi.cajas.movimiento'); 
            }
            else{
                $datosmovimientos=MovimientoCajaTafi::orderBy('id','DESC')->limit(1)->get();
                if($datosmovimientos[0]->importe_final<$request->importe){
                Flash::warning('NO TIENE SUFICIENTE DINERO PARA REALIZAR EL GASTO!!');
                return view('boltafi.cajas.movimiento');
                }
                else{
                    $datosmovimientos=MovimientoCajaTafi::orderBy('id','DESC')->limit(1)->get();
                    $datos->importe_final=$datosmovimientos[0]->importe_final-$request->importe;
                    $datos->tipo_movimiento="EGRESO";    
                    $datos->fecha=$fecha;
                    $datos->user_id=$request->user_id;
                    $datos->save();
                    flash::success('SE REALIZO EL GASTO'); 
                    return Redirect('boltafi/cajas/movimiento')->with('Mensaje','SE REALIZO EL GASTO');
                }
            }
            
            
        }


       
       flash::success('Se Inicio la caja'); 
       return Redirect('boltafi/cajas/movimiento')->with('Mensaje','Se Inicio la caja');
       

    }
    public function cierrecajatafi(Request $request)
    {
        return view('boltafi.cajas.cierrecaja');
    }
     public function ventasdiarias(Request $request)
    {
        $abonados=Abonado::orderBy('apellido','ASC')->get();
        //$abonados=Abonado::orderBy('dni','ASC')->pluck('dni','id');
        return view('boltafi.reportes.ventasdiarias')->with('abonados',$abonados);
    }
    public function reporteventasboltafi(Request $request)
    {

            

    $fi = Carbon::parse($request->fechai)->format('Y-m-d').' 00:00:00';
    $ff = Carbon::parse($request->fechaf)->format('Y-m-d').' 23:59:59';

    if($request->abonado_id===null){
       $consulta=VentaTafi::whereBetween('fecha',[$fi, $ff])->get();
       $consultasuma=VentaTafi::whereBetween('fecha',[$fi, $ff])->sum("montototal");
       $formatter = new NumeroALetras();
        $montoenletras=$formatter->toMoney($consultasuma, 2, 'PESOS','CENTAVOS');
       $consulta->each(function($consulta){
            $consulta->abonado;
            $consulta->user;
        });


      $pdf=\PDF::loadView('boltafi.pdf.reporteventasdiarias',['consulta'=>$consulta,'consultasuma'=>$consultasuma,'montoenletras'=>$montoenletras,'ff'=>$ff,'fi'=>$fi])
        ->setPaper('a4','landscape');
        return $pdf->download('reporteventasdiarias.pdf');
     }
     else{
        $consulta=VentaTafi::whereBetween('fecha',[$fi, $ff])->where('abonado_id',$request->abonado_id)->get();
        $abonado=Abonado::where('id',$request->abonado_id)->orderBy('apellido','ASC')->get();
         $consultasuma=VentaTafi::whereBetween('fecha',[$fi, $ff])->sum("montototal");
         $formatter = new NumeroALetras();
        $montoenletras=$formatter->toMoney($consultasuma, 2, 'PESOS','CENTAVOS');
        $consulta->each(function($consulta){
            $consulta->user;
        });

       $pdf=\PDF::loadView('boltafi.pdf.reporteventasabonados',['consulta'=>$consulta,'abonado'=>$abonado,'consultasuma'=>$consultasuma,'montoenletras'=>$montoenletras])
        ->setPaper('a4','landscape');
        return $pdf->download('reporteventasabonados.pdf');
     }

    }
    
     public function cierresdecajas(Request $request)
    {
        $abonados=Abonado::orderBy('apellido','ASC')->get();
        //$abonados=Abonado::orderBy('dni','ASC')->pluck('dni','id');
        return view('boltafi.reportes.cierredecajas')->with('abonados',$abonados);
    }
    
    public function reportecierresdecajas(Request $request)
    {
        $consulta=CierreDiaTafi::orderBy('id','DESC')->where('fecha',$request->fechai)->limit(1)->get();
        $consulta->each(function($consulta){
          $consulta->user;
        });
        

        $formatter = new NumeroALetras();
        $montoenletras=$formatter->toMoney($consulta[0]->gananciatotallnf, 2, 'PESOS','CENTAVOS');
        $pdf=\PDF::loadView('boltafi.pdf.reportecierredecaja',['consulta'=>$consulta,'montoenletras'=>$montoenletras])
        ->setPaper('a4','landscape');
        return $pdf->download('reportecierredecaja.pdf');
}



    public function guardarcierrecajatafi(Request $request)
    {
        $fecha=new \DateTime();
        $campos=[
            'descripcion'=>'required|string|max:50',
            'montototal'=>'required|numeric',
            'nrolote'=>'required|numeric',
            'montolote'=>'required'
                     
        ];
        $Mensaje=["required"=>'El :attribute es requerido'];
        $this->validate($request,$campos,$Mensaje);
        $datosCierreCaja=new CierreDiaTafi(request()->except('_token'));
        $datosCierreCaja->fecha=$fecha;
        $datosCierreCaja->nrolote=$request->nrolote;
        $datosCierreCaja->montolote=$request->montolote;

        $datosmovimientos=MovimientoCajaTafi::where('tipo','INICIAR CAJA')->where('cierre',0)->orderBy('id','DESC')->limit(1)->get();
        if(count($datosmovimientos)==0)
        {
           Flash::warning('DEBE TENER UN INICIO DE CAJA PARA CERRAR LA CAJA');
                return view('boltafi.cajas.movimiento'); 
        }
        $datosCierreCaja->caja_inicial=$datosmovimientos[0]->importe;

        $datosmovimientosventas=MovimientoCajaTafi::where('tipo','VENTA')->where('cierre',0)->sum('importe');
                $datosCierreCaja->venta=$datosmovimientosventas;
        $datoscantidadventas=MovimientoCajaTafi::where('tipo','VENTA')->where('cierre',0)->count('cierre');
        $datosCierreCaja->planchas_vendidas=$datoscantidadventas;

        
        $datoscantidadanulados=MovimientoCajaTafi::where('tipo','ANULADO')->where('cierre',0)->count('cierre');
        $datosCierreCaja->planchas_anuladas=$datoscantidadanulados;


        $datosmovimientosgastos=MovimientoCajaTafi::where('tipo','GASTOS VARIOS')->where('cierre',0)->sum('importe');
        $datosCierreCaja->gastos=$datosmovimientosgastos;

        $datosmovimientosimportefinal=MovimientoCajaTafi::where('cierre',0)->orderBy('id','DESC')->limit(1)->get();
        $datosCierreCaja->caja_final=$datosCierreCaja->caja_inicial+$datosCierreCaja->venta-$datosCierreCaja->gastos;
        $datosCierreCaja->caja_final_fisica=$request->montototal;



        $datosCierreCaja->planchas_impresas=0;
        $datosCierreCaja->planchas_dañada=0;
        $datosCierreCaja->cierre=1;
        $datosCierreCaja->observacion=$request->descripcion;

        $datosempresalnf=EmpresasBolTafi::where('nombre_corto','LNF')->get();
        $datosCierreCaja->ganancialnf=($datosCierreCaja->caja_final)/2;

        $datosCierreCaja->gananciatotallnf=$datosCierreCaja->ganancialnf+$datosCierreCaja->montolote;
        $diferencia=$datosCierreCaja->caja_final-$datosCierreCaja->caja_final_fisica;
        $datosCierreCaja->caja_diferencia=$diferencia;
        $datosempresaer=EmpresasBolTafi::where('nombre_corto','ER')->get();
        $datosCierreCaja->gananciaelrayo=($datosCierreCaja->caja_final)/2;
        $datosCierreCaja->user_id=$request->user_id;
        $datosCierreCaja->save();

        $datos=new MovimientoCajaTafi();
        $datos->tipo='CIERRE CAJA';
        $datos->tipo_movimiento='EGRESO';
        $datos->descripcion=$request->descripcion;
        $datos->fecha=$fecha;
        $datos->importe=$datosCierreCaja->caja_final;
        $datos->importe_final=0;
        $datos->cierre=0;

        $datosidcierre=CierreDiaTafi::orderBy('id','DESC')->limit(1)->get();
        $datos->cierre_dia_tafi_id=$datosidcierre[0]->id;
        $datos->save();        

        $actualizarplancha=MovimientoCajaTafi::where('cierre',0)
                        ->update([
                                'cierre'=>1,
                                ]);

       /* $consulta=CierreDiaTafi::orderBy('id','DESC')->limit(1)->get();
        $consulta->each(function($consulta){
          $consulta->user;
        });


        $cantbilletes=$consulta[0]->diez+$consulta[0]->veinte+$consulta[0]->cincuenta+$consulta[0]->cien+$consulta[0]->doscientos+$consulta[0]->quinientos+$consulta[0]->mil;
        $diez=$consulta[0]->diez*10;
        $veinte=$consulta[0]->veinte*20;
        $cincuenta=$consulta[0]->cincuenta*50;
        $cien=$consulta[0]->cien*100;
        $doscientos=$consulta[0]->doscientos*200;
        $quinientos=$consulta[0]->quinientos*500;
        $mil=$consulta[0]->mil*1000;
        $totaldinero=$diez+$veinte+$cincuenta+$cien+$doscientos+$quinientos+$mil;


        $formatter = new NumeroALetras();
        $montoenletras=$formatter->toMoney($totaldinero, 2, 'PESOS','CENTAVOS');
        $pdf=\PDF::loadView('pdf.cierredecajatafi',['consulta'=>$consulta,'cantbilletes'=>$cantbilletes,'diez'=>$diez,'veinte'=>$veinte,'cincuenta'=>$cincuenta,'cien'=>$cien,'doscientos'=>$doscientos,'quinientos'=>$quinientos,'mil'=>$mil,'totaldinero'=>$totaldinero,'montoenletras'=>$montoenletras])
        ->setPaper('a4','landscape');
        return $pdf->download('cierredecajatafi.pdf');*/



        flash::success('Se cerro la CAJA'); 
       return Redirect('boltafi/cajas/cierrecajatafi')->with('Mensaje','Se cerro la CAJA');
    
    }

     public function recaudacion(Request $request)
    {
        
        $abonados=Abonado::orderBy('apellido','ASC')->get();
        //$abonados=Abonado::orderBy('dni','ASC')->pluck('dni','id');
        return view('boltafi.cajas.recaudacion')->with('abonados',$abonados);
    }

    public function guardarrecaudaciontafi(Request $request)
    {
        $fecha=new \DateTime();
        $campos=[
            'descripcion'=>'required|string|max:50',
            'fechai'=>'required',
            'fechaf'=>'required'
                     
        ];
        $Mensaje=["required"=>'El :attribute es requerido'];
        $this->validate($request,$campos,$Mensaje);

        $fi = Carbon::parse($request->fechai)->format('Y-m-d').' 00:00:00';
        $ff = Carbon::parse($request->fechaf)->format('Y-m-d').' 23:59:59';



        $consultacantidad=CierreDiaTafi::whereBetween('fecha',[$fi, $ff])->get();
        $cantidad1=count($consultacantidad);
        $consultacantidadcerradas=CierreDiaTafi::whereBetween('fecha',[$fi, $ff])->where('recaudacion_id',null)->get();
        $cantidad2=count($consultacantidadcerradas);
       

        if($cantidad2 != $cantidad1)
        {
            flash::warning('NO REALIZO LA RECAUDACIÓN!!! EXISTE UN CIERRE QUE YA PERTENECE A UNA RECAUDACIÓN.'); 
       return Redirect('boltafi/cajas/recaudacion')->with('Mensaje','NO REALIZO LA RECAUDACION POR, EXISTE UN CIERRE QUE YA PERTENECE A UNA RECAUDACION.');
        }

        $consultasumaventa=CierreDiaTafi::whereBetween('fecha',[$fi, $ff])->where('recaudacion_id',null)->sum("venta");
        $consultasumaegresos=CierreDiaTafi::whereBetween('fecha',[$fi, $ff])->where('recaudacion_id',null)->sum("gastos");
        $consultasumaposnet=CierreDiaTafi::whereBetween('fecha',[$fi, $ff])->where('recaudacion_id',null)->sum("montolote");
        $consultasumaplanchasvendidas=CierreDiaTafi::whereBetween('fecha',[$fi, $ff])->where('recaudacion_id',null)->sum("planchas_vendidas");
        $consultasumaplanchasanuladas=CierreDiaTafi::whereBetween('fecha',[$fi, $ff])->where('recaudacion_id',null)->sum("planchas_anuladas");
        $consultasumaneto=CierreDiaTafi::whereBetween('fecha',[$fi, $ff])->where('recaudacion_id',null)->sum("caja_final");
        
        $consultasumagananciatotal=CierreDiaTafi::whereBetween('fecha',[$fi, $ff])->where('recaudacion_id',null)->sum("gananciatotallnf");
        $datos=new Recaudacion();
        $datos->observacion=$request->descripcion;
        $datos->desde=$request->fechai;
        $datos->hasta=$request->fechaf;
        $datos->fecha=$fecha;
        $datos->abono=$consultasumaventa;
        $datos->abono50=$consultasumaventa/2;
        $datos->posnet=$consultasumaposnet;
        $datos->egresos=$consultasumaegresos;
        $datos->totalingresos=$datos->abono50+$consultasumaposnet;
        $datos->montoneto=$datos->totalingresos-(($datos->egresos)/2);
        $datos->diez=$request->diez;
        $datos->veinte=$request->veinte;
        $datos->cincuenta=$request->cincuenta;
        $datos->cien=$request->cien;
        $datos->doscientos=$request->doscientos;
        $datos->quinientos=$request->quinientos;
        $datos->mil=$request->mil;
        $datos->fisico=$request->dinerofisico;
        $datos->planchasvendidas=$consultasumaplanchasvendidas;
        $datos->planchasanuladas=$consultasumaplanchasanuladas;
        $datos->diferencia=$request->dinerofisico-$datos->montoneto;
        $datos->user_id=$request->user_id;
        $datos->save();

        $datosidcierre=Recaudacion::orderBy('id','DESC')->limit(1)->get();
        $recaudacion_id=$datosidcierre[0]->id;

        $actualizarplancha=CierreDiaTafi::whereBetween('fecha',[$fi, $ff])->where('recaudacion_id',null)
                        ->update([
                                'recaudacion_id'=>$recaudacion_id,
                                ]);

       flash::success('Se realizo la recaudacion'); 
       return Redirect('boltafi/cajas/recaudacion')->with('Mensaje','Se realizo la recaudacion');
     }


      public function verrecaudaciontafi(Request $request)
    {
        $datos=Recaudacion::orderBy('fecha','ASC')->paginate(50);
        
        return view('boltafi.cajas.verrecaudaciontafi')->with('datos',$datos);
    }
  public function imprimirrecaudaciontafi($id)
    {
        
       
        $datos=Recaudacion::where('id',$id)->get();
        $datos->each(function($datos){
          $datos->user;
        });
        //dd($datos[0]->diferencia);
        //dd($datos);
        $fi = Carbon::parse($datos[0]->desde)->format('Y-m-d').' 00:00:00';
        $ff = Carbon::parse($datos[0]->hasta)->format('Y-m-d').' 23:59:59';
        $consultacierretafi=CierreDiaTafi::whereBetween('fecha',[$fi, $ff])->get();

        $formatter = new NumeroALetras();
        $montonetoenletras=$formatter->toMoney($datos[0]->montoneto, 2, 'PESOS','CENTAVOS');
        $formatter1 = new NumeroALetras();
        $montofisicoenletras=$formatter1->toMoney($datos[0]->fisico, 2, 'PESOS','CENTAVOS');
        

        $diez=$datos[0]->diez*10;
        $veinte=$datos[0]->veinte*20;
        $cincuenta=$datos[0]->cincuenta*50;
        $cien=$datos[0]->cien*100;
        $doscientos=$datos[0]->doscientos*200;
        $quinientos=$datos[0]->quinientos*500;
        $mil=$datos[0]->mil*1000;

        $pdf=\PDF::loadView('boltafi.pdf.reporterecaudaciontafi',['consultacierretafi'=>$consultacierretafi,'datos'=>$datos,'montonetoenletras'=>$montonetoenletras,'montofisicoenletras'=>$montofisicoenletras,'diez'=>$diez,'veinte'=>$veinte,'cincuenta'=>$cincuenta,'cien'=>$cien,'doscientos'=>$doscientos,'quinientos'=>$quinientos,'mil'=>$mil])
        ->setPaper('a4','landscape');
        return $pdf->download('reporterecaudaciontafi.pdf');
    }

}

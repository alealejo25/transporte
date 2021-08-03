<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PagoMetropolitana;
use App\Caja;
use App\MovimientoCaja;
use App\ChequePropio;
use App\User;
use App\Boleteria122Detalle;
use App\Boleteria122;
use App\PagoWorldline;
use Carbon\Carbon;


use Laracasts\Flash\Flash;

class MovimientoCajaController extends Controller
{    public function __construct()
    {
        $this->middleware('auth');
    }
  public function index(Request $request)
    {
        $MovimientosCajas=MovimientoCaja::orderBy('fecha','DESC')->paginate(20);

        //esto es para las relacion de la tabla articulos con categorias
        $MovimientosCajas->each(function($MovimientosCajas){
        	$MovimientosCajas->cajas;
        });
		//----------------------------------------------------------
        //dd($acoplados);
        return view('abms.movimientoscajas.index')
        	->with('MovimientosCajas',$MovimientosCajas);

    }

public function iniciar()
    {

    	$cajas=Caja::orderBy('denominacion','ASC')->pluck('denominacion','id');
    	return view('finanzas.movimientoscajas.iniciar')
        		->with('cajas',$cajas);
        
     }

public function store(Request $request)
    {


    	$date = new \DateTime();
    	$cajas=Caja::orderBy('denominacion','DESC')->pluck('denominacion','id');

        /*VALIDACION -----------------------------------------*/
        $campos=[
            'descripcion'=>'required|string|max:100',
            'importe'=>'required|string|max:10',
            'caja_id'=>'required|string|max:30',
            'tipo'=>'required'
        
        ];
        $Mensaje=["required"=>'El :attribute es requerido'];
        $this->validate($request,$campos,$Mensaje);
        /*--------------------------------------------------------*/




        /* forma de grabar los datos en una variable */
        $datosmovimientoscajas=new MovimientoCaja(request()->except('_token'));

        //busco el ultimo registro para la caja seleccionada para sumarle el importe
      	$consultamovimientos=MovimientoCaja::where('caja_id', $datosmovimientoscajas->caja_id)->orderBy('id','DESC')->limit(1)->get();
		    $importe_final_anterior=0;
        $datosmovimientoscajas->fecha=$date;   
        if($consultamovimientos <> null){
          foreach ($consultamovimientos as $consultamovimiento) {
            $importe_final_anterior=$consultamovimiento->importe_final;
          }
        }   	

       if($datosmovimientoscajas->tipo=='iniciar'){

          $datosmovimientoscajas->tipo_movimiento='INGRESO';
          $datosmovimientoscajas->importe_final=$importe_final_anterior+$datosmovimientoscajas->importe;
          $datosmovimientoscajas->save();
        }

        if($datosmovimientoscajas->tipo=='GASTOS VARIOS'){
          $datosmovimientoscajas->tipo_movimiento='EGRESO';
          $datosmovimientoscajas->importe_final=$importe_final_anterior-$datosmovimientoscajas->importe;
          $datosmovimientoscajas->save();
        }

        flash::success('Se registro el movimiento de Caja. Dinero existente $ '.$datosmovimientoscajas->importe_final); 
       return view('finanzas.movimientoscajas.iniciar')
        		->with('cajas',$cajas)
        		->with('Mensaje','Caja Inicial con éxito');;
    }

    public function ingresartransferencia()
    {

      $cajas=Caja::orderBy('denominacion','ASC')->pluck('denominacion','id');
      return view('finanzas.movimientoscajas.ingresartransferencia')
            ->with('cajas',$cajas);
        
     }

   public function guardartransferencia(Request $request)
    {

        $date = new \DateTime();
        $cajas=Caja::orderBy('denominacion','DESC')->pluck('denominacion','id');
      
        /*VALIDACION -----------------------------------------*/
        $campos=[
            'caja_idd'=>'required',
            'importe'=>'required',
            'caja_id'=>'required'         
        ];
        $Mensaje=["required"=>'El :attribute es requerido'];
        $this->validate($request,$campos,$Mensaje);
        /*--------------------------------------------------------*/

      $datosmovimientoscajas1=new MovimientoCaja(request()->except('_token'));

     
      $consultamovimientos1=MovimientoCaja::where('caja_id', $datosmovimientoscajas1->caja_id)->orderBy('id','DESC')->limit(1)->get();

      $importe_final_anterior=0;
      $datosmovimientoscajas1->fecha=$date; 
      $datosmovimientoscajas1->tipo='transferencia'; 
      $datosmovimientoscajas1->tipo_movimiento='EGRESO';
      $datosmovimientoscajas1->descripcion='CAJA ORIGEN';


      if($consultamovimientos1 <> null){
        foreach ($consultamovimientos1 as $consultamovimiento1) {
          $importe_final_anterior=$consultamovimiento1->importe_final;
        }
      }  
      $datosmovimientoscajas1->importe_final=$importe_final_anterior-$datosmovimientoscajas1->importe;
      $datosmovimientoscajas1->save();
      //dd($request->caja_idd);
      //dd($datosmovimientoscajas);

      $datosmovimientoscajas2=new MovimientoCaja(request()->except('_token'));
      $consultamovimientos2=MovimientoCaja::where('caja_id', $request->caja_idd)->orderBy('id','DESC')->limit(1)->get();


      $importe_final_anterior=0;
      $datosmovimientoscajas2->tipo_movimiento='INGRESO';
      $datosmovimientoscajas2->descripcion='CAJA DESTINO';
      $datosmovimientoscajas2->tipo='transferencia'; 
      $datosmovimientoscajas2->fecha=$date;
      $datosmovimientoscajas2->caja_id=$request->caja_idd;

      if($consultamovimientos2 <> null){
        foreach ($consultamovimientos2 as $consultamovimiento2) {
          $importe_final_anterior=$consultamovimiento2->importe_final;
        }
      }  
      $datosmovimientoscajas2->importe_final=$importe_final_anterior+$datosmovimientoscajas2->importe;
      $datosmovimientoscajas2->save();



      return view('finanzas.movimientoscajas.ingresartransferencia')
            ->with('cajas',$cajas);
    }

  public function ingresarchequepropio(){
    $chequespropios=ChequePropio::where('estado', 'DISPONIBLE')->orderBy('numero','ASC')->pluck('numero','id');
    return view('finanzas.movimientoscajas.ingresarchequepropio')
            ->with('chequespropios',$chequespropios);
  }

  public function guardarchequepropio(Request $request){

      $date = new \DateTime();
     
        /*VALIDACION -----------------------------------------*/
        $campos=[
            'id'=>'required',
            'importe'=>'required',
            'fecha'=>'required'         
        ];
        $Mensaje=["required"=>'El :attribute es requerido'];
        $this->validate($request,$campos,$Mensaje);
        /*--------------------------------------------------------*/
      //------------- UPDATES MANERA 1---------------------------------
      //$datoschequespropios=ChequePropio::find($request->id);
      // $datoschequespropios->estado='NO DISPONIBLE';
      // $datoschequespropios->importe=$request->importe;
      // $datoschequespropios->fecha=$request->fecha;
      // $datoschequespropios->save();
      //-------------------------------------------------------------------------
        //------------- UPDATES MANERA 2---------------------------------
      $otraforma=ChequePropio::where('id',$request->id)
                ->update([
                          'estado'=>'COBRADO',
                          'importe'=>$request->importe,
                          'fecha'=>$request->fecha
                        ]);
  
      //------------------------------------------------------------------------------
      $caja='2';
      $datosmovimientoscajas=new MovimientoCaja(request()->except('_token'));
      $consultamovimientos=MovimientoCaja::where('caja_id', $caja)->orderBy('id','DESC')->limit(1)->get();



      $importe_final_anterior=0;
      $datosmovimientoscajas->tipo_movimiento='INGRESO';
      $datosmovimientoscajas->descripcion='COBRO DE CHEQUE PROPIO';
      $datosmovimientoscajas->tipo='COBRO CHEQUE PROPIO'; 
      $datosmovimientoscajas->fecha=$date;
      $datosmovimientoscajas->caja_id=$caja;

      if($consultamovimientos <> null){
        foreach ($consultamovimientos as $consultamovimiento) {
          $importe_final_anterior=$consultamovimiento->importe_final;
        }
      }  
      $datosmovimientoscajas->importe_final=$importe_final_anterior+$datosmovimientoscajas->importe;
      $datosmovimientoscajas->save();
    flash::success('Se COBRO el cheque en la caja PRINCIPAL');
 
        return Redirect('finanzas/movimientoscajas/ingresarchequepropio');
  }



public function pagometropolitana()
    {

        $cajas=Caja::orderBy('denominacion','ASC')->pluck('denominacion','id');
        return view('pagos.cliente.iniciar')
                ->with('cajas',$cajas);
        
     }
public function pagoworldline()
    {

        $cajas=Caja::orderBy('denominacion','ASC')->pluck('denominacion','id');
        return view('pagos.cliente.iniciarworldline')
                ->with('cajas',$cajas);
        
     }

public function pagoboleteria122()
    {

        $cajas=Caja::orderBy('denominacion','ASC')->pluck('denominacion','id');
        return view('pagos.cliente.boleteria122')
                ->with('cajas',$cajas);
        
     }


public function ingresarpagometropolitana(Request $request){

        $date = new \DateTime();
        $cajas=Caja::orderBy('denominacion','DESC')->pluck('denominacion','id');
 
        /*VALIDACION -----------------------------------------*/
        $campos=[
            'nrocomprobante'=>'required',
            'fechainicio'=>'required',
            'fechafin'=>'required',
            'importe'=>'required',
            'servmetro'=>'required',
            'fondo'=>'required',
            'iibb'=>'required',
            'totaldeducciones'=>'required',
            'netoapagar'=>'required',
            'caja_id'=>'required'
      
        ];
        $Mensaje=["required"=>'El :attribute es requerido'];
        $this->validate($request,$campos,$Mensaje);


        $datospagometropolitana= new PagoMetropolitana(request()->except('_token'));
        $datospagometropolitana->user_id=auth()->user()->id;
        $datospagometropolitana->save();
       
        
        
        $datosmovimientoscajas=new MovimientoCaja();
        $datosmovimientoscajas->tipo='pagometropolitana';
        $datosmovimientoscajas->tipo_movimiento='INGRESO';
        $datosmovimientoscajas->descripcion='PAGO DE METROPOLITANA SA';
        $datosmovimientoscajas->fecha=$date;
        $datosmovimientoscajas->caja_id=$request->caja_id;
        $datosmovimientoscajas->importe=$request->netoapagar;
        $importe_final_anterior=0;
        $consultamovimientos=MovimientoCaja::where('caja_id', $request->caja_id)->orderBy('id','DESC')->limit(1)->get();
        if($consultamovimientos <> null){
        foreach ($consultamovimientos as $consultamovimiento) {
          $importe_final_anterior=$consultamovimiento->importe_final;
        }
      }  
      $datosmovimientoscajas->importe_final=$importe_final_anterior+$datosmovimientoscajas->importe;
      $datosmovimientoscajas->save();
         flash::success('Se ingreso con exito');
         return Redirect('pagos/cliente/pagometropolitana');
 
  }


public function ingresarpagoworldline(Request $request){

        $date = new \DateTime();
        $cajas=Caja::orderBy('denominacion','DESC')->pluck('denominacion','id');
 
        /*VALIDACION -----------------------------------------*/
        $campos=[
            'nrocomprobante'=>'required',
            'fecha'=>'required',
            'subtotal'=>'required',
            'subtotalretenciones'=>'required',
            'caja_id'=>'required'
      
        ];
        $Mensaje=["required"=>'El :attribute es requerido'];
        $this->validate($request,$campos,$Mensaje);


        $datospagoworldline= new PagoWorldline(request()->except('_token'));
        $datospagoworldline->user_id=auth()->user()->id;
        $datospagoworldline->save();
       
        
        
        $datosmovimientoscajas=new MovimientoCaja();
        $datosmovimientoscajas->tipo='pagoworldline';
        $datosmovimientoscajas->tipo_movimiento='INGRESO';
        $datosmovimientoscajas->descripcion='PAGO DE WORLDLINE SA';
        $datosmovimientoscajas->fecha=$date;
        $datosmovimientoscajas->caja_id=$request->caja_id;
        $datosmovimientoscajas->importe=$request->netoapagar;
        $importe_final_anterior=0;
        $consultamovimientos=MovimientoCaja::where('caja_id', $request->caja_id)->orderBy('id','DESC')->limit(1)->get();
        if($consultamovimientos <> null){
            foreach ($consultamovimientos as $consultamovimiento) {
              $importe_final_anterior=$consultamovimiento->importe_final;
            }
        }  
        $datosmovimientoscajas->importe_final=$importe_final_anterior+$datosmovimientoscajas->importe;
        $datosmovimientoscajas->save();
        flash::success('Se ingreso el pago con exito');
        return Redirect('pagos/cliente/pagoworldline');
 
  }


  public function ingresar122(Request $request){

        $date = new \DateTime();
    $datos=$request->all();
    $total=0;
    $totalp=0;
    $totalu=0;
    $totalm=0;



    $boleteria122=Boleteria122::create([
        "puntodeventa"=>$datos["pv"],
        "responsable"=>$datos["responsable"],
        "observacion"=>$datos["observacion"],
        "fecha"=>$datos["fechapresentacion"],
        "total"=>$total
            ]);
           
        foreach($datos['totalarendirm'] as $key => $value){
        Boleteria122Detalle::create([
                    "dia"=>$datos["fecha"][$key],
                    "totalarendirp"=>$datos["totalarendirp"][$key],
                    "abonodesdep"=>$datos["abonodesdep"][$key],
                    "abonohastap"=>$datos["abonohastap"][$key],
                    "totalarendiru"=>$datos["totalarendiru"][$key],
                    "abonodesdeu"=>$datos["abonodesdeu"][$key],
                    "abonohastau"=>$datos["abonohastau"][$key],
                    "totalarendirm"=>$datos["totalarendirm"][$key],
                    "cierrelote"=>$datos["cierrelote"][$key],
                    "boleteria122_id"=>$boleteria122->id
                ]);

                $totalp=$datos["totalarendirp"][$key]+$totalp;
                $totalm=$datos["totalarendirm"][$key]+$totalm;
                $totalu=$datos["totalarendiru"][$key]+$totalu;

           }
      
        $totalfinal=$totalp+$totalu+$totalm;
        $id=$boleteria122->id;
        $editartotal=Boleteria122::where('id',$id)
                                 ->update([
                            'total'=>$totalfinal
                              ]);
                
       
         $datosmovimientoscajas=new MovimientoCaja();
        $datosmovimientoscajas->tipo='boleteria122';
        $datosmovimientoscajas->tipo_movimiento='INGRESO';
        $datosmovimientoscajas->descripcion='INGRESO LINEA 122';
        $datosmovimientoscajas->fecha=$date;
        $datosmovimientoscajas->caja_id=1; // CAJA LA NUEVA FOUNIER
        $datosmovimientoscajas->importe=$totalfinal;
        $importe_final_anterior=0;
        $consultamovimientos=MovimientoCaja::where('caja_id', $datosmovimientoscajas->caja_id)->orderBy('id','DESC')->limit(1)->get();
        if($consultamovimientos <> null){
            foreach ($consultamovimientos as $consultamovimiento) {
              $importe_final_anterior=$consultamovimiento->importe_final;
            }
        }  
        $datosmovimientoscajas->importe_final=$importe_final_anterior+$datosmovimientoscajas->importe;
        $datosmovimientoscajas->save();
         flash::success('Se ingreso con exito, y se actualizo la caja');
         return Redirect('pagos/cliente/pagoboleteria122');
 
  }
  
 


}
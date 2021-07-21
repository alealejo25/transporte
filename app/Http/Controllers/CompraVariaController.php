<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\OpComprasVarias;
use App\CompraVaria;
use App\MovimientoCaja;
use App\Proveedor;
use App\Empresa;
use Laracasts\Flash\Flash;

class CompraVariaController extends Controller
{

    public function index(Request $request)
    {
    $usuarios=User::orderBy('name','ASC')->pluck('name','id');
   
    return view('comprasvarias.iniciaroperacion')
        ->with('usuarios',$usuarios);
    }



    public function ingresarcomprasvarias(Request $request)
    {


    $consultacomprasabiertas=OpComprasVarias::where('estado','ABIERTO')->get();
    if(count($consultacomprasabiertas)==0)
    {
        $date = new \DateTime();

        /*VALIDACION -----------------------------------------*/
        $campos=[
            'montolnf'=>'required|numeric',
            'montol'=>'required|numeric'
         ];
        $Mensaje=["required"=>'El :attribute es requerido'];
        $this->validate($request,$campos,$Mensaje);
        /*--------------------------------------------------------*/

        $datos=new OpComprasVarias(request()->except('_token'));
        $datos->fechainicio=$date;
        $datos->gastoslnf=0;
        $datos->gastosl=0;
        $datos->rendicionlnf=0;
        $datos->rendicionl=0;
        $datos->diferencialnf=0;
        $datos->diferencial=0;
        $datos->estado="ABIERTO";
        $datos->user_id=auth()->user()->id;
        $datos->save();

        /// actualizar los valores de las cajas de las dos empresas.

        $cajalnf=1;
        $cajaleagas=2;


        /* egreso de la caja de LA ANUEVA FOURNIER Y AGREGAR EL MOVIMIENTO DE LA CAJA */
        $datosmovimientoscajaslnf=new MovimientoCaja();
        $consultamovimientoslnf=MovimientoCaja::where('caja_id', $cajalnf)->orderBy('id','DESC')->limit(1)->get();

        $importe_final_anterior=0;
        $datosmovimientoscajaslnf->tipo_movimiento='EGRESO';
        $datosmovimientoscajaslnf->descripcion='INICIO DE COMPRAS VARIAS';
        $datosmovimientoscajaslnf->tipo='COMPRAS VARIAS'; 
        $datosmovimientoscajaslnf->fecha=$date;
        $datosmovimientoscajaslnf->caja_id=1;
        $datosmovimientoscajaslnf->importe=$request->montolnf;
        if($consultamovimientoslnf <> null){
            foreach ($consultamovimientoslnf as $consultamovimiento) {
              $importe_final_anterior=$consultamovimiento->importe_final;
            }
        }  
        $datosmovimientoscajaslnf->importe_final=$importe_final_anterior-$datosmovimientoscajaslnf->importe;
        $datosmovimientoscajaslnf->save();
        /*-----------------------------------------------------------*/

        /* egreso de la caja de LA ANUEVA LEAGAS Y AGREGAR EL MOVIMIENTO DE LA CAJA */
        $datosmovimientoscajasl=new MovimientoCaja();
        $consultamovimientosl=MovimientoCaja::where('caja_id', $cajaleagas)->orderBy('id','DESC')->limit(1)->get();

        $importe_final_anterior=0;
        $datosmovimientoscajasl->tipo_movimiento='EGRESO';
        $datosmovimientoscajasl->descripcion='INICIO DE COMPRAS VARIAS';
        $datosmovimientoscajasl->tipo='COMPRAS VARIAS'; 
        $datosmovimientoscajasl->fecha=$date;
        $datosmovimientoscajasl->caja_id=2;
        $datosmovimientoscajasl->importe=$request->montol;
        if($consultamovimientosl <> null){
            foreach ($consultamovimientosl as $consultamovimiento) {
              $importe_final_anterior=$consultamovimiento->importe_final;
            }
        }  
        $datosmovimientoscajasl->importe_final=$importe_final_anterior-$datosmovimientoscajasl->importe;
        $datosmovimientoscajasl->save();
        /*-----------------------------------------------------------*/


        flash::success('Se registro la nueva operacion!!!'); 
        return view('comprasvarias.iniciaroperacion');
            //->with('datosopchofer',$datosopchofer);
    }else
    {
    flash::success('Tiene una operacion pendiente, debe cerrarla para crear una compra nueva!!!'); 
    return view('comprasvarias.iniciaroperacion');
    }

 


    //  $datosopchofer=OrdenPago::where('id',$request->ordendepago_id)->get();
    // $datosopchofer->each(function($datosopchofer){
    //       $datosopchofer->chofer;
    //     });



    // return view('pagos.imputarchofer')
    //         ->with('datosopchofer',$datosopchofer);
       

  }

   public function cargarcompra(Request $request)
    {

        $consultacomprasabiertas=OpComprasVarias::where('estado','ABIERTO')->get();
        if(count($consultacomprasabiertas)!=0)
        {
        $proveedores=Proveedor::orderBy('nombre','ASC')->pluck('nombre','id');
        $empresas=Empresa::orderBy('denominacion','ASC')->pluck('denominacion','id');
        return view('comprasvarias.ingresarcompra')
                    ->with('empresas',$empresas)
                    ->with('proveedores',$proveedores);
        }
        {
        flash::success('Tiene una operacion sin cerrar, comunicarse con el personal responsable de compras!!!'); 
        return view('home');
        }
    }

    public function ingresarcompra(Request $request)
    {
        $date = new \DateTime();

        /*VALIDACION -----------------------------------------*/
        $campos=[
            'tipocomprobante'=>'required',
            'nrocomprobante'=>'required',
            'proveedor_id'=>'required',
            'importe'=>'required|numeric',
            'empresa_id'=>'required',
         ];
        $Mensaje=["required"=>'El :attribute es requerido'];
        $this->validate($request,$campos,$Mensaje);
        /*--------------------------------------------------------*/



        //$acumulado=Proveedor::where('id',$id)->orderBy('id                    }-+','DESC')->limit(1)->get();
        $idcompra=OpComprasVarias::where('estado','ABIERTO')->orderBy('id','DESC')->limit(1)->get();
        $datoscompravaria=new CompraVaria(request()->except('_token'));
        $datoscompravaria->fecha=$date;
        $datoscompravaria->estado='CERRADA';
        $datoscompravaria->user_id=auth()->user()->id;
        $datoscompravaria->opcomprasvarias_id=$idcompra[0]->id;
        $datoscompravaria->save();


        if($request->empresa_id==1)
        {
            $gasto=$idcompra[0]->gastoslnf+$request->importe;
            $editarogasto=OpComprasVarias::where('id',$idcompra[0]->id)
                ->update([
                        'gastoslnf'=>$gasto
                          ]);
        }
        else
        {
            $gasto=$idcompra[0]->gastosl+$request->importe;
            $editarogasto=OpComprasVarias::where('id',$idcompra[0]->id)
                ->update([
                        'gastosl'=>$gasto
                          ]);
        }

        $proveedores=Proveedor::orderBy('nombre','ASC')->pluck('nombre','id');
        $empresas=Empresa::orderBy('denominacion','ASC')->pluck('denominacion','id');
        flash::success('Comprobante ingresado!!! - Tipo '.$request->tipocomprobante. '-' .$request->nrocomprobante);
        return view('comprasvarias.ingresarcompra')
                    ->with('empresas',$empresas)
                    ->with('proveedores',$proveedores);
 

    }


    public function cerraroperacion(Request $request)
    {
    $usuarios=User::orderBy('name','ASC')->pluck('name','id');
   
    return view('comprasvarias.cerraroperacion')
        ->with('usuarios',$usuarios);
    }

    public function ingresarcerraroperacion(Request $request)
    
    {
    $consultacomprasabiertas=OpComprasVarias::where('estado','ABIERTO')->get();
    if(count($consultacomprasabiertas)!=0)
    {
        $date = new \DateTime();

        /*VALIDACION -----------------------------------------*/
        $campos=[
            'montolnf'=>'required|numeric',
            'montol'=>'required|numeric'
         ];
        $Mensaje=["required"=>'El :attribute es requerido'];
        $this->validate($request,$campos,$Mensaje);
        /*--------------------------------------------------------*/

        $idcompra=OpComprasVarias::where('estado','ABIERTO')->orderBy('id','DESC')->limit(1)->get();
        $editaropcomprasvarias=OpComprasVarias::where('id',$idcompra[0]->id)
                ->update([
                        'rendicionlnf'=>$request->montolnf,
                        'rendicionl'=>$request->montol,
                        'diferencialnf'=>$idcompra[0]->gastoslnf-$request->montolnf,
                        'diferencial'=>$idcompra[0]->gastosl-$request->montol,
                        'observacion'=>$request->observacion,
                        //'estado'=>'CERRADO',
                        'fechacierre'=>$date
                          ]);


        /// actualizar los valores de las cajas de las dos empresas.

        $cajalnf=1;
        $cajaleagas=2;


        /* INGRESO de la caja de LA ANUEVA FOURNIER Y AGREGAR EL MOVIMIENTO DE LA CAJA */
        $datosmovimientoscajaslnf=new MovimientoCaja();
        $consultamovimientoslnf=MovimientoCaja::where('caja_id', $cajalnf)->orderBy('id','DESC')->limit(1)->get();

        $importe_final_anterior=0;
        $datosmovimientoscajaslnf->tipo_movimiento='INGRESO';
        $datosmovimientoscajaslnf->descripcion='DINERO DE OP DE COMPRA N° '.$idcompra[0]->id;
        $datosmovimientoscajaslnf->tipo='COMPRAS VARIAS'; 
        $datosmovimientoscajaslnf->fecha=$date;
        $datosmovimientoscajaslnf->caja_id=1;
        $datosmovimientoscajaslnf->importe=$request->montolnf;
        if($consultamovimientoslnf <> null){
            foreach ($consultamovimientoslnf as $consultamovimiento) {
              $importe_final_anterior=$consultamovimiento->importe_final;
            }
        }  
        $datosmovimientoscajaslnf->importe_final=$importe_final_anterior+$datosmovimientoscajaslnf->importe;
        $datosmovimientoscajaslnf->save();
        /*-----------------------------------------------------------*/

        /* egreso de la caja de LA ANUEVA LEAGAS Y AGREGAR EL MOVIMIENTO DE LA CAJA */
        $datosmovimientoscajasl=new MovimientoCaja();
        $consultamovimientosl=MovimientoCaja::where('caja_id', $cajaleagas)->orderBy('id','DESC')->limit(1)->get();

        $importe_final_anterior=0;
        $datosmovimientoscajasl->tipo_movimiento='INGRESO';
        $datosmovimientoscajasl->descripcion='DINERO DE OP DE COMPRA N° '.$idcompra[0]->id;
        $datosmovimientoscajasl->tipo='COMPRAS VARIAS'; 
        $datosmovimientoscajasl->fecha=$date;
        $datosmovimientoscajasl->caja_id=2;
        $datosmovimientoscajasl->importe=$request->montol;
        if($consultamovimientosl <> null){
            foreach ($consultamovimientosl as $consultamovimiento) {
              $importe_final_anterior=$consultamovimiento->importe_final;
            }
        }  
        $datosmovimientoscajasl->importe_final=$importe_final_anterior+$datosmovimientoscajasl->importe;
        $datosmovimientoscajasl->save();
        /*-----------------------------------------------------------*/


        flash::success('Se registro el cierre de operacion de compra!!!'); 
        return view('comprasvarias.iniciaroperacion');
            //->with('datosopchofer',$datosopchofer);
    }else
    {
    flash::success('Tiene una operacion pendiente, debe cerrarla para crear una compra nueva!!!'); 
    return view('comprasvarias.iniciaroperacion');
    }



  }


}

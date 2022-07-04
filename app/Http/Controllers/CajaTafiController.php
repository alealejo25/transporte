<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VentaTafi;
use App\MovimientoCajaTafi;
use App\CierreDiaTafi;
use App\EmpresasBolTafi;
use Laracasts\Flash\Flash;

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
                }
            }
            
            
        }

       $datos->fecha=$fecha;
       $datos->user_id=$request->user_id;
       $datos->save();
       
       return 'listo';

    }
    public function cierrecajatafi(Request $request)
    {
        return view('boltafi.cajas.cierrecaja');
    }

    public function guardarcierrecajatafi(Request $request)
    {

        $fecha=new \DateTime();
        $campos=[
            'descripcion'=>'required|string|max:50',
            'dinerofisico'=>'required|numeric',
            'diez'=>'required|numeric',
            'veinte'=>'required|numeric',
            'cincuenta'=>'required|numeric',
            'cien'=>'required|numeric',
            'doscientos'=>'required|numeric',
            'quinientos'=>'required|numeric',
            'mil'=>'required|numeric'
           
        ];
        $Mensaje=["required"=>'El :attribute es requerido'];
        $this->validate($request,$campos,$Mensaje);
        $datosCierreCaja=new CierreDiaTafi(request()->except('_token'));
        $datosCierreCaja->fecha=$fecha;

        $datosmovimientos=MovimientoCajaTafi::where('tipo','INICIAR CAJA')->where('cierre',0)->orderBy('id','DESC')->limit(1)->get();
        if(count($datosmovimientos)==0)
        {
           Flash::warning('DEBE TENER UN INICIO DE CAJA PARA CERRAR LA CAJA');
                return view('boltafi.cajas.movimiento'); 
        }
        $datosCierreCaja->caja_inicial=$datosmovimientos[0]->importe;

        $datosmovimientosventas=MovimientoCajaTafi::where('tipo','VENTA')->where('cierre',0)->sum('importe');
        $datosCierreCaja->venta=$datosmovimientosventas;

        $datosmovimientosgastos=MovimientoCajaTafi::where('tipo','GASTOS VARIOS')->where('cierre',0)->sum('importe');
        $datosCierreCaja->gastos=$datosmovimientosgastos;

        $datosmovimientosimportefinal=MovimientoCajaTafi::where('cierre',0)->orderBy('id','DESC')->limit(1)->get();
        $datosCierreCaja->caja_final=$datosmovimientosimportefinal[0]->importe_final;
        $datosCierreCaja->caja_final_fisica=$request->dinerofisico;
        $diferencia=$request->dinerofisico-$datosCierreCaja->caja_final;
        $datosCierreCaja->caja_diferencia=$diferencia;

        $datosCierreCaja->planchas_impresas=0;
        $datosCierreCaja->planchas_dañada=0;
        $datosCierreCaja->cierre=1;
        $datosCierreCaja->observacion=$request->descripcion;

        $datosempresalnf=EmpresasBolTafi::where('nombre_corto','LNF')->get();
        $datosCierreCaja->ganancialnf=(($datosempresalnf[0]->porcentaje)/100)*$request->dinerofisico;

        $datosempresaer=EmpresasBolTafi::where('nombre_corto','ER')->get();
        $datosCierreCaja->gananciaelrayo=(($datosempresaer[0]->porcentaje)/100)*$request->dinerofisico;
        $datosCierreCaja->diez=$request->diez;
        $datosCierreCaja->veinte=$request->veinte;
        $datosCierreCaja->cincuenta=$request->cincuenta;
        $datosCierreCaja->cien=$request->cien;
        $datosCierreCaja->doscientos=$request->doscientos;
        $datosCierreCaja->quinientos=$request->quinientos;
        $datosCierreCaja->mil=$request->mil;
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
    }
     
    
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PlanchaTafi;
use App\User;
use App\Abonado;
use App\TipoAbono;
use App\VentaTafi;
use App\MovimientoCajaTafi;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;

use Laracasts\Flash\Flash;

class PlanchaTafiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

//CREAR LOS ROLES 
    public function impresion(Request $request)
    {
        Permission::Create(['name' =>'nuevo']);
        $admin = Role::find(9);
        $admin->givePermissionTo([
            'nuevo',
                    ]);
/*$nombreImpresora = "POS58";
$connector = new WindowsPrintConnector($nombreImpresora);
$impresora = new Printer($connector);
$impresora->setJustification(Printer::JUSTIFY_CENTER);
$impresora->setTextSize(2, 2);
$impresora->text("Imprimiendo\n");

$impresora->setTextSize(1, 1);
$impresora->text("https://parzibyte.me");
$impresora->feed(5);
$impresora->close();*/
    
   /* error_reporting(0);
    if ($handle = printer_open('\\\192.168.101.254\hp1020')){
        printer_set_option($handle, PRINTER_MODE, 'RAW');
    }
    else{
        echo "no se encotnro imprsora";
    }*/


    //return view('boltafi.impresion');
}

    public function create(Request $request)
    {
        $datos=PlanchaTafi::search($request->name)->where('estado','DISPONIBLE')->orderBy('numero','ASC')->paginate(100);

        return view('boltafi.planchas.create')
            ->with('datos',$datos);
    }
     public function store(Request $request)
    {

        $date = new \DateTime();
        /*VALIDACION -----------------------------------------*/
        $campos=[
            'numdesde'=>'required|integer',
            'numhasta'=>'required|integer',
            'color'=>'required'
            ];

        $Mensaje=["required"=>'El :attribute es requerido'];
        $this->validate($request,$campos,$Mensaje);
        
        if($request->numhasta < $request->numdesde){
            Flash::warning('El numero final debe ser mayor al numero inicial');
            return Redirect('boltafi/planchastafi/create')->with('Mensaje','Cheque de Tercero Ingresado!!!!!');
        }


        $cantidad=$request->numhasta-$request->numdesde;
        $inicial=$request->numdesde;
        for ($i = 0; $i < $cantidad; $i++){
            $numero=PlanchaTafi::where('numero',$inicial)->limit(1)->get();
            if(count($numero)==0){
                $inicial=$inicial+1;    
            }
            else{

                Flash::warning('Ya existe un numero de plancha '.$inicial.' No se creo ninguna plancha');
                return Redirect('boltafi/planchastafi/create');  
            }
        }
        $inicial=$request->numdesde;
        for ($i = 0; $i <= $cantidad; $i++){
            $datos=new PlanchaTafi(request()->except('_token'));
            $datos->numero=$inicial;
            $inicial++;
            $datos->fechacarga=$date;
            $datos->estado="DISPONIBLE";
            $datos->user_id=$request->user;
            $datos->color=$request->color;
            $datos->save();
        }
       

        Flash::success('Se crearon las planchas!!!!');
       
       return Redirect('boltafi/planchastafi/create')->with('Mensaje','Se crearon las planchas!!!!');
    }
    public function mostraranularplancha(Request $request)
    {
        return view('boltafi.planchas.anularplancha');
  
    }

    public function anularplancha(Request $request)
    {

        $fechaanulacion = new \DateTime();
        $estado="ANULADO";
        /*VALIDACION -----------------------------------------*/
        $campos=[
            'numero'=>'required|integer',
            'motivo'=>'required|string|max:50'
                        ];


        $Mensaje=["required"=>'El :attribute es requerido'];
        $this->validate($request,$campos,$Mensaje);
        $datos=PlanchaTafi::where('numero',$request->numero)->get();
        if(count($datos)==0){
            Flash::warning('No existe la plancha para anular ');
            return Redirect('boltafi/planchastafi/mostraranularplancha')->with('Mensaje','Se existe el numero de plancha para anular!!!!');

        }
        else{
            if($datos[0]->estado=='ANULADO'){
                Flash::warning('La Plancha ya se encuentra ANULADA');
            return Redirect('boltafi/planchastafi/mostraranularplancha');
            }
            else{
              if($datos[0]->estado=='DISPONIBLE'){
                $actualizarplancha=PlanchaTafi::where('numero',$request->numero)
                        ->update([
                                'motivo'=>$request->motivo,
                                'fechaanulacion'=>$fechaanulacion,
                                'estado'=>$estado,
                                'user_anulacion'=>$request->user_anulacion,
                                 ]);        
        
                Flash::success('SE ANULO LA PLANCHA NRO '.$request->numero);
                return Redirect('boltafi/planchastafi/mostraranularplancha')->with('Mensaje','Se crearon las planchas!!!!'); 
                }
                else{
                    $actualizarplancha=PlanchaTafi::where('numero',$request->numero)
                        ->update([
                                'motivo'=>$request->motivo,
                                'fechaanulacion'=>$fechaanulacion,
                                'estado'=>$estado,
                                'user_anulacion'=>$request->user_anulacion,
                                 ]);        
                    
                    $datos=VentaTafi::where('numero',$request->numero)->get();
                    $monto=$datos[0]->montototal;
                    $actualizarplancha=VentaTafi::where('numero',$request->numero)
                        ->update([
                                'montototal'=>0,
                                 ]); 
                    $movimientocaja=new MovimientoCajaTafi();    
                    $movimientocaja->tipo='ANULADO';
                    $movimientocaja->tipo_movimiento='EGRESO';
                    $movimientocaja->descripcion='ANULACION DE PLANCHA';
                    $movimientocaja->fecha=$fechaanulacion;

                    $datosmovimientos=MovimientoCajaTafi::orderBy('id','DESC')->limit(1)->get();
                    $movimientocaja->importe=$monto*(-1);
                    $movimientocaja->importe_final=$datosmovimientos[0]->importe_final-$monto;
                    $movimientocaja->user_id=$request->user_id;
                    $movimientocaja->save();

                Flash::success('SE ANULO LA PLANCHA NRO '.$request->numero.' Se actualizo la caja diaria');
                    return Redirect('boltafi/planchastafi/mostraranularplancha');
                }
            }

            }
        
        }

    public function index(Request $request)
    {
    
        $datos=PlanchaTafi::search($request->name)->orderBy('numero','ASC')->paginate(200);

        return view('boltafi.planchas.index')
            ->with('datos',$datos);
    }
    public function venta(Request $request)
    {
        
        $datos=Abonado::search($request->name)->orderBy('dni','ASC');
        return view('boltafi.ventasdeabonos.venta')
            ->with('datos',$datos);
    }
    
    public function buscarabonado(Request $request)
    {

       $datos=Abonado::where('dni',$request->dni)->get();
       $costo="costo".$datos[0]->boleto;

       $valor=TipoAbono::where('id',$datos[0]->tipo_abono_id)->select($costo)->get();
          
        $datos->each(function($datos){
          $datos->tipoabono;
        });

       return $datos;
    }
    
    public function guardarventa(Request $request)
    {
      
    $fecha = date("d-m-Y");
    $fechavencimiento=date("d-m-Y",strtotime($fecha."+ 1 month"));





       $plancha=PlanchaTafi::where('numero',$request->numero)->get();

        $datosmovimientos=MovimientoCajaTafi::where('tipo','INICIAR CAJA')->where('cierre',0)->orderBy('id','DESC')->limit(1)->get();
        if(count($datosmovimientos)==0)
        {
           Flash::warning('DEBE TENER UN INICIO DE CAJA PARA REALIZAR LA VENTA');
                return view('boltafi.cajas.movimiento'); 
        }

       if(count($plancha)==0){
            Flash::warning('NO ESTA DISPONIBLE EL NUMERO DE PLANCHA '.$request->numero.'PARA LA VENTA!!  NO SE REALIZO LA VENTA');
                $datos=Abonado::search($request->name)->orderBy('dni','ASC');
        return view('boltafi.ventasdeabonos.venta')
            ->with('datos',$datos);
        }
        else{
            if($plancha[0]->estado=='ANULADO' || $plancha[0]->estado=='VENDIDO'){
                Flash::warning('EL NUMERO DE PLANCHA ESTA ANULADO O VENDIDO - NRO: '.$request->numero.' NO SE REALIZO LA VENTA');
                $datos=Abonado::search($request->name)->orderBy('dni','ASC');
        return view('boltafi.ventasdeabonos.venta')
            ->with('datos',$datos);
            }
        }

       $abonado=Abonado::where('dni',$request->dni)->limit(1)->get();
       $nomape=$abonado[0]->apellido;
       $tipoabono=TipoAbono::where('id',$abonado[0]->tipo_abono_id)->get();
       $tipo=$tipoabono[0]->tipo;
       if($abonado[0]->boleto=='103')
       {
            $monto=$tipoabono[0]->costo103;
            $codigo=103;
       }
       else{
           if($abonado[0]->boleto=='101'){
                $monto=$tipoabono[0]->costo101;
                $codigo=101;
            } 
            else{
                    $monto=$tipoabono[0]->costo100;
                    $codigo=100;
            }
        }
       
       
       
       
       $datos=new VentaTafi(request()->except('_token'));
       $datos->fecha=new \DateTime();
       $datos->abonado_id=$abonado[0]->id;
       $datos->montototal=$monto;
       $datos->impresion=1;
       $datos->save();

        $actualizarplancha=PlanchaTafi::where('numero',$request->numero)
                        ->update([
                                'estado'=>'VENDIDO',//DESPUES CAMBIAR A DISPONIBLE
                                'motivo'=>'VENTA DE ABONO',
                                'fechaventa'=>new \DateTime(),
                                 ]);
        //movimiento en la caja
        $movimientocaja=new MovimientoCajaTafi();
        $movimientocaja->tipo="VENTA";
        $movimientocaja->tipo_movimiento="INGRESO";
        $movimientocaja->descripcion="VENTA DE ABONO";
        $movimientocaja->fecha=new \DateTime();
        $movimientocaja->importe=$monto;
        $movimientocaja->user_id=$request->user_id;


        $datos=MovimientoCajaTafi::orderBy('id','DESC')->limit(1)->get();

        if(count($datos)==0){
            $movimientocaja->importe_final=$monto;
        }
        else{
            $movimientocaja->importe_final=$datos[0]->importe_final+$monto;
        }
        $movimientocaja->save();

 
        $pdf=\PDF::loadView('boltafi.pdf.abono',['numero'=>$request->numero,'fecha'=>$fecha,'codigo'=>$codigo,'fechavencimiento'=>$fechavencimiento,'monto'=>$monto,'nomape'=>$nomape,'tipo'=>$tipo])
        ->setPaper('a4');
        
        flash::success('SE REALIZO LA VENTA'); 
        return $pdf->download('abono.pdf');
       
        
        flash::success('SE REALIZO LA VENTA'); 
        return Redirect('boltafi/ventasdeabonos/venta');
    }

    public function imprimirabono(Request $request)
    {
        dd("hola");
        $fecha = date("d-m-Y");
        $fechavencimiento=date("d-m-Y",strtotime($fecha."+ 1 month"));





       $plancha=PlanchaTafi::where('numero',$request->numero)->get();

        $datosmovimientos=MovimientoCajaTafi::where('tipo','INICIAR CAJA')->where('cierre',0)->orderBy('id','DESC')->limit(1)->get();
        if(count($datosmovimientos)==0)
        {
           Flash::warning('DEBE TENER UN INICIO DE CAJA PARA REALIZAR LA VENTA');
                return view('boltafi.cajas.movimiento'); 
        }

       if(count($plancha)==0){
            Flash::warning('NO ESTA DISPONIBLE EL NUMERO DE PLANCHA '.$request->numero.'PARA LA VENTA!!  NO SE REALIZO LA VENTA');
                $datos=Abonado::search($request->name)->orderBy('dni','ASC');
        return view('boltafi.ventasdeabonos.venta')
            ->with('datos',$datos);
        }
        else{
            if($plancha[0]->estado=='ANULADO' || $plancha[0]->estado=='VENDIDO'){
                Flash::warning('EL NUMERO DE PLANCHA ESTA ANULADO O VENDIDO - NRO: '.$request->numero.' NO SE REALIZO LA VENTA');
                $datos=Abonado::search($request->name)->orderBy('dni','ASC');
        return view('boltafi.ventasdeabonos.venta')
            ->with('datos',$datos);
            }
        }

       $abonado=Abonado::where('dni',$request->dni)->limit(1)->get();
       $nomape=$abonado[0]->apellido;
       $tipoabono=TipoAbono::where('id',$abonado[0]->tipo_abono_id)->get();
       $tipo=$tipoabono[0]->tipo;
       if($abonado[0]->boleto=='103')
       {
            $monto=$tipoabono[0]->costo103;
            $codigo=103;
       }
       else{
           if($abonado[0]->boleto=='101'){
                $monto=$tipoabono[0]->costo101;
                $codigo=101;
            } 
            else{
                    $monto=$tipoabono[0]->costo100;
                    $codigo=100;
            }
        }
       
       
       
       
       $datos=new VentaTafi(request()->except('_token'));
       $datos->fecha=new \DateTime();
       $datos->abonado_id=$abonado[0]->id;
       $datos->montototal=$monto;
       $datos->impresion=1;
       $datos->save();

        $actualizarplancha=PlanchaTafi::where('numero',$request->numero)
                        ->update([
                                'estado'=>'DISPONIBLE',//DESPUES CAMBIAR A VENDIDO
                                'motivo'=>'VENTA DE ABONO',
                                 ]);
        //movimiento en la caja
        $movimientocaja=new MovimientoCajaTafi();
        $movimientocaja->tipo="VENTA";
        $movimientocaja->tipo_movimiento="INGRESO";
        $movimientocaja->descripcion="VENTA DE ABONO";
        $movimientocaja->fecha=new \DateTime();
        $movimientocaja->importe=$monto;
        $movimientocaja->user_id=$request->user_id;


        $datos=MovimientoCajaTafi::orderBy('id','DESC')->limit(1)->get();

        if(count($datos)==0){
            $movimientocaja->importe_final=$monto;
        }
        else{
            $movimientocaja->importe_final=$datos[0]->importe_final+$monto;
        }
        $movimientocaja->save();

 
       
       
        //return $pdf->stream('archivo.pdf');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DestinoIVTerminal;
use App\VentaIVTerminal;
use App\TransaccionIV;
use App\CodigoServicio;
use App\StockBoleto;
use App\Coche;
use App\PrecioBoleto;
use App\Servicio;
use App\ChoferLeagasLnf;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Laracasts\Flash\Flash;
use Dompdf\Dompdf;

use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;
use Mike42\Escpos\CapabilityProfile;

use Mike42\Escpos\Printer;

class BolTerminalController extends Controller
{

     public function venta()
    {
        $destinos=DestinoIVTerminal::orderBy('tarifa','ASC')->get();
        //$destinos=DestinoIVTerminal::orderBy('nombre','ASC')->pluck('nombre','id');
        return view('bolterminal.idavuelta.venta')
      //  return view('bolterminal.idavuelta.impresion')
        ->with('destinos',$destinos);
        
    }

    public function guardarventa(Request $request)
    {
     


        $fecha=new \DateTime();
        $hoy = date("d-m-Y H:i:s");
        $fecha->modify( 'first day of +1 month' );
        $vencimiento=$fecha->format('d-m-Y');
        
        $destino=DestinoIVTerminal::where('id',$request->destino_id)->get();
        
        $datos=new TransaccionIV();
        $datos->cantidad_pasajes=$request->numero;
        $datos->montounitario=$destino[0]->tarifa*1;
        $datos->montototal=$destino[0]->tarifa*$request->numero;
        $total=$destino[0]->tarifa*$request->numero;
        $datos->fecha=$fecha;
        $datos->fechavencimiento=$fecha->modify( 'first day of +1 month' );
        $datos->destinosivterminal_id=$request->destino_id;
        $datos->user_id=$request->user_id;
        $datos->tipo='VENDIDO';
        $datos->save();
        $transaccion=TransaccionIV::orderBy('id','DESC')->limit(1)->get();
        $transaccioniv_id=$transaccion[0]->id;
        $ventas=VentaIVTerminal::orderBy('id','DESC')->limit(1)->get();
        $cantidad=count($ventas);
        

        if($cantidad==0){
            $nroboleto=1000;
          }
        else{
            $nroboleto=$ventas[0]->nroboleto+1;
        }
        
        for($i=0;$i<$request->numero;$i++){
            $datos=new VentaIVTerminal();
            $datos->nroboleto=$nroboleto+$i;
            $datos->transaccioniv_id=$transaccioniv_id;
            $datos->save();

            //IMPRESION DEL BOLETO
            // boleto 1
            //$nombreImpresora = "\\\\192.168.101.217\\TERMICA";
            $nombreImpresora = "TERMICA";
            //$connector = new NetworkPrintConnector("http://192.168.101.117", 8000);
            //$connector = new WindowsPrintConnector($nombreImpresora);
            //$impresora = new Printer($connector);


            $profile =CapabilityProfile::load("simple");
        $connector=new WindowsPrintConnector("smb://Ale:123@192.168.101.217/termica");
        $impresora = new Printer($connector,$profile);
            $impresora->setJustification(Printer::JUSTIFY_CENTER);
            $impresora->setTextSize(2, 2);
            $impresora->text("LA NUEVA");
            /*$impresora->text("\n");
            $impresora->text("FOURNIER");
            $impresora->text("\n");
            $impresora->setTextSize(1, 1);
            $impresora->text($hoy);
            $impresora->text("\n");
            $impresora->text("\n");
            $impresora->text("COMPROBANTE DE VIAJE");
            $impresora->text("\n");
            $impresora->setTextSize(2, 2);
            $impresora->text("NUMERO:".$datos->nroboleto);
            $impresora->text("\n");
            $impresora->text("\n");
            $impresora->setTextSize(1, 1);
            $impresora->text("ORIGEN: S. M. TUCUMÁN");
            $impresora->text("\n");
            $impresora->text("DESTINO: ".$destino[0]->nombre);
            $impresora->text("\n");
            $impresora->text("VENCE: ".$vencimiento);
            $impresora->text("\n");
            $impresora->text("\n");
            $impresora->setTextSize(2, 2);
            $impresora->text("TARIFA: $".$destino[0]->tarifa);
            $impresora->text("\n");
            $impresora->text("\n");
            $impresora->text("---------------");
            //boleto 2
            $impresora->text("\n");
            $impresora->text("\n");
            $impresora->text("\n");
            $impresora->setTextSize(2, 2);
            $impresora->text("LA NUEVA");
            $impresora->text("\n");
            $impresora->text("FOURNIER");
            $impresora->text("\n");
            $impresora->setTextSize(1, 1);
            $impresora->text($hoy);
            $impresora->text("\n");
            $impresora->text("\n");
            $impresora->text("COMPROBANTE DE VIAJE");
            $impresora->text("\n");
            $impresora->setTextSize(2, 2);
            $impresora->text("NUMERO:".$datos->nroboleto);
            $impresora->text("\n");
            $impresora->text("\n");
            $impresora->setTextSize(1, 1);
            $impresora->text("DESTINO: ".$destino[0]->nombre);
            $impresora->text("\n");
            $impresora->text("ORIGEN: S. M. TUCUMÁN");
            $impresora->text("\n");
            $impresora->text("VENCE: ".$vencimiento);
            $impresora->text("\n");
            $impresora->text("\n");
            $impresora->setTextSize(2, 2);
            $impresora->text("TARIFA: $".$destino[0]->tarifa);
            $impresora->text("\n");
            $impresora->text("\n");
            $impresora->text("\n");
            $impresora->setTextSize(2, 2);
            $impresora->text("---------------");
            $impresora->text("TOTAL $".$total);
            $impresora->text("\n");
            $impresora->text("---------------");*/
            $impresora->text("\n");
            $impresora->text("\n");
            $impresora->feed(5);
            $impresora->close();
            
        }


        /*
        $nombreImpresora = "TERMICA";
        $connector = new WindowsPrintConnector($nombreImpresora);
        $impresora = new Printer($connector);
        $impresora->setJustification(Printer::JUSTIFY_CENTER);
        $impresora->setTextSize(1, 1);
        $impresora->text("LA NUEVA FOURNIER");
        $impresora->text("\n");
        $impresora->text("COMPROBANTE DE VIAJE");
        $impresora->text("\n");
        $impresora->text($hoy);
        $impresora->text("\n");
        $impresora->text("NUMERO: 2123");

        $impresora->feed(5);
$impresora->close();
dd('llego aca');*/






    }


    //**********************************************************
    //*********** MODULO RECAUDACION ---------------------------
    //----------------------------------------------------------

    public function cargarboletos()
    {
        
        $datos1=CodigoServicio::orderBy('cod_servicio','ASC')->get();
        return view('bolterminal.recaudacion.cargarboletos')
                ->with('datos1',$datos1);
        
    }
    public function guardarcargarboletos(Request $request)
    {
        
        /*VALIDACION -----------------------------------------*/
        $campos=[
            'codigo'=>'required',
            'serie'=>'required|integer',
            'inicio'=>'required|integer',
            ];
        $Mensaje=["required"=>'El :attribute es requerido'];
        $this->validate($request,$campos,$Mensaje);
    
        $inicial=$request->inicio;
        for($i=0;$i<40;$i++){
            $datos=new StockBoleto();    
            $datos->inicio=$inicial;     
            $numero_con_ceros_inicio = str_pad($datos->inicio, 5, '0', STR_PAD_LEFT);
            $datos->fin=$inicial+499;
            $numero_con_ceros_fin = str_pad($datos->fin, 5, '0', STR_PAD_LEFT); // 
            $inicial=$datos->fin+1;     

            $inicio = $datos->serie . $numero_con_ceros_inicio; // Concatena el serie al principio
            $fin = $datos->serie . $numero_con_ceros_fin; // Concatena el serie al principio

            $consulta=StockBoleto::where('codigo',$request->codigo)->where('serie',$request->serie)->where('inicio',$inicio)->get();
        if(count($consulta)==0){
            $datos->fecha=$date = new \DateTime();
            $datos->inicio= $inicio;
            $datos->fin= $fin;
            $datos->actual= $inicio;
            $datos->codigo=$request->codigo;
            $datos->serie=$request->serie;
            $datos->activo=0; //esta activo 0 no activo 1
            $datos->save();
            /*Flash::success('Stock agregado correctamente');
            return view('bolterminal.recaudacion.cargarboletos');*/
        }
        else{
            $datos1=CodigoServicio::orderBy('cod_servicio','ASC')->get();
            Flash::warning('Boleto REPETIDO, NO FUE AGREGADO!!!');
            return view('bolterminal.recaudacion.cargarboletos')
                ->with('datos1',$datos1);
        }
        }
   
        $datos1=CodigoServicio::orderBy('cod_servicio','ASC')->get();
            Flash::success('Stock agregado correctamente!!!');
            return view('bolterminal.recaudacion.cargarboletos')
                ->with('datos1',$datos1);
    }
    public function recaudar()
    {

        $choferes=ChoferLeagasLnf::where('activo','2')->orderBy('nombre','ASC')->get(); // 2 son los choferes que recaudan para jorge
        //activo = a 0 inactivo 1activo 2 recaudan jorge 3 recaudan comun
        
        //esto es para las relacion de la tabla acoplados con camion
      $servicios=Servicio::select('servicios.id as idserv','choferesleagaslnf.nombre as chofernombre','choferesleagaslnf.apellido as choferapellido','choferesleagaslnf.legajo as choferlegajo','codigoservicios.cod_servicio as codigoservicio','servicios.fechaservicio as fechaservicio','users.name as usuarionombre')
            ->join('choferesleagaslnf','servicios.choferesleagaslnf_id','=','choferesleagaslnf.id')
            ->join('coches','servicios.coche_id','=','coches.id')
            ->join('codigoservicios','servicios.codservicio_id','=','codigoservicios.id')
            ->join('users','servicios.user_id','=','users.id')
            ->where('servicios.estado','ASIGNADO')
            ->whereNotNull('servicios.choferesleagaslnf_id')
            ->get();

       return view('bolterminal.recaudacion.recaudar')
                ->with('servicios',$servicios);
        
    }
    public function asignarboletos()
    {
        $choferes=ChoferLeagasLnf::where('activo','2')->orderBy('apellido','ASC')->get(); // 2 son los choferes que recaudan para jorge
        //activo = a 0 inactivo 1activo 2 recaudan jorge 3 recaudan comun
        $stockboletos=StockBoleto::where('activo','0')->where('chofer_id','=',null)->orderby('inicio')->get();

        //esto es para las relacion de la tabla acoplados con camion
/*        $choferes->each(function($choferes){
            $choferes->empresa;
            
       });*/
       return view('bolterminal.recaudacion.asignarboletos')
                ->with('stockboletos',$stockboletos)
                ->with('choferes',$choferes);
        
    }
public function guardarasignarboletos(Request $request)
    {
        
                /*VALIDACION -----------------------------------------*/
        $campos=[
            'chofer_id'=>'required',
            'boleto_id'=>'required',
        ];
        $Mensaje=["required"=>'El :attribute es requerido'];
        $this->validate($request,$campos,$Mensaje);
      
      $posicion=StockBoleto::where('id',$request->boleto_id)->get();
      $codigo=$posicion[0]->codigo;
      
      $boletoschofer=Stockboleto::where('codigo',$codigo)->where('chofer_id',$request->chofer_id)->where('activo',1)->get();
      //dd($boletoschofer);

      $contador=count($boletoschofer);
     // dd($contador);
      if($contador==NULL){
        $boletoasignado=Stockboleto::where('chofer_id',$request->chofer_id)->where('activo',2)->get();
        if(count($boletoasignado)==NULL){
            $actualizarstockboletos=StockBoleto::where('id',$request->boleto_id)
            ->update([
                    'chofer_id'=>$request->chofer_id,
                    'posicion'=>1,
                    'activo'=>1
                     ]);
        }
        else{
            dd('no puede asignar boletos, porque tiene un servicio por recaudar');
        }
      }
      if($contador==1){
        //$posicion=StockBoleto::where('id',$request->boleto_id)->get();
        //dd($boletoschofer[0]->posicion);
        if($boletoschofer[0]->posicion==1){
            $actualizarstockboletos=StockBoleto::where('id',$request->boleto_id)
            ->update([
                        'chofer_id'=>$request->chofer_id,
                        'posicion'=>2,
                        'activo'=>1
                     ]);
        }
        if($boletoschofer[0]->posicion==2){
            $actualizarstockboletos=StockBoleto::where('id',$request->boleto_id)
            ->update([
                        'chofer_id'=>$request->chofer_id,
                        'posicion'=>1,
                        'activo'=>1
                     ]);
        }
      }

      if($contador==2){
        $choferes=ChoferLeagasLnf::where('activo','2')->orderBy('apellido','ASC')->get(); // 2 son los choferes que recaudan para jorge
        //activo = a 0 inactivo 1activo 2 recaudan jorge 3 recaudan comun
        $stockboletos=StockBoleto::where('activo','0')->where('chofer_id','=',null)->get();
       Flash::warning('NO SE ASIGNO NINGUN BOLETO, YA TIENE 2 BOLETOS ASIGNADO');
        return view('bolterminal.recaudacion.asignarboletos')
                ->with('stockboletos',$stockboletos)
                ->with('choferes',$choferes);
      }

      
      /*$actualizarstockboletos=StockBoleto::where('id',$request->boleto_id)
                        ->update([
                                'chofer_id'=>$request->chofer_id,
                                'activo'=>1
                                 ]);
*/
    $choferes=ChoferLeagasLnf::where('activo','2')->orderBy('apellido','ASC')->get(); // 2 son los choferes que recaudan para jorge
        //activo = a 0 inactivo 1activo 2 recaudan jorge 3 recaudan comun
        $stockboletos=StockBoleto::where('activo','0')->where('chofer_id','=',null)->get();
       Flash::success('Stock agregado correctamente');
        return view('bolterminal.recaudacion.asignarboletos')
                ->with('stockboletos',$stockboletos)
                ->with('choferes',$choferes);

    }
    public function asignarservicio()
    {
        $choferes=ChoferLeagasLnf::where('activo','2')->orderBy('apellido','ASC')->get(); // 2 son los choferes que recaudan para jorge
        //activo = a 0 inactivo 1activo 2 recaudan jorge 3 recaudan comun
        $codservicio=CodigoServicio::orderby('cod_servicio')->get();
        $coche=Coche::where('empresa_id',1)->orderby('interno')->get();

       return view('bolterminal.recaudacion.asignarservicio')
                ->with('codservicio',$codservicio)
                ->with('coche',$coche)
                ->with('choferes',$choferes);
        
    }

    public function guardarasignarservicios(Request $request)
    {
                /*VALIDACION -----------------------------------------*/
        // dd($request);  
        $campos=[
            'choferesleagaslnf_id'=>'required',
            'codservicio_id'=>'required',
            'coche_id'=>'required',
            'fechaservicio'=>'required',
            'dia'=>'required'
        ];
        $Mensaje=["required"=>'El :attribute es requerido'];
        $this->validate($request,$campos,$Mensaje);

      
        $bolchofer=Servicio::where('estado','ASIGNADO')->where('choferesleagaslnf_id',$request->choferesleagaslnf_id)->get();
        //dd($bolchofer);

        if(count($bolchofer)==1)
        {
            Flash::error('El chofer ya tiene un sevicio asignado');
        $choferes=ChoferLeagasLnf::where('activo','2')->orderBy('apellido','ASC')->get(); // 2 son los choferes que recaudan para jorge
        //activo = a 0 inactivo 1activo 2 recaudan jorge 3 recaudan comun
        $codservicio=CodigoServicio::orderby('descripcion')->get();
        $coche=Coche::where('empresa_id',1)->orderby('interno')->get();
       return view('bolterminal.recaudacion.asignarservicio')
                ->with('codservicio',$codservicio)
                ->with('coche',$coche)
            ->with('choferes',$choferes);
        }
        //dd($request->fechaservicio);
        //dd($request->codservicio_id);
        $servicios=Servicio::where('fechaservicio',$request->fechaservicio)->where('codigoservicio_id',$request->codservicio_id)->get();
        
        $cantidad=count($servicios);
  
        if($cantidad==1){
            Flash::error('Ya existe el Codigo de Servicio para la fecha seleccionada, vuelva a cargar el servicio');
            $choferes=ChoferLeagasLnf::where('activo','2')->orderBy('apellido','ASC')->get(); // 2 son los choferes que recaudan para jorge
            //activo = a 0 inactivo 1activo 2 recaudan jorge 3 recaudan comun
            $codservicio=CodigoServicio::orderby('descripcion')->get();
            $coche=Coche::where('empresa_id',1)->orderby('interno')->get();
            return view('bolterminal.recaudacion.asignarservicio')
                ->with('codservicio',$codservicio)
                ->with('coche',$coche)
            ->with('choferes',$choferes);
        }       
        else
        {
            $servicio=new Servicio(request()->except('_token'));
            $servicio->estado="ASIGNADO";
            $servicio->fechaasignacion=$date = new \DateTime();
            $servicio->save();
            $servicioid=Servicio::orderBy('id','DESC')->limit(1)->get();
            
            $boletosasignados=StockBoleto::where('chofer_id',$request->choferesleagaslnf_id)->where('activo',1)->get();

            foreach ($boletosasignados as $datos) {
            switch($datos->codigo){
                case 'cod6':
                    if($datos->posicion==1){
                        
                        $servicio->inicialcod6a=$datos->actual;
                        $actualizastock=StockBoleto::where('id',$datos->id)
                        ->update([
                                'servicio_id'=>$servicioid[0]->id,
                                'activo'=>2
                                 ]);
                    }
                    else{

                        $servicio->inicialcod6b=$datos->actual;
                        $actualizastock=StockBoleto::where('id',$datos->id)
                        ->update([
                                'servicio_id'=>$servicioid[0]->id,
                                'activo'=>2
                                 ]);
                    }
                    break;
                case 'cod7':
                    if($datos->posicion==1){
                        
                        $servicio->inicialcod7a=$datos->actual;
                        $actualizastock=StockBoleto::where('id',$datos->id)
                        ->update([
                                'servicio_id'=>$servicioid[0]->id,
                                'activo'=>2
                                 ]);
                    }
                    else{

                        $servicio->inicialcod7b=$datos->actual;
                        $actualizastock=StockBoleto::where('id',$datos->id)
                        ->update([
                                'servicio_id'=>$servicioid[0]->id,
                                'activo'=>2
                                 ]);
                    }
                    break;
                case 'cod8':
                    if($datos->posicion==1){
                        
                        $servicio->inicialcod8a=$datos->actual;
                        $actualizastock=StockBoleto::where('id',$datos->id)
                        ->update([
                                'servicio_id'=>$servicioid[0]->id,
                                'activo'=>2
                                 ]);
                    }
                    else{

                        $servicio->inicialcod8b=$datos->actual;
                        $actualizastock=StockBoleto::where('id',$datos->id)
                        ->update([
                                'servicio_id'=>$servicioid[0]->id,
                                'activo'=>2
                                 ]);
                }
                break;
                case 'cod10':
                    if($datos->posicion==1){
                        
                        $servicio->inicialcod10a=$datos->actual;
                        $actualizastock=StockBoleto::where('id',$datos->id)
                        ->update([
                                'servicio_id'=>$servicioid[0]->id,
                                'activo'=>2
                                 ]);
                    }
                    else{

                        $servicio->inicialcod10b=$datos->actual;
                        $actualizastock=StockBoleto::where('id',$datos->id)
                        ->update([
                                'servicio_id'=>$servicioid[0]->id,
                                'activo'=>2
                                 ]);
                    }
                    break;
                case 'cod12':
                    if($datos->posicion==1){
                        
                        $servicio->inicialcod12a=$datos->actual;
                        $actualizastock=StockBoleto::where('id',$datos->id)
                        ->update([
                                'servicio_id'=>$servicioid[0]->id,
                                'activo'=>2
                                 ]);
                    }
                    else{

                        $servicio->inicialcod12b=$datos->actual;
                        $actualizastock=StockBoleto::where('id',$datos->id)
                        ->update([
                                'servicio_id'=>$servicioid[0]->id,
                                'activo'=>2
                                 ]);
                    }
                    break;
                case 'cod14':
                    if($datos->posicion==1){
                        
                        $servicio->inicialcod14a=$datos->actual;
                        $actualizastock=StockBoleto::where('id',$datos->id)
                        ->update([
                                'servicio_id'=>$servicioid[0]->id,
                                'activo'=>2
                                 ]);
                    }
                    else{

                        $servicio->inicialcod14b=$datos->actual;
                        $actualizastock=StockBoleto::where('id',$datos->id)
                        ->update([
                                'servicio_id'=>$servicioid[0]->id,
                                'activo'=>2
                                 ]);
                    }
                    break;
                case 'cod15':
                    if($datos->posicion==1){
                        
                        $servicio->inicialcod15a=$datos->actual;
                        $actualizastock=StockBoleto::where('id',$datos->id)
                        ->update([
                                'servicio_id'=>$servicioid[0]->id,
                                'activo'=>2
                                 ]);
                    }
                    else{

                        $servicio->inicialcod15b=$datos->actual;
                        $actualizastock=StockBoleto::where('id',$datos->id)
                        ->update([
                                'servicio_id'=>$servicioid[0]->id,
                                'activo'=>2
                                 ]);
                    }
                    break;
                case 'cod18':
                    if($datos->posicion==1){
                        
                        $servicio->inicialcod18a=$datos->actual;
                        $actualizastock=StockBoleto::where('id',$datos->id)
                        ->update([
                                'servicio_id'=>$servicioid[0]->id,
                                'activo'=>2
                                 ]);
                    }
                    else{

                        $servicio->inicialcod18b=$datos->actual;
                        $actualizastock=StockBoleto::where('id',$datos->id)
                        ->update([
                                'servicio_id'=>$servicioid[0]->id,
                                'activo'=>2
                                 ]);
                    }
                    break;
                case 'cod21':
                    if($datos->posicion==1){
                        
                        $servicio->inicialcod21a=$datos->actual;
                        $actualizastock=StockBoleto::where('id',$datos->id)
                        ->update([
                                'servicio_id'=>$servicioid[0]->id,
                                'activo'=>2
                                 ]);
                    }
                    else{

                        $servicio->inicialcod21b=$datos->actual;
                        $actualizastock=StockBoleto::where('id',$datos->id)
                        ->update([
                                'servicio_id'=>$servicioid[0]->id,
                                'activo'=>2
                                 ]);
                    }
                    break;
                case 'cod23':
                    if($datos->posicion==1){
                        
                        $servicio->inicialcod23a=$datos->actual;
                        $actualizastock=StockBoleto::where('id',$datos->id)
                        ->update([
                                'servicio_id'=>$servicioid[0]->id,
                                'activo'=>2
                                 ]);
                    }
                    else{

                        $servicio->inicialcod23b=$datos->actual;
                        $actualizastock=StockBoleto::where('id',$datos->id)
                        ->update([
                                'servicio_id'=>$servicioid[0]->id,
                                'activo'=>2
                                 ]);
                    }
                    break;
                case 'cod27':
                    if($datos->posicion==1){
                        
                        $servicio->inicialcod27a=$datos->actual;
                        $actualizastock=StockBoleto::where('id',$datos->id)
                        ->update([
                                'servicio_id'=>$servicioid[0]->id,
                                'activo'=>2
                                 ]);
                    }
                    else{

                        $servicio->inicialcod27b=$datos->actual;
                        $actualizastock=StockBoleto::where('id',$datos->id)
                        ->update([
                                'servicio_id'=>$servicioid[0]->id,
                                'activo'=>2
                                 ]);
                    }
                    break;
                case 'cod30':
                    if($datos->posicion==1){
                        
                        $servicio->inicialcod30a=$datos->actual;
                        $actualizastock=StockBoleto::where('id',$datos->id)
                        ->update([
                                'servicio_id'=>$servicioid[0]->id,
                                'activo'=>2
                                 ]);
                    }
                    else{

                        $servicio->inicialcod30b=$datos->actual;
                        $actualizastock=StockBoleto::where('id',$datos->id)
                        ->update([
                                'servicio_id'=>$servicioid[0]->id,
                                'activo'=>2
                                 ]);
                    }
                    break;
                case 'cod32':
                    if($datos->posicion==1){
                        
                        $servicio->inicialcod32a=$datos->actual;
                        $actualizastock=StockBoleto::where('id',$datos->id)
                        ->update([
                                'servicio_id'=>$servicioid[0]->id,
                                'activo'=>2
                                 ]);
                    }
                    else{

                        $servicio->inicialcod32b=$datos->actual;
                        $actualizastock=StockBoleto::where('id',$datos->id)
                        ->update([
                                'servicio_id'=>$servicioid[0]->id,
                                'activo'=>2
                                 ]);
                    }
                    break;
                case 'abono':
                    if($datos->posicion==1){
                        
                        $servicio->inicialabonoa=$datos->actual;
                        $actualizastock=StockBoleto::where('id',$datos->id)
                        ->update([
                                'servicio_id'=>$servicioid[0]->id,
                                'activo'=>2
                                 ]);
                    }
                    else{

                        $servicio->inicialabonob=$datos->actual;
                        $actualizastock=StockBoleto::where('id',$datos->id)
                        ->update([
                                'servicio_id'=>$servicioid[0]->id,
                                'activo'=>2
                                 ]);
                    }
                    break;
            } // este es el cierre del foreach
            
        } // este es el cierre del swictch
    } //este es el cierre del if


$servicio->save();

$servicios=Servicio::select('*','codigoservicios.cod_servicio as cservicio','servicios.id as idserv')->orderBy('idserv','ASC')->join('codigoservicios','servicios.codigoservicio_id','=','codigoservicios.id')->limit(1)->get();
$fechaserv=$servicios[0]->fechaservicio;
$codigoserv=$servicios[0]->cservicio;

 $pdf=\PDF::loadView('bolterminal.reportes.apertura',['servicios'=>$servicios,'fechaserv'=>$fechaserv,'codigoserv'=>$codigoserv])
        ->setPaper('a4','landscape');
        return $pdf->download('apertura.pdf');


        }

public function recaudarservicio($idserv)
    {
        
        $servicios=Servicio::where('id',$idserv)->get();
        $precioboleto=PrecioBoleto::where('estado',1)->get();
        $preciocod6=$precioboleto[0]->cod6;
        $preciocod7=$precioboleto[0]->cod7;
        $preciocod8=$precioboleto[0]->cod8;
        $preciocod10=$precioboleto[0]->cod10;
        $preciocod12=$precioboleto[0]->cod12;
        $preciocod14=$precioboleto[0]->cod14;
        $preciocod15=$precioboleto[0]->cod15;
        $preciocod18=$precioboleto[0]->cod18;
        $preciocod21=$precioboleto[0]->cod21;
        $preciocod23=$precioboleto[0]->cod23;
        $preciocod27=$precioboleto[0]->cod27;
        $preciocod30=$precioboleto[0]->cod30;
        $preciocod32=$precioboleto[0]->cod32;
        $precioabono=$precioboleto[0]->abonos;


        return view('bolterminal.recaudacion.recaudarservicio')
                ->with('preciocod6',$preciocod6)
                ->with('preciocod7',$preciocod7)
                ->with('preciocod8',$preciocod8)
                ->with('preciocod10',$preciocod10)
                ->with('preciocod12',$preciocod12)
                ->with('preciocod14',$preciocod14)
                ->with('preciocod15',$preciocod15)
                ->with('preciocod18',$preciocod18)
                ->with('preciocod21',$preciocod21)
                ->with('preciocod23',$preciocod23)
                ->with('preciocod27',$preciocod27)
                ->with('preciocod30',$preciocod30)
                ->with('preciocod32',$preciocod32)
                ->with('precioabono',$precioabono)
                ->with('servicios',$servicios);
        
    }
public function guardarrecaudacionchofer(Request $request)
{
$finalcod6a=0;
$finalcod6b=0;
$finalcod7a=0;
$finalcod7b=0;
$finalcod8a=0;
$finalcod8b=0;
$finalcod10a=0;
$finalcod10b=0;
$finalcod12a=0;
$finalcod12b=0;
$finalcod14a=0;
$finalcod14b=0;
$finalcod15a=0;
$finalcod15b=0;
$finalcod18a=0;
$finalcod18b=0;
$finalcod21a=0;
$finalcod21b=0;
$finalcod23a=0;
$finalcod23b=0;
$finalcod27a=0;
$finalcod27b=0;
$finalcod30a=0;
$finalcod30b=0;
$finalcod32a=0;
$finalcod32b=0;
$finalabonoa=0;
$finalabonob=0;
$recaudacioncod6a=0;
$recaudacioncod7a=0;
$recaudacioncod8a=0;
$recaudacioncod10a=0;
$recaudacioncod12a=0;
$recaudacioncod14a=0;
$recaudacioncod15a=0;
$recaudacioncod18a=0;
$recaudacioncod21a=0;
$recaudacioncod23a=0;
$recaudacioncod27a=0;
$recaudacioncod30a=0;
$recaudacioncod32a=0;
$recaudacionabonosa=0;
$recaudacioncod6b=0;
$recaudacioncod7b=0;
$recaudacioncod8b=0;
$recaudacioncod10b=0;
$recaudacioncod12b=0;
$recaudacioncod14b=0;
$recaudacioncod15b=0;
$recaudacioncod18b=0;
$recaudacioncod21b=0;
$recaudacioncod23b=0;
$recaudacioncod27b=0;
$recaudacioncod30b=0;
$recaudacioncod32b=0;
$recaudacionabonosb=0;

$precioboleto=PrecioBoleto::where('estado',1)->get();
    $boletosservicio=StockBoleto::where('servicio_id',$request->id)->get();
    foreach ($boletosservicio as $datos)
    {
        switch($datos->codigo)
        {
            case 'cod6':
            if($datos->posicion==1){
                if($request->fincod6a==0){
                    $finalcod6a=500;
                    $activo=3;
                    $final=$datos->fin-$datos->actual+1;
                    $recaudacioncod6a=$final*$precioboleto[0]->cod6;
                }
                else
                {
                    $finalcod6a=$request->fincod6a;
                    $recaudacioncod6a=$request->cod6a;
                    $activo=1;
                }

                $actualizastock=StockBoleto::where('id',$datos->id)
                    ->update([
                    'actual'=>$finalcod6a,
                    'servicio_id'=>null,
                    'activo'=>$activo
                     ]);
            }
            else{
                if($request->fincod6b==0){
                    $finalcod6b=500;
                    $activo=3;
                    $final=$datos->fin-$datos->actual+1;
                    $recaudacioncod6b=$final*$precioboleto[0]->cod6;
                }
                else
                {
                    $finalcod6b=$request->fincod6b;
                    $recaudacioncod6b=$request->cod6b;
                    $activo=1;
                }
                $actualizastock=StockBoleto::where('id',$datos->id)
                    ->update([
                    'actual'=>$finalcod6b,
                    'servicio_id'=>null,
                    'activo'=>$activo
                     ]);
            }
            break;
            case 'cod7':
                if($datos->posicion==1){
                    if($request->fincod7a==0){
                        $finalcod7a=500;
                        $activo=3;
                        $final=$datos->fin-$datos->actual+1;
                        $recaudacioncod7a=$final*$precioboleto[0]->cod7;
                    }
                    else
                    {
                        $finalcod7a=$request->fincod7a;
                        $recaudacioncod7a=$request->cod7a;
                        $activo=1;
                    }
                    $actualizastock=StockBoleto::where('id',$datos->id)
                    ->update([
                            'actual'=>$finalcod7a,
                            'servicio_id'=>null,
                            'activo'=>$activo
                             ]);
                }
                else{
                    if($request->fincod7b==0){
                        $finalcod7b=500;
                        $activo=3;
                        $final=$datos->fin-$datos->actual+1;
                        $recaudacioncod7b=$final*$precioboleto[0]->cod7;
                    }
                    else
                    {
                        $finalcod7b=$request->fincod7b;
                        $recaudacioncod7b=$request->cod7b;
                        $activo=1;
                    }
                    $actualizastock=StockBoleto::where('id',$datos->id)
                        ->update([
                            'actual'=>$finalcod7b,
                            'servicio_id'=>null,
                            'activo'=>$activo
                             ]);
                }
            break;
            case 'cod8':
                if($datos->posicion==1){
                    if($request->fincod8a==0){
                        $finalcod8a=500;
                        $activo=3;
                        $final=$datos->fin-$datos->actual+1;
                        $recaudacioncod8a=$final*$precioboleto[0]->cod8;
                    }
                    else
                    {
                        $finalcod8a=$request->fincod8a;
                        $recaudacioncod8a=$request->cod8a;
                        $activo=1;
                    }
                    $actualizastock=StockBoleto::where('id',$datos->id)
                        ->update([
                            'actual'=>$finalcod8a,
                            'servicio_id'=>null,
                            'activo'=>$activo
                             ]);
                }
                else{
                    if($request->fincod8b==0){
                        $finalcod8b=500;
                        $activo=3;
                        $final=$datos->fin-$datos->actual+1;
                        $recaudacioncod8b=$final*$precioboleto[0]->cod8;
                    }
                    else
                    {
                        $finalcod8b=$request->fincod8b;
                        $recaudacioncod8b=$request->cod8b;
                        $activo=1;
                    }
                    $actualizastock=StockBoleto::where('id',$datos->id)
                        ->update([
                            'actual'=>$finalcod8b,
                            'servicio_id'=>null,
                            'activo'=>$activo
                             ]);
                }
            break;
            case 'cod10':
                if($datos->posicion==1){
                    if($request->fincod10a==0){
                        $finalcod10a=500;
                        $activo=3;
                        $final=$datos->fin-$datos->actual+1;
                        $recaudacioncod10a=$final*$precioboleto[0]->cod10;
                    }
                    else
                    {
                        $finalcod10a=$request->fincod10a;
                        $recaudacioncod10a=$request->cod10a;
                        $activo=1;
                    }
                    $actualizastock=StockBoleto::where('id',$datos->id)
                        ->update([
                            'actual'=>$finalcod10a,
                            'servicio_id'=>null,
                            'activo'=>$activo
                             ]);
                }
                else{
                    if($request->fincod10b==0){
                        $finalcod10b=500;
                        $activo=3;
                        $final=$datos->fin-$datos->actual+1;
                        $recaudacioncod10b=$final*$precioboleto[0]->cod10;
                    }
                    else
                    {
                        $finalcod10b=$request->fincod10b;
                        $recaudacioncod10b=$request->cod10b;
                        $activo=1;
                    }
                    $actualizastock=StockBoleto::where('id',$datos->id)
                        ->update([
                            'actual'=>$finalcod10b,
                            'servicio_id'=>null,
                            'activo'=>$activo
                             ]);
                }
            break;
            case 'cod12':
                if($datos->posicion==1){
                    if($request->fincod12a==0){
                        $finalcod12a=500;
                        $activo=3;
                        $final=$datos->fin-$datos->actual+1;
                        $recaudacioncod12a=$final*$precioboleto[0]->cod12;
                    }
                    else
                    {
                        $finalcod12a=$request->fincod12a;
                        $recaudacioncod12a=$request->cod12a;
                        $activo=1;
                    }
                    $actualizastock=StockBoleto::where('id',$datos->id)
                        ->update([
                            'actual'=>$finalcod12a,
                            'servicio_id'=>null,
                            'activo'=>$activo
                             ]);
                }
                else{
                    if($request->fincod12b==0){
                        $finalcod12b=500;
                        $activo=3;
                        $final=$datos->fin-$datos->actual+1;
                        $recaudacioncod12b=$final*$precioboleto[0]->cod12;
                    }
                    else
                    {
                        $finalcod12b=$request->fincod12b;
                        $recaudacioncod12b=$request->cod12b;
                        $activo=1;
                    }
                    $actualizastock=StockBoleto::where('id',$datos->id)
                        ->update([
                            'actual'=>$finalcod12b,
                            'servicio_id'=>null,
                            'activo'=>$activo
                             ]);
                }
            break;
            case 'cod14':
                if($datos->posicion==1){
                    if($request->fincod14a==0){
                        $finalcod14a=500;
                        $activo=3;
                        $final=$datos->fin-$datos->actual+1;
                        $recaudacioncod14a=$final*$precioboleto[0]->cod14;
                    }
                    else
                    {
                        $finalcod14a=$request->fincod14a;
                        $recaudacioncod14a=$request->cod14a;
                        $activo=1;
                    }
                    $actualizastock=StockBoleto::where('id',$datos->id)
                        ->update([
                            'actual'=>$finalcod14a,
                            'servicio_id'=>null,
                            'activo'=>$activo
                             ]);
                }
                else{
                    if($request->fincod14b==0){
                        $finalcod14b=500;
                        $activo=3;
                        $final=$datos->fin-$datos->actual+1;
                        $recaudacioncod14b=$final*$precioboleto[0]->cod14;
                    }
                    else
                    {
                        $finalcod14b=$request->fincod14b;
                        $recaudacioncod14b=$request->cod14b;
                        $activo=1;
                    }
                    $actualizastock=StockBoleto::where('id',$datos->id)
                        ->update([
                            'actual'=>$finalcod14b,
                            'servicio_id'=>null,
                            'activo'=>$activo
                             ]);
                }
            break;
            case 'cod15':
                if($datos->posicion==1){
                    if($request->fincod15a==0){
                        $finalcod15a=500;
                        $activo=3;
                        $final=$datos->fin-$datos->actual+1;
                        $recaudacioncod15a=$final*$precioboleto[0]->cod15;
                    }
                    else
                    {
                        $finalcod15a=$request->fincod15a;
                        $recaudacioncod15a=$request->cod15a;
                        $activo=1;
                    }
                    $actualizastock=StockBoleto::where('id',$datos->id)
                        ->update([
                            'actual'=>$finalcod15a,
                            'servicio_id'=>null,
                            'activo'=>$activo
                             ]);
                }
                else{
                    if($request->fincod15b==0){
                        $finalcod15b=500;
                        $activo=3;
                        $final=$datos->fin-$datos->actual+1;
                        $recaudacioncod15b=$final*$precioboleto[0]->cod15;
                    }
                    else
                    {
                        $finalcod15b=$request->fincod15b;
                        $recaudacioncod15b=$request->cod15b;
                        $activo=1;
                    }
                    $actualizastock=StockBoleto::where('id',$datos->id)
                        ->update([
                            'actual'=>$finalcod15b,
                            'servicio_id'=>null,
                            'activo'=>$activo
                             ]);
                }
            break;
            case 'cod18':
                if($datos->posicion==1){
                    if($request->fincod18a==0){
                        $finalcod18a=500;
                        $activo=3;
                        $final=$datos->fin-$datos->actual+1;
                        $recaudacioncod18a=$final*$precioboleto[0]->cod18;
                    }
                    else
                    {
                        $finalcod18a=$request->fincod18a;
                        $recaudacioncod18a=$request->cod18a;
                        $activo=1;
                    }
                    $actualizastock=StockBoleto::where('id',$datos->id)
                        ->update([
                            'actual'=>$finalcod18a,
                            'servicio_id'=>null,
                            'activo'=>$activo
                             ]);
                }
                else{
                    if($request->fincod18b==0){
                        $finalcod18b=500;
                        $activo=3;
                        $final=$datos->fin-$datos->actual+1;
                        $recaudacioncod18b=$final*$precioboleto[0]->cod18;
                    }
                    else
                    {
                        $finalcod18b=$request->fincod18b;
                        $recaudacioncod18b=$request->cod18b;
                        $activo=1;
                    }
                    $actualizastock=StockBoleto::where('id',$datos->id)
                        ->update([
                            'actual'=>$finalcod18b,
                            'servicio_id'=>null,
                            'activo'=>$activo
                             ]);
                }
            break;
            case 'cod21':
                if($datos->posicion==1){
                    if($request->fincod21a==0){
                        $finalcod21a=500;
                        $activo=3;
                        $final=$datos->fin-$datos->actual+1;
                        $recaudacioncod21a=$final*$precioboleto[0]->cod21;
                    }
                    else
                    {
                        $finalcod21a=$request->fincod21a;
                        $recaudacioncod21a=$request->cod21a;
                        $activo=1;
                    }
                    $actualizastock=StockBoleto::where('id',$datos->id)
                        ->update([
                            'actual'=>$finalcod21a,
                            'servicio_id'=>null,
                            'activo'=>$activo
                             ]);
                }
                else{
                    if($request->fincod21b==0){
                        $finalcod21b=500;
                        $activo=3;
                        $final=$datos->fin-$datos->actual+1;
                        $recaudacioncod21b=$final*$precioboleto[0]->cod21;
                    }
                    else
                    {
                        $finalcod21b=$request->fincod21b;
                        $recaudacioncod21b=$request->cod21b;
                        $activo=1;
                    }
                    $actualizastock=StockBoleto::where('id',$datos->id)
                        ->update([
                            'actual'=>$finalcod21b,
                            'servicio_id'=>null,
                            'activo'=>$activo
                             ]);
                }
            break;
            case 'cod23':
                if($datos->posicion==1){
                    if($request->fincod23a==0){
                        $finalcod23a=500;
                        $activo=3;
                        $final=$datos->fin-$datos->actual+1;
                        $recaudacioncod23a=$final*$precioboleto[0]->cod23;
                    }
                    else
                    {
                        $finalcod23a=$request->fincod23a;
                        $recaudacioncod23a=$request->cod23a;
                        $activo=1;
                    }
                    $actualizastock=StockBoleto::where('id',$datos->id)
                        ->update([
                            'actual'=>$finalcod23a,
                            'servicio_id'=>null,
                            'activo'=>$activo
                             ]);
                }
                else{
                    if($request->fincod23b==0){
                        $finalcod23b=500;
                        $activo=3;
                        $final=$datos->fin-$datos->actual+1;
                        $recaudacioncod23b=$final*$precioboleto[0]->cod23;
                    }
                    else
                    {
                        $finalcod23b=$request->fincod23b;
                        $recaudacioncod23b=$request->cod23b;
                        $activo=1;
                    }
                    $actualizastock=StockBoleto::where('id',$datos->id)
                        ->update([
                            'actual'=>$finalcod23b,
                            'servicio_id'=>null,
                            'activo'=>$activo
                             ]);
                }
            break;
            case 'cod27':
                if($datos->posicion==1){
                    if($request->fincod27a==0){
                        $finalcod27a=500;
                        $activo=3;
                        $final=$datos->fin-$datos->actual+1;
                        $recaudacioncod27a=$final*$precioboleto[0]->cod27;
                    }
                    else
                    {
                        $finalcod27a=$request->fincod27a;
                        $recaudacioncod27a=$request->cod27a;
                        $activo=1;
                    }
                    $actualizastock=StockBoleto::where('id',$datos->id)
                        ->update([
                            'actual'=>$finalcod27a,
                            'servicio_id'=>null,
                            'activo'=>$activo
                             ]);
                }
                else{
                    if($request->fincod27b==0){
                        $finalcod27b=500;
                        $activo=3;
                        $final=$datos->fin-$datos->actual+1;
                        $recaudacioncod27b=$final*$precioboleto[0]->cod27;
                    }
                    else
                    {
                        $finalcod27b=$request->fincod27b;
                        $recaudacioncod27b=$request->cod27b;
                        $activo=1;
                    }
                    $actualizastock=StockBoleto::where('id',$datos->id)
                        ->update([
                            'actual'=>$finalcod27b,
                            'servicio_id'=>null,
                            'activo'=>$activo
                             ]);
                }
            break;
            case 'cod30':
                if($datos->posicion==1){
                    if($request->fincod30a==0){
                        $finalcod30a=500;
                        $activo=3;
                        $final=$datos->fin-$datos->actual+1;
                        $recaudacioncod30a=$final*$precioboleto[0]->cod30;
                    }
                    else
                    {
                        $finalcod30a=$request->fincod30a;
                        $recaudacioncod30a=$request->cod30a;
                        $activo=1;
                    }
                    $actualizastock=StockBoleto::where('id',$datos->id)
                        ->update([
                            'actual'=>$finalcod30a,
                            'servicio_id'=>null,
                            'activo'=>$activo
                             ]);
                }
                else{
                    if($request->fincod30b==0){
                        $finalcod30b=500;
                        $activo=3;
                        $final=$datos->fin-$datos->actual+1;
                        $recaudacioncod30b=$final*$precioboleto[0]->cod30;
                    }
                    else
                    {
                        $finalcod30b=$request->fincod30b;
                        $recaudacioncod30b=$request->cod30b;
                        $activo=1;
                    }
                    $actualizastock=StockBoleto::where('id',$datos->id)
                        ->update([
                            'actual'=>$finalcod30b,
                            'servicio_id'=>null,
                            'activo'=>$activo
                             ]);
                }
            break;
            case 'cod32':
                if($datos->posicion==1){
                    if($request->fincod32a==0){
                        $finalcod32a=500;
                        $activo=3;
                        $final=$datos->fin-$datos->actual+1;
                        $recaudacioncod32a=$final*$precioboleto[0]->cod32;
                    }
                    else
                    {
                        $finalcod32a=$request->fincod32a;
                        $recaudacioncod32a=$request->cod32a;
                        $activo=1;
                    }
                    $actualizastock=StockBoleto::where('id',$datos->id)
                        ->update([
                            'actual'=>$finalcod32a,
                            'servicio_id'=>null,
                            'activo'=>$activo
                             ]);
                }
                else{
                    if($request->fincod32b==0){
                        $finalcod32b=500;
                        $activo=3;
                        $final=$datos->fin-$datos->actual+1;
                        $recaudacioncod32b=$final*$precioboleto[0]->cod32;
                    }
                    else
                    {
                        $finalcod32b=$request->fincod32b;
                        $recaudacioncod32b=$request->cod32b;
                        $activo=1;
                    }
                    $actualizastock=StockBoleto::where('id',$datos->id)
                        ->update([
                            'actual'=>$finalcod32b,
                            'servicio_id'=>null,
                            'activo'=>$activo
                             ]);
                }
            break;
            case 'abono':
                if($datos->posicion==1){
                    if($request->finabonoa==0){
                        $finalabonoa=500;
                        $activo=3;
                        $final=$datos->fin-$datos->actual+1;
                        $recaudacionabonosa=$final*$precioboleto[0]->abonos;
                    }
                    else
                    {
                        $finalabonoa=$request->finabonoa;
                        $recaudacionabonosa=$request->abonosa;
                        $activo=1;
                    }
                    $actualizastock=StockBoleto::where('id',$datos->id)
                        ->update([
                            'actual'=>$finalabonoa,
                            'servicio_id'=>null,
                            'activo'=>$activo
                             ]);
                }
                else{
                    if($request->finabonob==0){
                        $finalabonob=500;
                        $activo=3;
                        $final=$datos->fin-$datos->actual+1;
                        $recaudacionabonosb=$final*$precioboleto[0]->abonos;
                    }
                    else
                    {
                        $finalabonob=$request->finabonob;
                        $recaudacionabonosb=$request->abonosb;
                        $activo=1;
                    }
                    $actualizastock=StockBoleto::where('id',$datos->id)
                        ->update([
                            'actual'=>$finalabonob,
                            'servicio_id'=>null,
                            'activo'=>$activo
                             ]);
                }
            break;
        }
    }
       
    $servicioactualizar=Servicio::where('id',$request->id)
        ->update([
                                'fincod6a'=>$finalcod6a,
                                'fincod6b'=>$finalcod6b,
                                'fincod7a'=>$finalcod7a,
                                'fincod7b'=>$finalcod7b,
                                'fincod8a'=>$finalcod8a,
                                'fincod8b'=>$finalcod8b,
                                'fincod10a'=>$finalcod10a,
                                'fincod10b'=>$finalcod10b,
                                'fincod12a'=>$finalcod12a,
                                'fincod12b'=>$finalcod12b,
                                'fincod14a'=>$finalcod14a,
                                'fincod14b'=>$finalcod14b,
                                'fincod15a'=>$finalcod15a,
                                'fincod15b'=>$finalcod15b,
                                'fincod18a'=>$finalcod18a,
                                'fincod18b'=>$finalcod18b,
                                'fincod21a'=>$finalcod21a,
                                'fincod21b'=>$finalcod21b,
                                'fincod23a'=>$finalcod23a,
                                'fincod23b'=>$finalcod23b,
                                'fincod27a'=>$finalcod27a,
                                'fincod27b'=>$finalcod27b,
                                'fincod30a'=>$finalcod30a,
                                'fincod30b'=>$finalcod30b,
                                'fincod32a'=>$finalcod32a,
                                'fincod32b'=>$finalcod32b,
                                'finabonoa'=>$finalabonoa,
                                'finabonob'=>$finalabonob,
                                'cod6a'=>$recaudacioncod6a,
                                'cod7a'=>$recaudacioncod7a,
                                'cod8a'=>$recaudacioncod8a,
                                'cod10a'=>$recaudacioncod10a,
                                'cod12a'=>$recaudacioncod12a,
                                'cod14a'=>$recaudacioncod14a,
                                'cod15a'=>$recaudacioncod15a,
                                'cod18a'=>$recaudacioncod18a,
                                'cod21a'=>$recaudacioncod21a,
                                'cod23a'=>$recaudacioncod23a,
                                'cod27a'=>$recaudacioncod27a,
                                'cod30a'=>$recaudacioncod30a,
                                'cod32a'=>$recaudacioncod32a,
                                'abonosa'=>$recaudacionabonosa,
                                'cod6b'=>$recaudacioncod6b,
                                'cod7b'=>$recaudacioncod7b,
                                'cod8b'=>$recaudacioncod8b,
                                'cod10b'=>$recaudacioncod10b,
                                'cod12b'=>$recaudacioncod12b,
                                'cod14b'=>$recaudacioncod14b,
                                'cod15b'=>$recaudacioncod15b,
                                'cod18b'=>$recaudacioncod18b,
                                'cod21b'=>$recaudacioncod21b,
                                'cod23b'=>$recaudacioncod23b,
                                'cod27b'=>$recaudacioncod27b,
                                'cod30b'=>$recaudacioncod30b,
                                'cod32b'=>$recaudacioncod32b,
                                'abonosb'=>$recaudacionabonosb,
                                'estado'=>'RECAUDADO'
                                 ]);


}



}

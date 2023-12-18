<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CtaCteC;
use App\Cliente;
use Carbon\Carbon;
use App\Articulo;
use App\MovimientoPallet;
use App\Movimiento;
use App\Camion;
use App\MantenimientoC;
use App\Movimiento_Articulo;
use App\Proveedor;
use App\CtaCteP;
use App\Chofer;
use App\CtaCteCho;
use App\CierreCaja;
use App\Caja;
use App\CtaCtePLeagas;
use App\Boleteria122;
use App\Boleteria122Detalle;
use  DB;
use Afip;
use Illuminate\Support\Facades\Http;

use Dompdf\Dompdf;





class ReporteController extends Controller
{    public function __construct()
    {
        $this->middleware('auth');
    }

//reporte de ctas ctes por fecha de clientes

public function json(Request $request)
    {
$jsonContents = file_get_contents(storage_path('app/db.json'));

$products = json_decode($jsonContents, true);

 

foreach ($products as $product) {

    echo '<pre>';

    print_r($product);

    echo '</pre>';

}


}

 public function index(Request $request)
    {
        $clientes=Cliente::orderBy('nombre','ASC')->pluck('nombre','id');
		return view('reportes.ctasctesc')
       	 ->with('clientes',$clientes);

    }

public function reportectasctesc(Request $request)
    {
        $fi = Carbon::parse($request->fechai)->format('Y-m-d').' 00:00:00';
    	$ff = Carbon::parse($request->fechaf)->format('Y-m-d').' 23:59:59';
        $consulta=CtaCteC::whereBetween('fechaemision',[$fi, $ff])->where('cliente_id',$request->cliente_id)->get();

        $cliente= Cliente::where('id',$request->cliente_id)->get();


        $pdf=\PDF::loadView('pdf.reportectactec',['consulta'=>$consulta, 'cliente'=>$cliente])
        ->setPaper('a4','landscape');
        return $pdf->download('reportectactec.pdf');



    }
// FIN reporte de ctas ctes por fecha de clientes ---------------------------------------------------

//reporte de ctas ctes por fecha de proveedores
 public function ctasctesp(Request $request)
    {
        $proveedores=Proveedor::orderBy('nombre','ASC')->pluck('nombre','id');
        return view('reportes.ctasctesp')
         ->with('proveedores',$proveedores);

    }
public function ctasctespleagas(Request $request)
    {
        $proveedores=Proveedor::orderBy('nombre','ASC')->pluck('nombre','id');
        return view('reportes.ctasctespleagas')
         ->with('proveedores',$proveedores);

    }
public function reportectasctesp(Request $request)
    {
        $fi = Carbon::parse($request->fechai)->format('Y-m-d').' 00:00:00';
        $ff = Carbon::parse($request->fechaf)->format('Y-m-d').' 23:59:59';
        $consulta=CtaCteP::whereBetween('fechaemision',[$fi, $ff])->where('proveedor_id',$request->proveedor_id)->get();

        $proveedor= Proveedor::where('id',$request->proveedor_id)->get();


        $pdf=\PDF::loadView('pdf.reportectactep',['consulta'=>$consulta, 'proveedor'=>$proveedor])
        ->setPaper('a4','landscape');
        return $pdf->download('reportectactep.pdf');



    }
    public function reportectasctespleagas(Request $request)
    {
        $fi = Carbon::parse($request->fechai)->format('Y-m-d').' 00:00:00';
        $ff = Carbon::parse($request->fechaf)->format('Y-m-d').' 23:59:59';
        $consulta=CtaCtePLeagas::whereBetween('fechaemision',[$fi, $ff])->where('proveedor_id',$request->proveedor_id)->get();

        $proveedor= Proveedor::where('id',$request->proveedor_id)->get();


        $pdf=\PDF::loadView('pdf.reportectactep',['consulta'=>$consulta, 'proveedor'=>$proveedor])
        ->setPaper('a4','landscape');
        return $pdf->download('reportectactep.pdf');



    }
// FIN reporte de ctas ctes por fecha de proveedores ---------------------------------------------------

// REPORTE PARA LOS INGRESOS POR BOLETERIA 122
public function boleteria122(Request $request)
    {
       return view('reportes.boleteria122');
    }


public function reporteboleteria122(Request $request)
{

    $fi = Carbon::parse($request->fechai)->format('Y-m-d').' 00:00:00';
    $ff = Carbon::parse($request->fechaf)->format('Y-m-d').' 23:59:59';
    
    if(isset($request->detalle)){

    $consulta=DB::table('boleteria122')
                          ->join('boleteria122detalle','boleteria122.id','=','boleteria122detalle.boleteria122_id')
                          ->whereBetween('fecha',[$fi, $ff])
                          ->get();

    $consultasuma=DB::table('boleteria122')
                          ->join('boleteria122detalle','boleteria122.id','=','boleteria122detalle.boleteria122_id')
                          ->whereBetween('fecha',[$fi, $ff])
                          ->sum('total');
    $consultasumarendirp=DB::table('boleteria122')
                          ->join('boleteria122detalle','boleteria122.id','=','boleteria122detalle.boleteria122_id')
                          ->whereBetween('fecha',[$fi, $ff])
                          ->sum('totalarendirp');
    $consultasumarendiru=DB::table('boleteria122')
                          ->join('boleteria122detalle','boleteria122.id','=','boleteria122detalle.boleteria122_id')
                          ->whereBetween('fecha',[$fi, $ff])
                          ->sum('totalarendiru');
    $consultasumarendirm=DB::table('boleteria122')
                          ->join('boleteria122detalle','boleteria122.id','=','boleteria122detalle.boleteria122_id')
                          ->whereBetween('fecha',[$fi, $ff])
                          ->sum('totalarendirm');
    $consultasuma=$consultasumarendirm+$consultasumarendiru+$consultasumarendirp;
      $pdf=\PDF::loadView('pdf.reporteboleteria122detalle',['consulta'=>$consulta,'consultasuma'=>$consultasuma,'consultasumarendirp'=>$consultasumarendirp,'consultasumarendiru'=>$consultasumarendiru,'consultasumarendirm'=>$consultasumarendirm])
        ->setPaper('a4','landscape');
        return $pdf->download('reporteboleteria122detalle.pdf');
    }
    else {
        $consulta=Boleteria122::whereBetween('fecha',[$fi, $ff])->get();
        $consultasuma=Boleteria122::whereBetween('fecha',[$fi, $ff])->sum('total');
        $pdf=\PDF::loadView('pdf.reporteboleteria122',['consulta'=>$consulta,'consultasuma'=>$consultasuma])
        ->setPaper('a4','landscape');
        return $pdf->download('reporteboleteria122.pdf');
    }
}

//reporte de ctas ctes por fecha de choferes
 public function ctasctescho(Request $request)
    {
        $choferes=Chofer::orderBy('nombre','ASC')->pluck('nombre','id');
        return view('reportes.ctasctescho')
         ->with('choferes',$choferes);

    }

public function reportectasctescho(Request $request)
    {
        $fi = Carbon::parse($request->fechai)->format('Y-m-d').' 00:00:00';
        $ff = Carbon::parse($request->fechaf)->format('Y-m-d').' 23:59:59';
        $consulta=CtaCteCho::whereBetween('fechaemision',[$fi, $ff])->where('chofer_id',$request->chofer_id)->get();

        $chofer= Proveedor::where('id',$request->chofer_id)->get();


        $pdf=\PDF::loadView('pdf.reportectactecho',['consulta'=>$consulta, 'chofer'=>$chofer])
        ->setPaper('a4','landscape');
        return $pdf->download('reportectactecho.pdf');



    }
// FIN reporte de ctas ctes por fecha de proveedores 


public function cierresdecaja(Request $request)
    {
       $cajas=Caja::orderBy('denominacion','ASC')->pluck('denominacion','id');
        return view('reportes.cierresdecaja')
         ->with('cajas',$cajas);

    }

public function reportecierresdecaja(Request $request)
    {
        
        $fi = Carbon::parse($request->fechai)->format('Y-m-d').' 00:00:00';
        $ff = Carbon::parse($request->fechaf)->format('Y-m-d').' 23:59:59';
        $consulta=CierreCaja::whereBetween('fecha',[$fi, $ff])->where('caja_id',$request->caja_id)->get();

        $caja= Caja::where('id',$request->caja_id)->get();


        $pdf=\PDF::loadView('pdf.reportecierresdecaja',['consulta'=>$consulta, 'caja'=>$caja])
        ->setPaper('a4','landscape');
        return $pdf->download('reportecierresdecaja.pdf');



    }

//reporte de ctas ctes por fecha de clientes
public function articulos(Request $request)
    {
       $clientes=Cliente::orderBy('nombre','ASC')->pluck('nombre','id');
        return view('reportes.articulos')
         ->with('clientes',$clientes);

    }

    public function reportearticulos(Request $request)
    {
        
        $consulta=Articulo::where('cliente_id',$request->cliente_id)->get();
        //esto es para las relacion de la tabla articulos con categorias
        $consulta->each(function($consulta){
            $consulta->categoria;
        });
        //----------------------------------------------------------
        $cliente= Cliente::where('id',$request->cliente_id)->get();


        $pdf=\PDF::loadView('pdf.reportearticulos',['consulta'=>$consulta, 'cliente'=>$cliente])
        ->setPaper('a4','landscape');
        return $pdf->download('reportearticulos.pdf');



    }
// FIN DE reporte de ctas ctes por fecha de clientes ----------------------------------------------------

    //reporte de movimientos de pallets por clientes entre fechas
    public function pallets(Request $request)
    {
       $clientes=Cliente::orderBy('nombre','ASC')->pluck('nombre','id');
        return view('reportes.pallets')
         ->with('clientes',$clientes);

    }
    public function reportepallet(Request $request)
    {
        $fi = Carbon::parse($request->fechai)->format('Y-m-d').' 00:00:00';
        $ff = Carbon::parse($request->fechaf)->format('Y-m-d').' 23:59:59';
        $consulta=MovimientoPallet::whereBetween('fecha',[$fi, $ff])->where('cliente_id',$request->cliente_id)->get();
        //esto es para las relacion de la tabla articulos con categorias
        $consulta->each(function($consulta){
            $consulta->chofer;
            $consulta->cliente;
        });

        //----------------------------------------------------------
        $cliente= Cliente::where('id',$request->cliente_id)->get();


        $pdf=\PDF::loadView('pdf.reportepallets',['consulta'=>$consulta, 'cliente'=>$cliente])
        ->setPaper('a4','landscape');
        return $pdf->download('reportepallets.pdf');



    }

    // FIN DE reporte de pallets por fecha de clientes ----------------------------------------------------


    //reporte de movimientos de pallets por clientes entre fechas
    public function mantenimientocamion(Request $request)
    {
       $camion=Camion::orderBy('dominio','ASC')->pluck('dominio','id');
        return view('reportes.mantenimientocamion')
         ->with('camion',$camion);

    }
     public function reportemantenimientocamion(Request $request)
    {

        $consulta=MantenimientoC::where('camion_id',$request->camion_id)->get();
         //esto es para las relacion de la tabla articulos con categorias
        $consulta->each(function($consulta){
            $consulta->mantenimientocrepuesto;
        });


        //----------------------------------------------------------
        $camion= Camion::where('id',$request->camion_id)->get();


        $pdf=\PDF::loadView('pdf.reportemantenimientocamion',['consulta'=>$consulta, 'camion'=>$camion])
        ->setPaper('a4','landscape');
        return $pdf->download('reportemantenimientocamion.pdf');

    }


    // FIN DE reporte de pallets por fecha de clientes ----------------------------------------------------


//reporte de movimientos de pallets por clientes entre fechas
    public function movimientosarticulos(Request $request)
    {
       $articulos=Articulo::orderBy('nombre','ASC')->get();
        return view('reportes.movimientosarticulos')
         ->with('articulos',$articulos);

    }
     public function reportemovimientosarticulos(Request $request)
    {

        $fi = Carbon::parse($request->fechai)->format('Y-m-d').' 00:00:00';
        $ff = Carbon::parse($request->fechaf)->format('Y-m-d').' 23:59:59';

        if($request->articulo_id!=NULL){
            $consulta=Movimiento_Articulo::whereBetween('fecha',[$fi, $ff])->where('articulo_id',$request->articulo_id)->get();    
        }
        else{
            $consulta=Movimiento_Articulo::whereBetween('fecha',[$fi, $ff])->get();       
        }
        

        //esto es para las relacion de la tabla articulos con categorias
        $consulta->each(function($consulta){
            $consulta->articulo;
            $consulta->movimiento;
            $consulta->movimiento->cliente;
        });

        //----------------------------------------------------------
        $pdf=\PDF::loadView('pdf.reportemovart',['consulta'=>$consulta])
        ->setPaper('a4','landscape');
        return $pdf->download('reportemovarta.pdf');

    }


    // FIN DE reporte de pallets por fecha de clientes ----------------------------------------------------
 public function prueba(Request $request)
    {

 
    $data = array(
    'CantReg'       => 1, // Cantidad de comprobantes a registrar
    'PtoVta'        => 3, // Punto de venta
    'CbteTipo'      => 11, // Tipo de comprobante (ver tipos disponibles) 
    'Concepto'      => 2, // Concepto del Comprobante: (1)Productos, (2)Servicios, (3)Productos y Servicios
    'DocTipo'       => 96, // Tipo de documento del comprador (ver tipos disponibles)
    'DocNro'        => 8082703, // Numero de documento del comprador
    'CbteDesde'     => 3, // Numero de comprobante o numero del primer comprobante en caso de ser mas de uno
    'CbteHasta'     => 3, // Numero de comprobante o numero del ultimo comprobante en caso de ser mas de uno
    'CbteFch'       => intval(date('Ymd')), // (Opcional) Fecha del comprobante (yyyymmdd) o fecha actual si es nulo
    'ImpTotal'      => 2, // Importe total del comprobante
    'ImpTotConc'    => 0, // Importe neto no gravado
    'ImpNeto'       => 2, // Importe neto gravado
    'ImpOpEx'       => 0, // Importe exento de IVA
    'ImpIVA'        => 0, //Importe total de IVA
    'ImpTrib'       => 0, //Importe total de tributos
    'FchServDesde'  => 20220501, // (Opcional) Fecha de inicio del servicio (yyyymmdd), obligatorio para Concepto 2 y 3
    'FchServHasta'  => 20220510, // (Opcional) Fecha de fin del servicio (yyyymmdd), obligatorio para Concepto 2 y 3
    'FchVtoPago'    => 20220711, // (Opcional) Fecha de vencimiento del servicio (yyyymmdd), obligatorio para Concepto 2 y 3
    'MonId'         => 'PES', //Tipo de moneda usada en el comprobante (ver tipos disponibles)('PES' para pesos argentinos) 
    'MonCotiz'      => 1, // Cotización de la moneda usada (1 para pesos argentinos)  
   
  /*  'Tributos'      => array( // (Opcional) Tributos asociados al comprobante
        array(
            'Id'        =>  99, // Id del tipo de tributo (ver tipos disponibles) 
            'Desc'      => 'Ingresos Brutos', // (Opcional) Descripcion
            'BaseImp'   => 150, // Base imponible para el tributo
            'Alic'      => 5.2, // Alícuota
            'Importe'   => 0 // Importe del tributo
        )
    ), 
    
    'Opcionales'    => array( // (Opcional) Campos auxiliares
        array(
            'Id'        => 17, // Codigo de tipo de opcion (ver tipos disponibles) 
            'Valor'     => 2 // Valor 
        )
    ), */
    
);
//dd($data);

//$afip = new Afip(array('CUIT' => 23273645039));


$afip = new Afip([
'CUIT'=> '23273645039', //<-- ojo ahi!
'production' => true
]);





$res = $afip->ElectronicBilling->CreateNextVoucher($data);
$last_voucher = $afip->ElectronicBilling->GetLastVoucher(3,11);

$voucher_info = $afip->ElectronicBilling->GetVoucherInfo($last_voucher,3,11);
dd($voucher_info);
$last_voucher = $afip->ElectronicBilling->GetLastVoucher(3,11);
dd($last_voucher);

$res = $afip->ElectronicBilling->CreateVoucher($data);
//$res = $afip->ElectronicBilling->CreateNextVoucher($data);

$last_voucher = $afip->ElectronicBilling->GetLastVoucher(1,11);
dd($last_voucher);
//dd($last_voucher);
//$server_status = $afip->RegisterScopeThirteen->GetServerStatus();
//$taxpayer_details = $afip->RegisterScopeThirteen->GetTaxpayerDetails($request->cuit);
$voucher_info = $afip->ElectronicBilling->GetVoucherInfo(1,2,11); //Devuelve la información del comprobante 1 para el punto de venta 1 y el tipo de comprobante 6 (Factura B)
dd($voucher_info);

if($voucher_info === NULL){
    echo 'El comprobante no existe';
}
else{
    echo 'Esta es la información del comprobante:';
    echo '<pre>';
//    print_r($voucher_info);
    echo '</pre>';
}
//dd($res);
$voucher_info = $afip->ElectronicBilling->GetVoucherInfo(1,1,6); //Devuelve la información del comprobante 1 para el punto de venta 1 y el tipo de comprobante 6 (Factura B)
//$concept_types = $afip->ElectronicBilling->GetOptionsTypes();
//$cuit=2327364503;

echo 'Este es el estado del servidor:';
echo '<pre>';
print_r($taxpayer_details);
//print_r($concept_types);
echo '</pre>';

     //dd($concept_types);

    }
}


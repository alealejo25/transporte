<?php

namespace App\Http\Controllers;

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



class ExportarExcelController extends Controller
{
    public function gasoilexcel()
    {
        $empresa=Empresa::orderBy('denominacion','ASC')->pluck('denominacion','id');
        //$linea=Linea::orderBy('numero','ASC')->pluck('numero','id');
        return view('bolmanantial.excel.gasoilexcel')
         ->with('empresa',$empresa);
       
    }
    public function exportargasoilexcel(Request $request)
    {

    

    $fi = Carbon::parse($request->fechai)->format('Y-m-d').' 00:00:00';
    $ff = Carbon::parse($request->fechaf)->format('Y-m-d').' 23:59:59';


    //empresa LA NUEVA FOURNIER 118 121 122 131
    if($request->empresa_id==1){
        $empresa=$request->empresa_id;

    $spreadsheet = new Spreadsheet();
    $hojaactiva118 = $spreadsheet->getActiveSheet();

    $hojaactiva118->setTitle('118');
    $hojaactiva118->setCellValue('A1', 'FECHA');
    $hojaactiva118->setCellValue('B1', 'BOLETOS');
    $hojaactiva118->setCellValue('C1', 'GASOIL');
    $hojaactiva118->setCellValue('D1', 'CANT DE SERV');
    $hojaactiva118->setCellValue('E1', 'COCHES');
    $hojaactiva118->setCellValue('F1', 'PROM X PASAJERO');
    $hojaactiva118->setCellValue('G1', 'PROM X SERVICIO');
    $hojaactiva118->setCellValue('H1', 'PROM X COCHE');

    $hojaactiva121 = $spreadsheet->createSheet();
    $hojaactiva121->setTitle('121');
    $hojaactiva121->setCellValue('A1', 'FECHA');
    $hojaactiva121->setCellValue('B1', 'BOLETOS');
    $hojaactiva121->setCellValue('C1', 'GASOIL');
    $hojaactiva121->setCellValue('D1', 'CANT DE SERV');
    $hojaactiva121->setCellValue('E1', 'COCHES');
    $hojaactiva121->setCellValue('F1', 'PROM X PASAJERO');
    $hojaactiva121->setCellValue('G1', 'PROM X SERVICIO');
    $hojaactiva121->setCellValue('H1', 'PROM X COCHE');

    $hojaactiva122 = $spreadsheet->createSheet();
    $hojaactiva122->setTitle('122');
    $hojaactiva122->setCellValue('A1', 'FECHA');
    $hojaactiva122->setCellValue('B1', 'BOLETOS');
    $hojaactiva122->setCellValue('C1', 'GASOIL');
    $hojaactiva122->setCellValue('D1', 'CANT DE SERV');
    $hojaactiva122->setCellValue('E1', 'COCHES');
    $hojaactiva122->setCellValue('F1', 'PROM X PASAJERO');
    $hojaactiva122->setCellValue('G1', 'PROM X SERVICIO');
    $hojaactiva122->setCellValue('H1', 'PROM X COCHE');

    $hojaactiva131 = $spreadsheet->createSheet();
    $hojaactiva131->setTitle('131');
    $hojaactiva131->setCellValue('A1', 'FECHA');
    $hojaactiva131->setCellValue('B1', 'BOLETOS');
    $hojaactiva131->setCellValue('C1', 'GASOIL');
    $hojaactiva131->setCellValue('D1', 'CANT DE SERV');
    $hojaactiva131->setCellValue('E1', 'COCHES');
    $hojaactiva131->setCellValue('F1', 'PROM X PASAJERO');
    $hojaactiva131->setCellValue('G1', 'PROM X SERVICIO');
    $hojaactiva131->setCellValue('H1', 'PROM X COCHE');
    
    $fila=2;
    //LINEA118 
        $datos118=BoletoLeagas::select('boletosleagas.fecha','cochesboletos.id','lineas.empresa_id')->selectRaw('SUM(cochesboletos.cantpasajes) as pasajestotal')->selectRaw('SUM(gasoiltotal) as gasoiltotal')->selectRaw('count(DISTINCT boletosleagas.id) as ids')->selectRaw('count(DISTINCT cochesboletos.coche_id) as idcoches')->join('cochesboletos','boletosleagas.id','=','cochesboletos.boletosleagas_id')->join('lineas','boletosleagas.linea_id','=','lineas.id')->where('lineas.numero',118)->whereBetween('fecha',[$fi, $ff])->groupBy('boletosleagas.fecha')->orderby('boletosleagas.fecha')->get();
             $cantidad=count($datos118);
            $i=0;
        // para llenar el gasoil en la tabla 118
       $gasoil118=Gasoil::select('gasoil.l118total','gasoil.fecha')->where('empresa_id',1)->whereBetween('fecha',[$fi, $ff])->get(); 
       //dd($gasoil118);
       foreach($gasoil118 as $indice => $descripcion)
        {
            foreach($datos118 as $indice118 => $datos){
                if($descripcion->fecha==$datos->fecha){
                    $datos->gasoiltotal=$descripcion->l118total;
                    if($datos->gasoiltotal==0 || $datos->gasoiltotal==null){
                        $datos->prompax=0;
                        $datos->promservicios=0;
                        $datos->promcoches=0;
                    }
                    else{
                        if($datos->pasajestotal==0 || $datos->pasajestotal==null)
                        {
                            $datos->prompax=0;
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
        else{
            while($cantidad>$i){
                $hojaactiva118->getColumnDimension('A')->setWidth(18);
                $hojaactiva118->setCellValue('A'.$fila, date("d/m/Y",strtotime($datos118[$i]->fecha)));
                $hojaactiva118->getColumnDimension('B')->setWidth(10);
                $hojaactiva118->setCellValue('B'.$fila, $datos118[$i]->pasajestotal);
                $hojaactiva118->getColumnDimension('C')->setWidth(10);
                $hojaactiva118->setCellValue('C'.$fila, $datos118[$i]->gasoiltotal);
                $hojaactiva118->getColumnDimension('D')->setWidth(10);
                $hojaactiva118->setCellValue('D'.$fila, $datos118[$i]->ids);
                $hojaactiva118->getColumnDimension('E')->setWidth(10);
                $hojaactiva118->setCellValue('E'.$fila, $datos118[$i]->idcoches);
                $hojaactiva118->getColumnDimension('F')->setWidth(10);
                $hojaactiva118->setCellValue('F'.$fila, $datos118[$i]->prompax);
                $hojaactiva118->getColumnDimension('G')->setWidth(10);
                $hojaactiva118->setCellValue('G'.$fila, $datos118[$i]->promservicios);
                $hojaactiva118->getColumnDimension('H')->setWidth(10);
                $hojaactiva118->setCellValue('H'.$fila, $datos118[$i]->promcoches);
                $fila++;
                $i++;
            }
        }
///////////////////// LINEA 121 //////////////////////////////////////
        $fila=2;
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
                    if($datos->gasoiltotal==0 || $datos->gasoiltotal==null){
                        $datos->prompax=0;
                        $datos->promservicios=0;
                        $datos->promcoches=0;
                    }
                    else{
                        if($datos->pasajestotal==0 || $datos->pasajestotal==null)
                        {
                            $datos->prompax=0;
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
        else{
            while($cantidad>$i){
                $hojaactiva121->getColumnDimension('A')->setWidth(18);
                $hojaactiva121->setCellValue('A'.$fila, date("d/m/Y",strtotime($datos121[$i]->fecha)));
                $hojaactiva121->getColumnDimension('B')->setWidth(10);
                $hojaactiva121->setCellValue('B'.$fila, $datos121[$i]->pasajestotal);
                $hojaactiva121->getColumnDimension('C')->setWidth(10);
                $hojaactiva121->setCellValue('C'.$fila, $datos121[$i]->gasoiltotal);
                $hojaactiva121->getColumnDimension('D')->setWidth(10);
                $hojaactiva121->setCellValue('D'.$fila, $datos121[$i]->ids);
                $hojaactiva121->getColumnDimension('E')->setWidth(10);
                $hojaactiva121->setCellValue('E'.$fila, $datos121[$i]->idcoches);
                $hojaactiva121->getColumnDimension('F')->setWidth(10);
                $hojaactiva121->setCellValue('F'.$fila, $datos121[$i]->prompax);
                $hojaactiva121->getColumnDimension('G')->setWidth(10);
                $hojaactiva121->setCellValue('G'.$fila, $datos121[$i]->promservicios);
                $hojaactiva121->getColumnDimension('H')->setWidth(10);
                $hojaactiva121->setCellValue('H'.$fila, $datos121[$i]->promcoches);
                $fila++;
                $i++;
            }
        }


///////////////////// LINEA 122 //////////////////////////////////////
        $fila=2;
        $datos122=BoletoLeagas::select('boletosleagas.fecha','cochesboletos.id','lineas.empresa_id')->selectRaw('SUM(cochesboletos.cantpasajes) as pasajestotal')->selectRaw('SUM(gasoiltotal) as gasoiltotal')->selectRaw('count(DISTINCT boletosleagas.id) as ids')->selectRaw('count(DISTINCT cochesboletos.coche_id) as idcoches')->join('cochesboletos','boletosleagas.id','=','cochesboletos.boletosleagas_id')->join('lineas','boletosleagas.linea_id','=','lineas.id')->where('lineas.numero',122)->whereBetween('fecha',[$fi, $ff])->groupBy('boletosleagas.fecha')->orderby('boletosleagas.fecha')->get();
             $cantidad=count($datos122);
        $i=0;

        //dd($datos122);

        // para llenar el gasoil en la tabla
       $gasoil122=Gasoil::select('gasoil.l122total','gasoil.fecha')->where('empresa_id',1)->whereBetween('fecha',[$fi, $ff])->get(); 
        foreach($gasoil122 as $indice => $descripcion)
        {
            foreach($datos122 as $indice122 => $datos)
            {
                if($descripcion->fecha==$datos->fecha){
                    $datos->gasoiltotal=$descripcion->l122total;
                    if($datos->gasoiltotal==0 || $datos->gasoiltotal==null){
                        $datos->prompax=0;
                        $datos->promservicios=0;
                        $datos->promcoches=0;
                    }
                    else{
                        if($datos->pasajestotal==0 || $datos->pasajestotal==null)
                        {
                            $datos->prompax=0;
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
        else{
            while($cantidad>$i){
                $hojaactiva122->getColumnDimension('A')->setWidth(18);
                $hojaactiva122->setCellValue('A'.$fila, date("d/m/Y",strtotime($datos122[$i]->fecha)));
                $hojaactiva122->getColumnDimension('B')->setWidth(10);
                $hojaactiva122->setCellValue('B'.$fila, $datos122[$i]->pasajestotal);
                $hojaactiva122->getColumnDimension('C')->setWidth(10);
                $hojaactiva122->setCellValue('C'.$fila, $datos122[$i]->gasoiltotal);
                $hojaactiva122->getColumnDimension('D')->setWidth(10);
                $hojaactiva122->setCellValue('D'.$fila, $datos122[$i]->ids);
                $hojaactiva122->getColumnDimension('E')->setWidth(10);
                $hojaactiva122->setCellValue('E'.$fila, $datos122[$i]->idcoches);
                $hojaactiva122->getColumnDimension('F')->setWidth(10);
                $hojaactiva122->setCellValue('F'.$fila, $datos122[$i]->prompax);
                $hojaactiva122->getColumnDimension('G')->setWidth(10);
                $hojaactiva122->setCellValue('G'.$fila, $datos122[$i]->promservicios);
                $hojaactiva122->getColumnDimension('H')->setWidth(10);
                $hojaactiva122->setCellValue('H'.$fila, $datos122[$i]->promcoches);
                $fila++;
                $i++;
            }
        }
/////////////////////////////////FIN LINEA 122

///////////////////// LINEA 131 //////////////////////////////////////
        $fila=2;
        $datos131=BoletoLeagas::select('boletosleagas.fecha','cochesboletos.id','lineas.empresa_id')->selectRaw('SUM(cochesboletos.cantpasajes) as pasajestotal')->selectRaw('SUM(gasoiltotal) as gasoiltotal')->selectRaw('count(DISTINCT boletosleagas.id) as ids')->selectRaw('count(DISTINCT cochesboletos.coche_id) as idcoches')->join('cochesboletos','boletosleagas.id','=','cochesboletos.boletosleagas_id')->join('lineas','boletosleagas.linea_id','=','lineas.id')->where('lineas.numero',131)->whereBetween('fecha',[$fi, $ff])->groupBy('boletosleagas.fecha')->orderby('boletosleagas.fecha')->get();
             $cantidad=count($datos131);
        $i=0;
        
        // para llenar el gasoil en la tabla
       $gasoil131=Gasoil::select('gasoil.l131total','gasoil.fecha')->where('empresa_id',1)->whereBetween('fecha',[$fi, $ff])->get();
       
        foreach($gasoil131 as $indice => $descripcion)
        {
            foreach($datos131 as $indice131 => $datos)
            {
                if($descripcion->fecha==$datos->fecha){
                    $datos->gasoiltotal=$descripcion->l131total;
                    if($datos->gasoiltotal==0 || $datos->gasoiltotal==null){
                        $datos->prompax=0;
                        $datos->promservicios=0;
                        $datos->promcoches=0;
                    }
                    else{
                        if($datos->pasajestotal==0 || $datos->pasajestotal==null)
                        {
                            $datos->prompax=0;
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
 $i=0;
        //////////////////// termina de poner el gasoil en la tabla
        if($cantidad==0){
            $datos131=0;
        }
        else{
            while($cantidad>$i){
                $hojaactiva131->getColumnDimension('A')->setWidth(18);
                $hojaactiva131->setCellValue('A'.$fila, date("d/m/Y",strtotime($datos131[$i]->fecha)));
                $hojaactiva131->getColumnDimension('B')->setWidth(10);
                $hojaactiva131->setCellValue('B'.$fila, $datos131[$i]->pasajestotal);
                $hojaactiva131->getColumnDimension('C')->setWidth(10);
                $hojaactiva131->setCellValue('C'.$fila, $datos131[$i]->gasoiltotal);
                $hojaactiva131->getColumnDimension('D')->setWidth(13);
                $hojaactiva131->setCellValue('D'.$fila, $datos131[$i]->ids);
                $hojaactiva131->getColumnDimension('E')->setWidth(10);
                $hojaactiva131->setCellValue('E'.$fila, $datos131[$i]->idcoches);
                $hojaactiva131->getColumnDimension('F')->setWidth(17);
                $hojaactiva131->setCellValue('F'.$fila, $datos131[$i]->prompax);
                $hojaactiva131->getColumnDimension('G')->setWidth(17);
                $hojaactiva131->setCellValue('G'.$fila, $datos131[$i]->promservicios);
                $hojaactiva131->getColumnDimension('H')->setWidth(17);
                $hojaactiva131->setCellValue('H'.$fila, $datos131[$i]->promcoches);
                $fila++;
                $i++;
            }
        }        

 }  
 else{

    $empresa=$request->empresa_id;

    $spreadsheet = new Spreadsheet();
    $hojaactiva10 = $spreadsheet->getActiveSheet();

    $hojaactiva10->setTitle('10');
    $hojaactiva10->setCellValue('A1', 'FECHA');
    $hojaactiva10->setCellValue('B1', 'BOLETOS');
    $hojaactiva10->setCellValue('C1', 'GASOIL');
    $hojaactiva10->setCellValue('D1', 'CANT DE SERV');
    $hojaactiva10->setCellValue('E1', 'COCHES');
    $hojaactiva10->setCellValue('F1', 'PROM X PASAJERO');
    $hojaactiva10->setCellValue('G1', 'PROM X SERVICIO');
    $hojaactiva10->setCellValue('H1', 'PROM X COCHE');

    $hojaactiva110 = $spreadsheet->createSheet();
    $hojaactiva110->setTitle('110');
    $hojaactiva110->setCellValue('A1', 'FECHA');
    $hojaactiva110->setCellValue('B1', 'BOLETOS');
    $hojaactiva110->setCellValue('C1', 'GASOIL');
    $hojaactiva110->setCellValue('D1', 'CANT DE SERV');
    $hojaactiva110->setCellValue('E1', 'COCHES');
    $hojaactiva110->setCellValue('F1', 'PROM X PASAJERO');
    $hojaactiva110->setCellValue('G1', 'PROM X SERVICIO');
    $hojaactiva110->setCellValue('H1', 'PROM X COCHE');

    $hojaactiva142 = $spreadsheet->createSheet();
    $hojaactiva142->setTitle('142');
    $hojaactiva142->setCellValue('A1', 'FECHA');
    $hojaactiva142->setCellValue('B1', 'BOLETOS');
    $hojaactiva142->setCellValue('C1', 'GASOIL');
    $hojaactiva142->setCellValue('D1', 'CANT DE SERV');
    $hojaactiva142->setCellValue('E1', 'COCHES');
    $hojaactiva142->setCellValue('F1', 'PROM X PASAJERO');
    $hojaactiva142->setCellValue('G1', 'PROM X SERVICIO');
    $hojaactiva142->setCellValue('H1', 'PROM X COCHE');

    $fila=2;
    //LINEA10 
        $datos10=BoletoLeagas::select('boletosleagas.fecha','cochesboletos.id','lineas.empresa_id')->selectRaw('SUM(cochesboletos.cantpasajes) as pasajestotal')->selectRaw('SUM(gasoiltotal) as gasoiltotal')->selectRaw('count(DISTINCT boletosleagas.id) as ids')->selectRaw('count(DISTINCT cochesboletos.coche_id) as idcoches')->join('cochesboletos','boletosleagas.id','=','cochesboletos.boletosleagas_id')->join('lineas','boletosleagas.linea_id','=','lineas.id')->where('lineas.numero',10)->whereBetween('fecha',[$fi, $ff])->groupBy('boletosleagas.fecha')->orderby('boletosleagas.fecha')->get();
             $cantidad=count($datos10);
            $i=0;
        // para llenar el gasoil en la tabla 118
       $gasoil10=Gasoil::select('gasoil.l10total','gasoil.fecha')->where('empresa_id',2)->whereBetween('fecha',[$fi, $ff])->get(); 
       //dd($gasoil118);
       foreach($gasoil10 as $indice => $descripcion)
        {
            foreach($datos10 as $indice10 => $datos){
                if($descripcion->fecha==$datos->fecha){
                    $datos->gasoiltotal=$descripcion->l10total;
                    if($datos->gasoiltotal==0 || $datos->gasoiltotal==null){
                        $datos->prompax=0;
                        $datos->promservicios=0;
                        $datos->promcoches=0;
                    }
                    else{
                        if($datos->pasajestotal==0 || $datos->pasajestotal==null)
                        {
                            $datos->prompax=0;
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
        else{
            while($cantidad>$i){
                $hojaactiva10->getColumnDimension('A')->setWidth(18);
                $hojaactiva10->setCellValue('A'.$fila, date("d/m/Y",strtotime($datos10[$i]->fecha)));
                $hojaactiva10->getColumnDimension('B')->setWidth(10);
                $hojaactiva10->setCellValue('B'.$fila, $datos10[$i]->pasajestotal);
                $hojaactiva10->getColumnDimension('C')->setWidth(10);
                $hojaactiva10->setCellValue('C'.$fila, $datos10[$i]->gasoiltotal);
                $hojaactiva10->getColumnDimension('D')->setWidth(10);
                $hojaactiva10->setCellValue('D'.$fila, $datos10[$i]->ids);
                $hojaactiva10->getColumnDimension('E')->setWidth(10);
                $hojaactiva10->setCellValue('E'.$fila, $datos10[$i]->idcoches);
                $hojaactiva10->getColumnDimension('F')->setWidth(10);
                $hojaactiva10->setCellValue('F'.$fila, $datos10[$i]->prompax);
                $hojaactiva10->getColumnDimension('G')->setWidth(10);
                $hojaactiva10->setCellValue('G'.$fila, $datos10[$i]->promservicios);
                $hojaactiva10->getColumnDimension('H')->setWidth(10);
                $hojaactiva10->setCellValue('H'.$fila, $datos10[$i]->promcoches);
                $fila++;
                $i++;
            }
        }


    //LINEA110 
        $fila=2;
        $datos110=BoletoLeagas::select('boletosleagas.fecha','cochesboletos.id','lineas.empresa_id')->selectRaw('SUM(cochesboletos.cantpasajes) as pasajestotal')->selectRaw('SUM(gasoiltotal) as gasoiltotal')->selectRaw('count(DISTINCT boletosleagas.id) as ids')->selectRaw('count(DISTINCT cochesboletos.coche_id) as idcoches')->join('cochesboletos','boletosleagas.id','=','cochesboletos.boletosleagas_id')->join('lineas','boletosleagas.linea_id','=','lineas.id')->where('lineas.numero',110)->whereBetween('fecha',[$fi, $ff])->groupBy('boletosleagas.fecha')->orderby('boletosleagas.fecha')->get();
             $cantidad=count($datos110);
            $i=0;
        // para llenar el gasoil en la tabla 118
       $gasoil110=Gasoil::select('gasoil.l110total','gasoil.fecha')->where('empresa_id',2)->whereBetween('fecha',[$fi, $ff])->get(); 
       //dd($gasoil118);
       foreach($gasoil110 as $indice => $descripcion)
        {
            foreach($datos110 as $indice110 => $datos){
                if($descripcion->fecha==$datos->fecha){
                    $datos->gasoiltotal=$descripcion->l110total;
                    if($datos->gasoiltotal==0 || $datos->gasoiltotal==null){
                        $datos->prompax=0;
                        $datos->promservicios=0;
                        $datos->promcoches=0;
                    }
                    else{
                        if($datos->pasajestotal==0 || $datos->pasajestotal==null)
                        {
                            $datos->prompax=0;
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
        else{
            while($cantidad>$i){
                $hojaactiva110->getColumnDimension('A')->setWidth(18);
                $hojaactiva110->setCellValue('A'.$fila, date("d/m/Y",strtotime($datos110[$i]->fecha)));
                $hojaactiva110->getColumnDimension('B')->setWidth(10);
                $hojaactiva110->setCellValue('B'.$fila, $datos110[$i]->pasajestotal);
                $hojaactiva110->getColumnDimension('C')->setWidth(10);
                $hojaactiva110->setCellValue('C'.$fila, $datos110[$i]->gasoiltotal);
                $hojaactiva110->getColumnDimension('D')->setWidth(10);
                $hojaactiva110->setCellValue('D'.$fila, $datos110[$i]->ids);
                $hojaactiva110->getColumnDimension('E')->setWidth(10);
                $hojaactiva110->setCellValue('E'.$fila, $datos110[$i]->idcoches);
                $hojaactiva110->getColumnDimension('F')->setWidth(10);
                $hojaactiva110->setCellValue('F'.$fila, $datos110[$i]->prompax);
                $hojaactiva110->getColumnDimension('G')->setWidth(10);
                $hojaactiva110->setCellValue('G'.$fila, $datos110[$i]->promservicios);
                $hojaactiva110->getColumnDimension('H')->setWidth(10);
                $hojaactiva110->setCellValue('H'.$fila, $datos110[$i]->promcoches);
                $fila++;
                $i++;
            }
        }
//LINEA142 
        $fila=2;
        $datos142=BoletoLeagas::select('boletosleagas.fecha','cochesboletos.id','lineas.empresa_id')->selectRaw('SUM(cochesboletos.cantpasajes) as pasajestotal')->selectRaw('SUM(gasoiltotal) as gasoiltotal')->selectRaw('count(DISTINCT boletosleagas.id) as ids')->selectRaw('count(DISTINCT cochesboletos.coche_id) as idcoches')->join('cochesboletos','boletosleagas.id','=','cochesboletos.boletosleagas_id')->join('lineas','boletosleagas.linea_id','=','lineas.id')->where('lineas.numero',142)->whereBetween('fecha',[$fi, $ff])->groupBy('boletosleagas.fecha')->orderby('boletosleagas.fecha')->get();
             $cantidad=count($datos142);
            $i=0;
        // para llenar el gasoil en la tabla 118
       $gasoil142=Gasoil::select('gasoil.l142total','gasoil.fecha')->where('empresa_id',2)->whereBetween('fecha',[$fi, $ff])->get(); 
       //dd($gasoil118);
       foreach($gasoil142 as $indice => $descripcion)
        {
            foreach($datos142 as $indice142 => $datos){
                if($descripcion->fecha==$datos->fecha){
                    $datos->gasoiltotal=$descripcion->l142total;
                    if($datos->gasoiltotal==0 || $datos->gasoiltotal==null){
                        $datos->prompax=0;
                        $datos->promservicios=0;
                        $datos->promcoches=0;
                    }
                    else{
                        if($datos->pasajestotal==0 || $datos->pasajestotal==null)
                        {
                            $datos->prompax=0;
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
        else{
            while($cantidad>$i){
                $hojaactiva142->getColumnDimension('A')->setWidth(18);
                $hojaactiva142->setCellValue('A'.$fila, date("d/m/Y",strtotime($datos142[$i]->fecha)));
                $hojaactiva142->getColumnDimension('B')->setWidth(10);
                $hojaactiva142->setCellValue('B'.$fila, $datos142[$i]->pasajestotal);
                $hojaactiva142->getColumnDimension('C')->setWidth(10);
                $hojaactiva142->setCellValue('C'.$fila, $datos142[$i]->gasoiltotal);
                $hojaactiva142->getColumnDimension('D')->setWidth(10);
                $hojaactiva142->setCellValue('D'.$fila, $datos142[$i]->ids);
                $hojaactiva142->getColumnDimension('E')->setWidth(10);
                $hojaactiva142->setCellValue('E'.$fila, $datos142[$i]->idcoches);
                $hojaactiva142->getColumnDimension('F')->setWidth(10);
                $hojaactiva142->setCellValue('F'.$fila, $datos142[$i]->prompax);
                $hojaactiva142->getColumnDimension('G')->setWidth(10);
                $hojaactiva142->setCellValue('G'.$fila, $datos142[$i]->promservicios);
                $hojaactiva142->getColumnDimension('H')->setWidth(10);
                $hojaactiva142->setCellValue('H'.$fila, $datos142[$i]->promcoches);
                $fila++;
                $i++;
            }
        }
 } 
    $writer = new Xlsx($spreadsheet);

    // redirect output to client browser
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="Gasoil.xlsx"');
    header('Cache-Control: max-age=0');

    $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
    $writer->save('php://output');



    }


    ///////////////////////////////////////////////////////////////


    public function hstrabajadasexcel()
    {
        $choferleagaslnf=ChoferLeagaslnf::orderBy('legajo','ASC')->get();
        $empresa=Empresa::orderBy('denominacion','ASC')->pluck('denominacion','id');
        $linea=Linea::orderBy('numero','ASC')->pluck('numero','id');
        return view('bolmanantial.excel.hstrabajadasexcel')
            ->with('empresa',$empresa)
            ->with('linea',$linea)
            ->with('choferleagaslnf',$choferleagaslnf);
       
    }
 public function exportarhstrabajadasexcel(Request $request)
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
        $i=0;
        if($request->chofer_id=='TODOS'){
            $datos=BoletoLeagas::select('turnos.nombre as nomturno','ramales.nombre as nomramal','serviciosleagaslnf.numero as numservicio','lineas.numero as numlinea','choferesleagaslnf.id as idchofer','choferesleagaslnf.apellido','choferesleagaslnf.nombre','choferesleagaslnf.legajo','boletosleagas.fecha','boletosleagas.numero','boletosleagas.pasajestotal','boletosleagas.horastotal','boletosleagas.horassobrantes','boletosleagas.horastotalalargue','boletosleagas.alargue','boletosleagas.cortado','boletosleagas.doblenegro','boletosleagas.normal')->join('choferesleagaslnf','boletosleagas.chofer_id','=','choferesleagaslnf.id')->join('lineas','boletosleagas.linea_id','=','lineas.id')->join('serviciosleagaslnf','boletosleagas.servicio_id','=','serviciosleagaslnf.id')->join('turnos','serviciosleagaslnf.turno_id','=','turnos.id')->join('ramales','serviciosleagaslnf.ramal_id','=','ramales.id')->where('choferesleagaslnf.empresa_id',$request->empresa_id)->whereBetween('fecha',[$fi, $ff])->orderby('choferesleagaslnf.apellido','ASC')->orderby('boletosleagas.fecha','ASC')->get();

            $datos1=BoletoLeagas::select('choferesleagaslnf.id as idchofer1','choferesleagaslnf.apellido','choferesleagaslnf.nombre','choferesleagaslnf.legajo','boletosleagas.fecha','boletosleagas.numero','boletosleagas.pasajestotal','boletosleagas.horastotal','boletosleagas.horassobrantes','boletosleagas.horastotalalargue','boletosleagas.alargue','boletosleagas.cortado','boletosleagas.doblenegro','boletosleagas.normal')->selectRaw('SEC_TO_TIME(SUM(TIME_TO_SEC(boletosleagas.horassobrantes))) as sumhorassobrantes')->join('choferesleagaslnf','boletosleagas.chofer_id','=','choferesleagaslnf.id')->where('empresa_id',$request->empresa_id)->whereBetween('fecha',[$fi, $ff])->orderby('choferesleagaslnf.apellido')->orderby('boletosleagas.fecha','ASC')->groupby('choferesleagaslnf.id')->get();

            $cantidad=count($datos);
            
            $spreadsheet = new Spreadsheet();
            $hojaactiva = $spreadsheet->getActiveSheet();
            $hojaactiva->setTitle('HS. Trabajadas');
            $hojaactiva->setCellValue('A1', 'Apellido y Nombre');
            $hojaactiva->setCellValue('B1', 'Legajo');
            $hojaactiva->setCellValue('C1', 'FECHA');
            $hojaactiva->setCellValue('D1', 'PLANILLA');
            $hojaactiva->setCellValue('E1', 'LINEA');
            $hojaactiva->setCellValue('F1', 'SERVICIO');
            $hojaactiva->setCellValue('G1', 'TOTAL PAX');
            $hojaactiva->setCellValue('H1', 'HS TRABAJADAS');
            $hojaactiva->setCellValue('I1', 'N');
            $hojaactiva->setCellValue('J1', 'C');
            $hojaactiva->setCellValue('K1', 'D');
            $hojaactiva->setCellValue('L1', 'A');
            $hojaactiva->setCellValue('M1', 'HS ALARGUE');
            $hojaactiva->setCellValue('N1', 'HS EXTRAS');

             $spreadsheet = new Spreadsheet();
            $hojaactiva = $spreadsheet->getActiveSheet();
            $hojaactiva->setTitle('HS. Trabajadas');
            $hojaactiva->setCellValue('A1', 'APELLIDO Y NOMBRE');
            $hojaactiva->setCellValue('B1', 'LEGAJO');
            $hojaactiva->setCellValue('C1', 'FECHA');
            $hojaactiva->setCellValue('D1', 'PLANILLA');
            $hojaactiva->setCellValue('E1', 'LINEA');
            $hojaactiva->setCellValue('F1', 'SERVICIO');
            $hojaactiva->setCellValue('G1', 'TOTAL PAX');
            $hojaactiva->setCellValue('H1', 'HS TRABAJADAS');
            $hojaactiva->setCellValue('I1', 'NORMAL');
            $hojaactiva->setCellValue('J1', 'CORTADO');
            $hojaactiva->setCellValue('K1', 'DOBLE');
            $hojaactiva->setCellValue('L1', 'ALARGUE');
            $hojaactiva->setCellValue('M1', 'HS ALARGUE');
            $hojaactiva->setCellValue('N1', 'HS EXTRAS');
//dd($datos);
        $fila=2;
        $cantidad=count($datos);
        while($cantidad>$i){
            $hojaactiva->getColumnDimension('A')->setWidth(35);
            $hojaactiva->setCellValue('A'.$fila, $datos[$i]->apellido.','.$datos[$i]->nombre);
            $hojaactiva->getColumnDimension('B')->setWidth(7);
            $hojaactiva->setCellValue('B'.$fila, $datos[$i]->legajo);
            $hojaactiva->getColumnDimension('C')->setWidth(18);
            $hojaactiva->setCellValue('C'.$fila, date("d/m/Y",strtotime($datos[$i]->fecha)));
            $hojaactiva->getColumnDimension('D')->setWidth(10);
            $hojaactiva->setCellValue('D'.$fila, $datos[$i]->numero);
            $hojaactiva->getColumnDimension('E')->setWidth(10);
            $hojaactiva->setCellValue('E'.$fila, $datos[$i]->numlinea);
            $hojaactiva->getColumnDimension('F')->setWidth(35);
            $hojaactiva->setCellValue('F'.$fila, $datos[$i]->numservicio.'-'.$datos[$i]->nomramal.'-'.$datos[$i]->nomturno);
            $hojaactiva->getColumnDimension('G')->setWidth(13);
            $hojaactiva->setCellValue('G'.$fila, $datos[$i]->pasajestotal);
            $hojaactiva->getColumnDimension('H')->setWidth(15);
            $hojaactiva->setCellValue('H'.$fila, $datos[$i]->horastotal);
            $hojaactiva->getColumnDimension('I')->setWidth(9);
            $hojaactiva->setCellValue('I'.$fila, $datos[$i]->normal);
            $hojaactiva->getColumnDimension('J')->setWidth(9);
            $hojaactiva->setCellValue('J'.$fila, $datos[$i]->cortado);
            $hojaactiva->getColumnDimension('K')->setWidth(9);
            $hojaactiva->setCellValue('K'.$fila, $datos[$i]->doblenegro);
            $hojaactiva->getColumnDimension('L')->setWidth(9);
            $hojaactiva->setCellValue('L'.$fila, $datos[$i]->alargue);
            $hojaactiva->getColumnDimension('M')->setWidth(12);
            $hojaactiva->setCellValue('M'.$fila, $datos[$i]->horastotalalargue);
            $hojaactiva->getColumnDimension('N')->setWidth(12);
            $hojaactiva->setCellValue('N'.$fila, $datos[$i]->horassobrantes);
            $fila++;
            $i++;
        }


             $writer = new Xlsx($spreadsheet);

            // redirect output to client browser
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="HsTrabajadas.xlsx"');
            header('Cache-Control: max-age=0');

            $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
            $writer->save('php://output');
        }
        else
        {
        $datos=BoletoLeagas::select('turnos.nombre as nomturno','ramales.nombre as nomramal','serviciosleagaslnf.numero as numservicio','lineas.numero as numlinea','choferesleagaslnf.id as idchofer','choferesleagaslnf.apellido','choferesleagaslnf.nombre','choferesleagaslnf.legajo','boletosleagas.fecha','boletosleagas.numero','boletosleagas.pasajestotal','boletosleagas.horastotal','boletosleagas.horassobrantes','boletosleagas.horastotalalargue','boletosleagas.alargue','boletosleagas.cortado','boletosleagas.doblenegro','boletosleagas.normal')->join('choferesleagaslnf','boletosleagas.chofer_id','=','choferesleagaslnf.id')->join('lineas','boletosleagas.linea_id','=','lineas.id')->join('serviciosleagaslnf','boletosleagas.servicio_id','=','serviciosleagaslnf.id')->join('turnos','serviciosleagaslnf.turno_id','=','turnos.id')->join('ramales','serviciosleagaslnf.ramal_id','=','ramales.id')->where('boletosleagas.chofer_id',$request->chofer_id)->whereBetween('fecha',[$fi, $ff])->orderby('choferesleagaslnf.apellido','ASC')->orderby('boletosleagas.fecha','ASC')->get();



            $datos1=BoletoLeagas::select('choferesleagaslnf.id as idchofer1','choferesleagaslnf.apellido','choferesleagaslnf.nombre','choferesleagaslnf.legajo','boletosleagas.fecha','boletosleagas.numero','boletosleagas.pasajestotal','boletosleagas.horastotal','boletosleagas.horassobrantes','boletosleagas.horastotalalargue','boletosleagas.alargue','boletosleagas.cortado','boletosleagas.doblenegro','boletosleagas.normal')->selectRaw('SEC_TO_TIME(SUM(TIME_TO_SEC(boletosleagas.horassobrantes))) as sumhorassobrantes')->join('choferesleagaslnf','boletosleagas.chofer_id','=','choferesleagaslnf.id')->where('chofer_id',$request->chofer_id)->whereBetween('fecha',[$fi, $ff])->orderby('choferesleagaslnf.apellido')->orderby('boletosleagas.fecha','ASC')->get();



            $spreadsheet = new Spreadsheet();
            $hojaactiva = $spreadsheet->getActiveSheet();
            $hojaactiva->setTitle('HS. Trabajadas');
            $hojaactiva->setCellValue('A1', 'APELLIDO Y NOMBRE');
            $hojaactiva->setCellValue('B1', 'LEGAJO');
            $hojaactiva->setCellValue('C1', 'FECHA');
            $hojaactiva->setCellValue('D1', 'PLANILLA');
            $hojaactiva->setCellValue('E1', 'LINEA');
            $hojaactiva->setCellValue('F1', 'SERVICIO');
            $hojaactiva->setCellValue('G1', 'TOTAL PAX');
            $hojaactiva->setCellValue('H1', 'HS TRABAJADAS');
            $hojaactiva->setCellValue('I1', 'NORMAL');
            $hojaactiva->setCellValue('J1', 'CORTADO');
            $hojaactiva->setCellValue('K1', 'DOBLE');
            $hojaactiva->setCellValue('L1', 'ALARGUE');
            $hojaactiva->setCellValue('M1', 'HS ALARGUE');
            $hojaactiva->setCellValue('N1', 'HS EXTRAS');
//dd($datos);
        $fila=2;
        $cantidad=count($datos);
        while($cantidad>$i){
            $hojaactiva->getColumnDimension('A')->setWidth(35);
            $hojaactiva->setCellValue('A'.$fila, $datos[$i]->apellido.','.$datos[$i]->nombre);
            $hojaactiva->getColumnDimension('B')->setWidth(7);
            $hojaactiva->setCellValue('B'.$fila, $datos[$i]->legajo);
            $hojaactiva->getColumnDimension('C')->setWidth(18);
            $hojaactiva->setCellValue('C'.$fila, date("d/m/Y",strtotime($datos[$i]->fecha)));
            $hojaactiva->getColumnDimension('D')->setWidth(10);
            $hojaactiva->setCellValue('D'.$fila, $datos[$i]->numero);
            $hojaactiva->getColumnDimension('E')->setWidth(10);
            $hojaactiva->setCellValue('E'.$fila, $datos[$i]->numlinea);
            $hojaactiva->getColumnDimension('F')->setWidth(28);
            $hojaactiva->setCellValue('F'.$fila, $datos[$i]->numservicio.'-'.$datos[$i]->nomramal.'-'.$datos[$i]->nomturno);
            $hojaactiva->getColumnDimension('G')->setWidth(13);
            $hojaactiva->setCellValue('G'.$fila, $datos[$i]->pasajestotal);
            $hojaactiva->getColumnDimension('H')->setWidth(15);
            $hojaactiva->setCellValue('H'.$fila, $datos[$i]->horastotal);
            $hojaactiva->getColumnDimension('I')->setWidth(9);
            $hojaactiva->setCellValue('I'.$fila, $datos[$i]->normal);
            $hojaactiva->getColumnDimension('J')->setWidth(9);
            $hojaactiva->setCellValue('J'.$fila, $datos[$i]->cortado);
            $hojaactiva->getColumnDimension('K')->setWidth(9);
            $hojaactiva->setCellValue('K'.$fila, $datos[$i]->doblenegro);
            $hojaactiva->getColumnDimension('L')->setWidth(9);
            $hojaactiva->setCellValue('L'.$fila, $datos[$i]->alargue);
            $hojaactiva->getColumnDimension('M')->setWidth(12);
            $hojaactiva->setCellValue('M'.$fila, $datos[$i]->horassobrantes);
            $hojaactiva->getColumnDimension('N')->setWidth(12);
            $hojaactiva->setCellValue('N'.$fila, $datos[$i]->horastotalalargue);
            $fila++;
            $i++;
        }
         $writer = new Xlsx($spreadsheet);

        // redirect output to client browser
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="HsTrabajadas.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        }
    }

 public function hsextrastrabajadasexcel()
    {
        $choferleagaslnf=ChoferLeagaslnf::orderBy('legajo','ASC')->get();
        $empresa=Empresa::orderBy('denominacion','ASC')->pluck('denominacion','id');
        $linea=Linea::orderBy('numero','ASC')->pluck('numero','id');
        return view('bolmanantial.excel.hsextrastrabajadasexcel')
            ->with('empresa',$empresa)
            ->with('linea',$linea)
            ->with('choferleagaslnf',$choferleagaslnf);
       
    }
     public function exportarhsextrastrabajadasexcel(Request $request)
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
        $i=0;
        if($request->chofer_id=='TODOS'){
         
            $datos= BoletoLeagas::select('choferesleagaslnf.id as idchofer','choferesleagaslnf.legajo as legajo', 'choferesleagaslnf.apellido','choferesleagaslnf.nombre')->selectRaw('SEC_TO_TIME(SUM(TIME_TO_SEC(boletosleagas.horassobrantes))) as sumhorassobrantes')->join('choferesleagaslnf','boletosleagas.chofer_id','=','choferesleagaslnf.id')->where('empresa_id',$request->empresa_id)->whereBetween('fecha',[$fi, $ff])->groupby('choferesleagaslnf.id')->get();
            $cantidad=count($datos);
            
            $spreadsheet = new Spreadsheet();
            $hojaactiva = $spreadsheet->getActiveSheet();
            $hojaactiva->setTitle('HS. Trabajadas');
            $hojaactiva->setCellValue('A1', 'APELLIDO Y NOMBRE');
            $hojaactiva->setCellValue('B1', 'LEGAJO');
            $hojaactiva->setCellValue('C1', 'HS EXTRAS');

        $fila=2;
        $cantidad=count($datos);
        while($cantidad>$i){
            $hojaactiva->getColumnDimension('A')->setWidth(35);
            $hojaactiva->setCellValue('A'.$fila, $datos[$i]->apellido.','.$datos[$i]->nombre);
            $hojaactiva->getColumnDimension('B')->setWidth(7);
            $hojaactiva->setCellValue('B'.$fila, $datos[$i]->legajo);
            $hojaactiva->setCellValue('C'.$fila, $datos[$i]->sumhorassobrantes);
            $fila++;
            $i++;
        }


             $writer = new Xlsx($spreadsheet);

            // redirect output to client browser
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="HsExtrasTrabajadas.xlsx"');
            header('Cache-Control: max-age=0');

            $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
            $writer->save('php://output');
        }
        else
        {
        $datos=BoletoLeagas::select('turnos.nombre as nomturno','ramales.nombre as nomramal','serviciosleagaslnf.numero as numservicio','lineas.numero as numlinea','choferesleagaslnf.id as idchofer','choferesleagaslnf.apellido','choferesleagaslnf.nombre','choferesleagaslnf.legajo','boletosleagas.fecha','boletosleagas.numero','boletosleagas.pasajestotal','boletosleagas.horastotal','boletosleagas.horassobrantes','boletosleagas.horastotalalargue','boletosleagas.alargue','boletosleagas.cortado','boletosleagas.doblenegro','boletosleagas.normal')->join('choferesleagaslnf','boletosleagas.chofer_id','=','choferesleagaslnf.id')->join('lineas','boletosleagas.linea_id','=','lineas.id')->join('serviciosleagaslnf','boletosleagas.servicio_id','=','serviciosleagaslnf.id')->join('turnos','serviciosleagaslnf.turno_id','=','turnos.id')->join('ramales','serviciosleagaslnf.ramal_id','=','ramales.id')->where('boletosleagas.chofer_id',$request->chofer_id)->whereBetween('fecha',[$fi, $ff])->orderby('choferesleagaslnf.apellido','ASC')->orderby('boletosleagas.fecha','ASC')->get();



            $datos1=BoletoLeagas::select('choferesleagaslnf.id as idchofer1','choferesleagaslnf.apellido','choferesleagaslnf.nombre','choferesleagaslnf.legajo','boletosleagas.fecha','boletosleagas.numero','boletosleagas.pasajestotal','boletosleagas.horastotal','boletosleagas.horassobrantes','boletosleagas.horastotalalargue','boletosleagas.alargue','boletosleagas.cortado','boletosleagas.doblenegro','boletosleagas.normal')->selectRaw('SEC_TO_TIME(SUM(TIME_TO_SEC(boletosleagas.horassobrantes))) as sumhorassobrantes')->join('choferesleagaslnf','boletosleagas.chofer_id','=','choferesleagaslnf.id')->where('chofer_id',$request->chofer_id)->whereBetween('fecha',[$fi, $ff])->orderby('choferesleagaslnf.apellido')->orderby('boletosleagas.fecha','ASC')->get();



            $spreadsheet = new Spreadsheet();
            $hojaactiva = $spreadsheet->getActiveSheet();
            $hojaactiva->setTitle('HS. Trabajadas');
            $hojaactiva->setCellValue('A1', 'APELLIDO Y NOMBRE');
            $hojaactiva->setCellValue('B1', 'LEGAJO');
            $hojaactiva->setCellValue('C1', 'FECHA');
            $hojaactiva->setCellValue('D1', 'PLANILLA');
            $hojaactiva->setCellValue('E1', 'LINEA');
            $hojaactiva->setCellValue('F1', 'SERVICIO');
            $hojaactiva->setCellValue('G1', 'TOTAL PAX');
            $hojaactiva->setCellValue('H1', 'HS TRABAJADAS');
            $hojaactiva->setCellValue('I1', 'NORMAL');
            $hojaactiva->setCellValue('J1', 'CORTADO');
            $hojaactiva->setCellValue('K1', 'DOBLE');
            $hojaactiva->setCellValue('L1', 'ALARGUE');
            $hojaactiva->setCellValue('M1', 'HS ALARGUE');
            $hojaactiva->setCellValue('N1', 'HS EXTRAS');
//dd($datos);
        $fila=2;
        $cantidad=count($datos);
        while($cantidad>$i){
            $hojaactiva->getColumnDimension('A')->setWidth(35);
            $hojaactiva->setCellValue('A'.$fila, $datos[$i]->apellido.','.$datos[$i]->nombre);
            $hojaactiva->getColumnDimension('B')->setWidth(7);
            $hojaactiva->setCellValue('B'.$fila, $datos[$i]->legajo);
            $hojaactiva->getColumnDimension('C')->setWidth(18);
            $hojaactiva->setCellValue('C'.$fila, date("d/m/Y",strtotime($datos[$i]->fecha)));
            $hojaactiva->getColumnDimension('D')->setWidth(10);
            $hojaactiva->setCellValue('D'.$fila, $datos[$i]->numero);
            $hojaactiva->getColumnDimension('E')->setWidth(10);
            $hojaactiva->setCellValue('E'.$fila, $datos[$i]->numlinea);
            $hojaactiva->getColumnDimension('F')->setWidth(28);
            $hojaactiva->setCellValue('F'.$fila, $datos[$i]->numservicio.'-'.$datos[$i]->nomramal.'-'.$datos[$i]->nomturno);
            $hojaactiva->getColumnDimension('G')->setWidth(13);
            $hojaactiva->setCellValue('G'.$fila, $datos[$i]->pasajestotal);
            $hojaactiva->getColumnDimension('H')->setWidth(15);
            $hojaactiva->setCellValue('H'.$fila, $datos[$i]->horastotal);
            $hojaactiva->getColumnDimension('I')->setWidth(9);
            $hojaactiva->setCellValue('I'.$fila, $datos[$i]->normal);
            $hojaactiva->getColumnDimension('J')->setWidth(9);
            $hojaactiva->setCellValue('J'.$fila, $datos[$i]->cortado);
            $hojaactiva->getColumnDimension('K')->setWidth(9);
            $hojaactiva->setCellValue('K'.$fila, $datos[$i]->doblenegro);
            $hojaactiva->getColumnDimension('L')->setWidth(9);
            $hojaactiva->setCellValue('L'.$fila, $datos[$i]->alargue);
            $hojaactiva->getColumnDimension('M')->setWidth(12);
            $hojaactiva->setCellValue('M'.$fila, $datos[$i]->horassobrantes);
            $hojaactiva->getColumnDimension('N')->setWidth(12);
            $hojaactiva->setCellValue('N'.$fila, $datos[$i]->horastotalalargue);
            $fila++;
            $i++;
        }
         $writer = new Xlsx($spreadsheet);

        // redirect output to client browser
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="HsextrasTrabajadas.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        }
    }
    public function servicioschoferexcel()
    {   $empresa=Empresa::orderBy('denominacion','ASC')->pluck('denominacion','id');
        $linea=Linea::orderBy('numero','ASC')->get();
        $choferleagaslnf=ChoferLeagaslnf::orderBy('legajo','ASC')->get();
        return view('bolmanantial.excel.servicioschoferexcel')
            ->with('linea',$linea)
            ->with('choferleagaslnf',$choferleagaslnf)
             ->with('empresa',$empresa);
    }

    public function exportarservicioschoferexcel(Request $request)
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
//dd($datos);
        $spreadsheet = new Spreadsheet();
        $hojaactiva = $spreadsheet->getActiveSheet();
        $hojaactiva->setTitle('Servicios');
        $hojaactiva->setCellValue('A1', 'LEGAJO');
        $hojaactiva->setCellValue('B1', 'CHOFER');
        $hojaactiva->setCellValue('C1', 'CANT. SERV');
        $hojaactiva->setCellValue('D1', 'HS TRABAJADAS');
        $hojaactiva->setCellValue('E1', 'HS SOBRANTES');
        $hojaactiva->setCellValue('F1', 'HS ALARGUE');
        $hojaactiva->setCellValue('G1', 'SERV. NORMAL');
        $hojaactiva->setCellValue('H1', 'SERV. DOBLE');
        $hojaactiva->setCellValue('I1', 'CANT. PAX');
        $hojaactiva->setCellValue('J1', 'RECAUDACION');
        $hojaactiva->setCellValue('K1', 'TOQUES DE ANDEN');
        $hojaactiva->setCellValue('L1', 'VALOR DE TOQUES');
        

        $fila=2;
        $i=0;
        $cantidad=count($datos);
        while($cantidad>$i){
            $hojaactiva->getColumnDimension('A')->setWidth(7);
            $hojaactiva->setCellValue('A'.$fila, $datos[$i]->choferleagaslnf->legajo);
            $hojaactiva->getColumnDimension('B')->setWidth(35);
            $hojaactiva->setCellValue('B'.$fila, $datos[$i]->apellido.','.$datos[$i]->nombre);

            $hojaactiva->getColumnDimension('C')->setWidth(10);
            $hojaactiva->setCellValue('C'.$fila, $datos[$i]->cantidaddeservicios);
            $hojaactiva->getColumnDimension('D')->setWidth(14);
            $hojaactiva->setCellValue('D'.$fila, $datos[$i]->horastotal);
            $hojaactiva->getColumnDimension('E')->setWidth(14);
            $hojaactiva->setCellValue('E'.$fila, $datos[$i]->horassobrantes);
            $hojaactiva->getColumnDimension('F')->setWidth(14);
            $hojaactiva->setCellValue('F'.$fila, $datos[$i]->horastotalalargue);
            $hojaactiva->getColumnDimension('G')->setWidth(14);
            $hojaactiva->setCellValue('G'.$fila, $datos[$i]->normal);
            $hojaactiva->getColumnDimension('H')->setWidth(14);
            $hojaactiva->setCellValue('H'.$fila, $datos[$i]->doblenegro);
            $hojaactiva->getColumnDimension('I')->setWidth(10);
            $hojaactiva->setCellValue('I'.$fila, $datos[$i]->pasajes);
            $hojaactiva->getColumnDimension('J')->setWidth(14);
            $hojaactiva->setCellValue('J'.$fila, $datos[$i]->recaudacion);
            $hojaactiva->getColumnDimension('K')->setWidth(17);
            $hojaactiva->setCellValue('K'.$fila, $datos[$i]->toquesanden);
            $hojaactiva->getColumnDimension('L')->setWidth(17);
            $hojaactiva->setCellValue('L'.$fila, $datos[$i]->valortoquesanden);

            $fila++;
            $i++;
        }


             $writer = new Xlsx($spreadsheet);

            // redirect output to client browser
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="ServiciosXChofer.xlsx"');
            header('Cache-Control: max-age=0');

            $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
            $writer->save('php://output');


    }

    public function serviciosexcel()
    {   $empresa=Empresa::orderBy('denominacion','ASC')->pluck('denominacion','id');
        $linea=Linea::orderBy('numero','ASC')->get();
        $choferleagaslnf=ChoferLeagaslnf::orderBy('legajo','ASC')->get();
        return view('bolmanantial.excel.serviciosexcel')
            ->with('linea',$linea)
            ->with('choferleagaslnf',$choferleagaslnf)
             ->with('empresa',$empresa);
    }
public function exportarserviciosexcel(Request $request)
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
      
        if($request->linea_id == "TODAS")
        {
            $datos=BoletoLeagas::select('*','coches.interno','choferesleagaslnf.nombre as nombrechoferes','boletosleagas.id as id_boleto','boletosleagas.numero as num','ramales.nombre as nombreramal')->join('serviciosleagaslnf','boletosleagas.servicio_id','=','serviciosleagaslnf.id')->join('choferesleagaslnf','boletosleagas.chofer_id','=','choferesleagaslnf.id')->join('turnos','serviciosleagaslnf.turno_id','=','turnos.id')->join('cochesboletos','cochesboletos.boletosleagas_id','=','boletosleagas.id')->join('coches','cochesboletos.coche_id','=','coches.id')->join('ramales','serviciosleagaslnf.ramal_id','=','ramales.id')->where('serviciosleagaslnf.empresa_id',$request->empresa_id)->whereBetween('fecha',[$fi, $ff])->orderBy('num','DESC')->get();
        }
        else{
            $datos=BoletoLeagas::select('*','coches.interno','choferesleagaslnf.nombre as nombrechoferes','boletosleagas.id as id_boleto','boletosleagas.numero as num','ramales.nombre as nombreramal')->join('serviciosleagaslnf','boletosleagas.servicio_id','=','serviciosleagaslnf.id')->join('choferesleagaslnf','boletosleagas.chofer_id','=','choferesleagaslnf.id')->join('turnos','serviciosleagaslnf.turno_id','=','turnos.id')->join('cochesboletos','cochesboletos.boletosleagas_id','=','boletosleagas.id')->join('coches','cochesboletos.coche_id','=','coches.id')->join('ramales','serviciosleagaslnf.ramal_id','=','ramales.id')->where('serviciosleagaslnf.empresa_id',$request->empresa_id)->where('serviciosleagaslnf.linea_id',$request->linea_id)->whereBetween('fecha',[$fi, $ff])->orderBy('num','DESC')->get();
       }

            $datos->each(function($datos){
            $datos->linea;
            $datos->choferleagaslnf;
            $datos->servicioleagaslnf;
            $datos->turno; 
            $datos->coche;
            $datos->user;
       });
//dd($datos);
        $spreadsheet = new Spreadsheet();
        $hojaactiva = $spreadsheet->getActiveSheet();
        $hojaactiva->setTitle('Servicios');
        $hojaactiva->setCellValue('A1', 'N° PLANILLA');
        $hojaactiva->setCellValue('B1', 'FECHA');
        $hojaactiva->setCellValue('C1', 'LEGAJO');
        $hojaactiva->setCellValue('D1', 'CHOFER');
        $hojaactiva->setCellValue('E1', 'LINEA');
        $hojaactiva->setCellValue('F1', 'INTERNO');
        $hojaactiva->setCellValue('G1', 'SERVICIO');
        $hojaactiva->setCellValue('H1', 'RAMAL');
        $hojaactiva->setCellValue('I1', 'CANT. PAX');
        $hojaactiva->setCellValue('J1', 'RECAUDACION');
        $hojaactiva->setCellValue('K1', 'HORAST');
        $hojaactiva->setCellValue('L1', 'HORASS');
        $hojaactiva->setCellValue('M1', 'HORASA');
        $hojaactiva->setCellValue('N1', 'CAMBIO');
        $hojaactiva->setCellValue('O1', 'USUARIO');
        

        $fila=2;
        $i=0;
        $cantidad=count($datos);
        while($cantidad>$i){
            $hojaactiva->getColumnDimension('A')->setWidth(12);
            $hojaactiva->setCellValue('A'.$fila, $datos[$i]->num);
            $hojaactiva->getColumnDimension('B')->setWidth(15);
            $hojaactiva->setCellValue('B'.$fila, date("d/m/Y",strtotime($datos[$i]->fecha)));
            $hojaactiva->getColumnDimension('C')->setWidth(12);
            $hojaactiva->setCellValue('C'.$fila, $datos[$i]->choferleagaslnf->legajo);
            $hojaactiva->getColumnDimension('D')->setWidth(30);
            $hojaactiva->setCellValue('D'.$fila, $datos[$i]->apellido.','.$datos[$i]->choferleagaslnf->nombre);
            $hojaactiva->getColumnDimension('E')->setWidth(10);
            $hojaactiva->setCellValue('E'.$fila, $datos[$i]->linea->numero);
            $hojaactiva->getColumnDimension('F')->setWidth(10);
            $hojaactiva->setCellValue('F'.$fila, $datos[$i]->interno);
            $hojaactiva->getColumnDimension('G')->setWidth(12);
            $hojaactiva->setCellValue('G'.$fila, $datos[$i]->servicioleagaslnf->numero);
            $hojaactiva->getColumnDimension('H')->setWidth(18);
            $hojaactiva->setCellValue('H'.$fila, $datos[$i]->nombreramal);
            $hojaactiva->getColumnDimension('I')->setWidth(13);
            $hojaactiva->setCellValue('I'.$fila, $datos[$i]->cantpasajes);
            $hojaactiva->getColumnDimension('J')->setWidth(14);
            $hojaactiva->setCellValue('J'.$fila, $datos[$i]->recaudacion);
             $hojaactiva->getColumnDimension('K')->setWidth(14);
            $hojaactiva->setCellValue('K'.$fila, $datos[$i]->horastotal);
            $hojaactiva->getColumnDimension('L')->setWidth(14);
            $hojaactiva->setCellValue('L'.$fila, $datos[$i]->horassobrantes);
            $hojaactiva->getColumnDimension('M')->setWidth(14);
            $hojaactiva->setCellValue('M'.$fila, $datos[$i]->horastotalalargue);
            $hojaactiva->getColumnDimension('N')->setWidth(50);
            $hojaactiva->setCellValue('N'.$fila, $datos[$i]->motivo_cambio);
            $hojaactiva->getColumnDimension('O')->setWidth(50);
            $hojaactiva->setCellValue('O'.$fila, $datos[$i]->user->name);

            $fila++;
            $i++;
        }


             $writer = new Xlsx($spreadsheet);

            // redirect output to client browser
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="Servicios.xlsx"');
            header('Cache-Control: max-age=0');

            $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
            $writer->save('php://output');


    }

public function asistenciaexcel()
{
    $empresa=Empresa::orderBy('denominacion','ASC')->pluck('denominacion','id');
    return view('bolmanantial.excel.asistenciaexcel')
    ->with('empresa',$empresa);
}

public function exportarasistenciaexcel(Request $request)
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
        $spreadsheet = new Spreadsheet();
        $hojaactiva = $spreadsheet->getActiveSheet();
        $hojaactiva->setTitle('Asistencia');
        $hojaactiva->setCellValue('A1', 'DIA');
        $hojaactiva->setCellValue('B1', 'FECHA');
        $hojaactiva->setCellValue('C1', 'LEGAJO');
        $hojaactiva->setCellValue('D1', 'CHOFER');
         $fila=2;
        $i=0;
        $cantidad=count($datos);
        while($cantidad>$i){
            $hojaactiva->getColumnDimension('A')->setWidth(10);
            $hojaactiva->setCellValue('A'.$fila, $datos[$i]->fechadia);
            $hojaactiva->getColumnDimension('B')->setWidth(10);
            $hojaactiva->setCellValue('B'.$fila, date("d/m/Y",strtotime($datos[$i]->fecha)));

            $hojaactiva->getColumnDimension('C')->setWidth(10);
            $hojaactiva->setCellValue('C'.$fila, $datos[$i]->legajo);
            $hojaactiva->getColumnDimension('D')->setWidth(50);
            $hojaactiva->setCellValue('D'.$fila, $datos[$i]->apellido.','.$datos[$i]->nombre);
            $fila++;
            $i++;
        }


             $writer = new Xlsx($spreadsheet);

            // redirect output to client browser
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="AsistenciaChofer.xlsx"');
            header('Cache-Control: max-age=0');

            $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
            $writer->save('php://output');


}

}
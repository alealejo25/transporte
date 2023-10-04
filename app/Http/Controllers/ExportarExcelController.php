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
    $hojaactiva118->setCellValue('A1', 'PROM X COCHE');

    $hojaactiva121 = $spreadsheet->createSheet();
    $hojaactiva121->setTitle('121');
    $hojaactiva121->setCellValue('A1', 'FECHA');
    $hojaactiva121->setCellValue('B1', 'BOLETOS');
    $hojaactiva121->setCellValue('C1', 'GASOIL');
    $hojaactiva121->setCellValue('D1', 'CANT DE SERV');
    $hojaactiva121->setCellValue('E1', 'COCHES');
    $hojaactiva121->setCellValue('F1', 'PROM X PASAJERO');
    $hojaactiva121->setCellValue('G1', 'PROM X SERVICIO');
    $hojaactiva121->setCellValue('A1', 'PROM X COCHE');

    $hojaactiva122 = $spreadsheet->createSheet();
    $hojaactiva122->setTitle('122');
    $hojaactiva122->setCellValue('A1', 'FECHA');
    $hojaactiva122->setCellValue('B1', 'BOLETOS');
    $hojaactiva122->setCellValue('C1', 'GASOIL');
    $hojaactiva122->setCellValue('D1', 'CANT DE SERV');
    $hojaactiva122->setCellValue('E1', 'COCHES');
    $hojaactiva122->setCellValue('F1', 'PROM X PASAJERO');
    $hojaactiva122->setCellValue('G1', 'PROM X SERVICIO');
    $hojaactiva122->setCellValue('A1', 'PROM X COCHE');

    $hojaactiva131 = $spreadsheet->createSheet();
    $hojaactiva131->setTitle('131');
    $hojaactiva131->setCellValue('A1', 'FECHA');
    $hojaactiva131->setCellValue('B1', 'BOLETOS');
    $hojaactiva131->setCellValue('C1', 'GASOIL');
    $hojaactiva131->setCellValue('D1', 'CANT DE SERV');
    $hojaactiva131->setCellValue('E1', 'COCHES');
    $hojaactiva131->setCellValue('F1', 'PROM X PASAJERO');
    $hojaactiva131->setCellValue('G1', 'PROM X SERVICIO');
    $hojaactiva131->setCellValue('A1', 'PROM X COCHE');
    
    $fila=2;

    $fi = Carbon::parse($request->fechai)->format('Y-m-d').' 00:00:00';
    $ff = Carbon::parse($request->fechaf)->format('Y-m-d').' 23:59:59';


    //empresa LA NUEVA FOURNIER 118 121 122 131
    if($request->empresa_id==1){
        $empresa=$request->empresa_id;
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
                        $datos->prompax=$datos->gasoiltotal/$datos->pasajestotal;
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
                $hojaactiva118->setCellValue('A'.$fila, $datos118[$i]->fecha);
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
                    $datos->prompax=$datos->gasoiltotal/$datos->pasajestotal;
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
                $hojaactiva121->setCellValue('A'.$fila, $datos121[$i]->fecha);
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
                    $datos->prompax=$datos->gasoiltotal/$datos->pasajestotal;
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
                $hojaactiva122->setCellValue('A'.$fila, $datos122[$i]->fecha);
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
                    $datos->prompax=$datos->gasoiltotal/$datos->pasajestotal;
                    $datos->promservicios=$datos->gasoiltotal/$datos->ids;
                    $datos->promcoches=$datos->gasoiltotal/$datos->idcoches;    
                    }
                }
            }
        }
        //////////////////// termina de poner el gasoil en la tabla
        if($cantidad==0){
            $datos131=0;
        }
        else{
            while($cantidad>$i){
                $hojaactiva131->getColumnDimension('A')->setWidth(18);
                $hojaactiva131->setCellValue('A'.$fila, $datos131[$i]->fecha);
                $hojaactiva131->getColumnDimension('B')->setWidth(10);
                $hojaactiva131->setCellValue('B'.$fila, $datos131[$i]->pasajestotal);
                $hojaactiva131->getColumnDimension('C')->setWidth(10);
                $hojaactiva131->setCellValue('C'.$fila, $datos131[$i]->gasoiltotal);
                $hojaactiva131->getColumnDimension('D')->setWidth(10);
                $hojaactiva131->setCellValue('D'.$fila, $datos131[$i]->ids);
                $hojaactiva131->getColumnDimension('E')->setWidth(10);
                $hojaactiva131->setCellValue('E'.$fila, $datos131[$i]->idcoches);
                $hojaactiva131->getColumnDimension('F')->setWidth(10);
                $hojaactiva131->setCellValue('F'.$fila, $datos131[$i]->prompax);
                $hojaactiva131->getColumnDimension('G')->setWidth(10);
                $hojaactiva131->setCellValue('G'.$fila, $datos131[$i]->promservicios);
                $hojaactiva131->getColumnDimension('H')->setWidth(10);
                $hojaactiva131->setCellValue('H'.$fila, $datos131[$i]->promcoches);
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
}
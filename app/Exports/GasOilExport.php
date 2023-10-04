<?php

namespace App\Exports;

use App\BoletoLeagas;
use App\CocheBoleto;
use App\Linea;
use App\Gasoil;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

use Illuminate\Support\Collection;

class GasOilExport implements FromQuery
{
    use Exportable;

    public function __construct( $fi,$ff,$empresa)
    {
        
        $this->fecha1 = $fi;
        $this->fecha2 = $ff;
        $this->empresa = $empresa;

    }

    public function query()
    {
          $gasoil=Gasoil::select('gasoil.l118total','gasoil.l121total','gasoil.l122total','gasoil.l131total','gasoil.fecha as fechagasoil')->where('empresa_id',1)->whereBetween('fecha',[$this->fecha1, $this->fecha2])->get(); 

          $datos=BoletoLeagas::query()->select('boletosleagas.fecha as fechaboleto','cochesboletos.id','lineas.empresa_id','lineas.numero')->selectRaw('SUM(cochesboletos.cantpasajes) as pasajestotal')->selectRaw('SUM(gasoiltotal) as gasoiltotal')->selectRaw('count(DISTINCT boletosleagas.id) as ids')->selectRaw('count(DISTINCT cochesboletos.coche_id) as idcoches')->join('cochesboletos','boletosleagas.id','=','cochesboletos.boletosleagas_id')->join('lineas','boletosleagas.linea_id','=','lineas.id')->where('lineas.empresa_id',$this->empresa)->whereBetween('fecha',[$this->fecha1, $this->fecha2])->groupBy('boletosleagas.linea_id','boletosleagas.fecha')->orderby('boletosleagas.fecha')->orderby('lineas.numero');

        foreach($gasoil as $indice => $descripcion)
        {
            foreach($datos as $indicedatos => $datosboleto)
            {
                if($descripcion->fechagasoil == $datosboleto->fechaboleto){
                      if($datosboleto->numero == 118){

                    $datosboleto->gasoiltotal=$descripcion->l118total;
                    if($datosboleto->gasoiltotal==0 || $datosboleto->gasoiltotal==null)
                    {

                        $datosboleto->prompax=0;
                        $datosboleto->promservicios=0;
                        $datosboleto->promcoches=0;
                    }
                    else{
                    $datosboleto->prompax=$datosboleto->gasoiltotal/$datosboleto->pasajestotal;
                    $datosboleto->promservicios=$datosboleto->gasoiltotal/$datosboleto->ids;
                    $datosboleto->promcoches=$datosboleto->gasoiltotal/$datosboleto->idcoches;    
                    }
                }
                if($datosboleto->numero == 121){

                    $datosboleto->gasoiltotal=$descripcion->l121total;
                    if($datosboleto->gasoiltotal==0 || $datosboleto->gasoiltotal==null)
                    {

                        $datosboleto->prompax=0;
                        $datosboleto->promservicios=0;
                        $datosboleto->promcoches=0;
                    }
                    else{
                    $datosboleto->prompax=$datosboleto->gasoiltotal/$datosboleto->pasajestotal;
                    $datosboleto->promservicios=$datosboleto->gasoiltotal/$datosboleto->ids;
                    $datosboleto->promcoches=$datosboleto->gasoiltotal/$datosboleto->idcoches;    
                    }
                }
                if($datosboleto->numero == 122){

                    $datosboleto->gasoiltotal=$descripcion->l122total;
                    if($datosboleto->gasoiltotal==0 || $datosboleto->gasoiltotal==null)
                    {

                        $datosboleto->prompax=0;
                        $datosboleto->promservicios=0;
                        $datosboleto->promcoches=0;
                    }
                    else{
                    $datosboleto->prompax=$datosboleto->gasoiltotal/$datosboleto->pasajestotal;
                    $datosboleto->promservicios=$datosboleto->gasoiltotal/$datosboleto->ids;
                    $datosboleto->promcoches=$datosboleto->gasoiltotal/$datosboleto->idcoches;    
                    }
                }
                if($datosboleto->numero == 131){

                    $datosboleto->gasoiltotal=$descripcion->l131total;
                    if($datosboleto->gasoiltotal==0 || $datosboleto->gasoiltotal==null)
                    {

                        $datosboleto->prompax=0;
                        $datosboleto->promservicios=0;
                        $datosboleto->promcoches=0;
                    }
                    else{
                    $datosboleto->prompax=$datosboleto->gasoiltotal/$datosboleto->pasajestotal;
                    $datosboleto->promservicios=$datosboleto->gasoiltotal/$datosboleto->ids;
                    $datosboleto->promcoches=$datosboleto->gasoiltotal/$datosboleto->idcoches;    
                    }
                }

                }
            }
        }
        
        
        return $datos;
        
        //////////////////// termina de poner el gasoil en la tabla
       /* return BoletoLeagas::query()->select('boletosleagas.fecha','cochesboletos.id','lineas.empresa_id','lineas.numero')->selectRaw('SUM(cochesboletos.cantpasajes) as pasajestotal')->selectRaw('SUM(gasoiltotal) as gasoiltotal')->selectRaw('count(DISTINCT boletosleagas.id) as ids')->selectRaw('count(DISTINCT cochesboletos.coche_id) as idcoches')->join('cochesboletos','boletosleagas.id','=','cochesboletos.boletosleagas_id')->join('lineas','boletosleagas.linea_id','=','lineas.id')->where('lineas.empresa_id',$this->empresa)->whereBetween('fecha',[$this->fecha1, $this->fecha2])->groupBy('boletosleagas.linea_id','boletosleagas.fecha')->orderby('boletosleagas.fecha')->orderby('lineas.numero');*/


    }
}



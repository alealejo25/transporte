<?php

namespace App\Http\Controllers;
use App\MovimientoCaja;
use App\Camion;
use App\Flete;
use App\PrestamoChofer;
use App\MovimientoPrestamoChofer;
use App\ChequePropio;
use App\Cliente;
use App\MovimientoCajaTafi;
use App\PlanchaTafi;

use Carbon\Carbon;

use Illuminate\Http\Request;

class InicioController extends Controller
{   
 	
    public function index()
    {

      //$date = new \DateTime();
      $date=date('Y-m-d');
      
      $caja_id1=1;
      $caja_id2=2;
        $consultamovimientos1=MovimientoCaja::where('caja_id', $caja_id1)->orderBy('id','DESC')->limit(1)->get();
        $consultamovimientos2=MovimientoCaja::where('caja_id', $caja_id2)->orderBy('id','DESC')->limit(1)->get();
        $consultamantenimientoscamion=Camion::orderBy('id','DESC')->get();
        $consultafletes=Flete::where('estado','INICIADO')->orderBy('id','DESC')->get();
        $cantidad=count($consultafletes);

        $consultaplanchasdisponibles=PlanchaTafi::where('estado','DISPONIBLE')->orderBy('id','DESC')->get();
         $cantidaddisponible=count($consultaplanchasdisponibles);

        $fecha = Carbon::parse($date);

        //$fecha=$date->format('d-m-Y');
        $fechavencimientos= $fecha->addDay(7);
        $mfecha = $fecha->month;

        $chequespropioporvencer=ChequePropio::whereBetween('fecha',[$date, $fechavencimientos])->get();

        $chequespropioporvencer->each(function($chequespropioporvencer){
          $chequespropioporvencer->chofer;
          $chequespropioporvencer->proveedor;
          $chequespropioporvencer->cuentabancariapropia;
        });


 
        $consultaprestamos=PrestamoChofer::where('estado','INICIADO')->orderBy('id','DESC')->get();
        $consultapallet=Cliente::sum('saldopallet');
        $consultacamion=Camion::where('condicion','1')->orderBy('id','DESC')->get();

        $consultaventasdiariostafi=MovimientoCajaTafi::where('tipo','VENTA')->where('fecha',$date)->sum('importe');
        $consultaanulacionesdiariostafi=MovimientoCajaTafi::where('tipo','ANULADO')->where('fecha',$date)->sum('importe');
        $totalventas=$consultaventasdiariostafi+$consultaanulacionesdiariostafi;
        $consultagastosdiariostafi=MovimientoCajaTafi::where('tipo','GASTOS VARIOS')->where('fecha',$date)->sum('importe');
        $consultaplanchasvendidasdiatafi=MovimientoCajaTafi::where('tipo','VENTA')->where('fecha',$date)->get();
        $consultaplanchasanuladasdiatafi=MovimientoCajaTafi::where('tipo','ANULADO')->where('fecha',$date)->get();
        $planchasvendidasdiatafi=count($consultaplanchasvendidasdiatafi);
        $planchasanuladasdiatafi=count($consultaplanchasanuladasdiatafi);
        return view('index')
        ->with('consultamovimientos1',$consultamovimientos1)
        ->with('consultamovimientos2',$consultamovimientos2)
        ->with('totalventas',$totalventas)
        ->with('planchasvendidasdiatafi',$planchasvendidasdiatafi)
        ->with('consultagastosdiariostafi',$consultagastosdiariostafi)
        ->with('mfecha',$mfecha)
        ->with('planchasanuladasdiatafi',$planchasanuladasdiatafi)
        ->with('chequespropioporvencer',$chequespropioporvencer)
        ->with('consultacamion',$consultacamion)
        ->with('cantidad',$cantidad)
        ->with('cantidaddisponible',$cantidaddisponible);

    }

}

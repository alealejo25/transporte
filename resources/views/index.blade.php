@extends('layouts.admin') 
@section('contenido')
@if(Session::has('Mensaje')){{
    
    Session::get('Mensaje')
}}
@endif
@can('administradores')
<h4>Cajas</h4>
<div class="row">
	 @foreach ($consultamovimientos2 as $consultamovimiento2)

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
             <div class="small-box bg-aqua">
                    <div class="inner">
                          <h3>$ {{ $consultamovimiento2->importe_final  }}</h3>
                          <p>Caja LEAGAS</p>
                    </div>
                    <div class="icon">
                          <i class="ion ion-bag"></i>
                    </div>
                    <a href="#" class="small-box-footer">Ultimos Movimientos <i class="fa fa-arrow-circle-right"></i></a>
              </div>
        </div>
     
   @endforeach

      <!-- ./col -->
   @foreach ($consultamovimientos1 as $consultamovimiento1)
        <div class="col-lg-3 col-xs-6">
           <!-- small box -->
              <div class="small-box bg-green">
                      <div class="inner">
                            <h3>$ {{ $consultamovimiento1->importe_final  }}</h3>
                            <p>Caja LA NUEVA FOURNIER</p>
                      </div>
                      <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                      </div>
                      <a href="#" class="small-box-footer">Ultimos Movimientos <i class="fa fa-arrow-circle-right"></i></a>
              </div>
        </div>
    @endforeach
 </div>
@endcan
<hr style="width:100%;">
@can('boltafi')
<h4>Boleteria Tafi Viejo</h4>
<div class="row" >
   <div class="col-lg-3 col-xs-6">
           <div class="small-box bg-yellow">
                <div class="inner">
                  <h3>$ {{ $totalventas}}</h3>
                  <p>Ventas de abonos del dia</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                <a href="/boltafi/reportes/ventasdiarias" class="small-box-footer">Ir Reportes de ventas Diarias <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
          



   <div class="col-lg-3 col-xs-6">
           <div class="small-box bg-yellow">
                <div class="inner">
                  <h3> {{ $planchasvendidasdiatafi}}</h3>
                  <p>Planchas vendidas en el dia</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                <a href="/boltafi/planchastafi/" class="small-box-footer">Ir a listado de Planchas <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
          


<div class="col-lg-3 col-xs-6">
           <div class="small-box bg-yellow">
                <div class="inner">
                  <h3> {{ $planchasanuladasdiatafi}}</h3>
                  <p>Planchas anuladas en el dia</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                <a href="/boltafi/planchastafi/mostraranularplancha" class="small-box-footer">Ir a anular Planchas <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
          


<div class="col-lg-3 col-xs-6">
           <div class="small-box bg-yellow">
                <div class="inner">
                  <h3>$ {{ $consultagastosdiariostafi}}</h3>
                  <p>Gastos en el dia</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                <a href="/boltafi/planchastafi/" class="small-box-footer">Ir a listado de Movimientos de caja <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
          

</div>
<div class="col-lg-3 col-xs-6">
           <div class="small-box bg-yellow">
                <div class="inner">
                  <h3>$ {{ $cantidaddisponible}}</h3>
                  <p>Planchas Disponibles</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                <a href="/boltafi/planchastafi/" class="small-box-footer">Ir a listado de Planchas disponibles <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
 </div>

@endcan

  @endsection
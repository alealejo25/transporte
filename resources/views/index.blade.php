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
@can('administradores')
<h4>Prestamos</h4>
<div class="row" >

        @foreach ($consultaprestamos as $consultaprestamo)

          @if ($consultaprestamo->fechaproximopago == $mfecha)

            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h2>{{ $consultaprestamo->chofer->nombre  }}</h2>
                  <h2>Cuota : $ {{ $consultaprestamo->valorcuota }},00</h2>
                  <p>Vencimiento Prestamo en el mes en curso</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                <a href="/pagos/listarprestamo" class="small-box-footer">Ir a prestamos a choferes <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
          @else
            @if($consultaprestamo->fechaproximopago > $mfecha)
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h2>{{ $consultaprestamo->chofer->nombre  }}</h2>
                  <h2>Cuota : $ {{ $consultaprestamo->valorcuota }},00</h2>
                  <p>PRESTAMO VENCIDO</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                <a href="/pagos/listarprestamo" class="small-box-footer">Ir a prestamos a choferes <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            @endif
          @endif

        @endforeach
        <!-- ./col -->
</div>
@endcan


  @endsection
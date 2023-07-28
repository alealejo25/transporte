@extends('layouts.admin')
@section('contenido')

@if(Session::has('Mensaje')){{
	
	Session::get('Mensaje')
}}
@endif
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Cargas de Gasoil - LEAGAS <a href="cargargasoilleagas"><button class="btn btn-success"><i class="fa fa-plus" aria-hidden="true" title="Nuevo Servicio"></i></button></i></a></h3>
		
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive ">
			<table id="tabla" class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Numero</th>
					<th>Fecha</th>
					<th>t1apertura</th>
					<th>t1cierre.</th>
					<th>t1diferencia</th>
					<th>t1nivel</th>
					<th>t1consumo.</th>
					<th>t1saldo</th>
					<th>l10total</th>
					<th>l110total</th>
					<th>l142total</th>
					<th>Responsable</th>
					<th>Opciones</th>
				</thead>
               @foreach ($datos as $dato)
				<tr>
					<td align="right">{{ $dato->numero }}</td>
					<td>{{date('d-m-Y', strtotime($dato->fecha))}}</td>
					<td align="right">{{ $dato->t1apertura}}</td>
					<td align="right">{{ $dato->t1cierre}}</td>
					<td align="right">{{ $dato->t1diferencia}}</td>
					<td align="right">{{ $dato->t1nivel}}</td>
					<td align="right">{{ $dato->t1consumo}}</td>
					<td align="right">{{ $dato->t1saldo}}</td>
					<td align="right">{{ $dato->l10total}}</td>
					<td align="right">{{ $dato->l110total}}</td>
					<td align="right">{{ $dato->l142total}}</td>
					<td align="right">{{ $dato->responsable}}</td>

					
					<td>
						@can('editarservicio')
						<a href="{{url('bolmanantial/boletoleagas/'.$dato->id_boleto.'/modificarservicio')}}"><button class="btn btn-success"><i class="fa fa-pencil" aria-hidden="true" title="Modificar Servicio"></i></button></a>
						@endcan
						@can('borrarservicio')
						<a href="{{url('bolmanantial/boletoleagas/'.$dato->id_boleto.'/modificarservicio')}}"><button class="btn btn-success"><i class="fa fa-pencil" aria-hidden="true" title="Modificar Servicio"></i></button></a>
						@endcan
						<!-- <a href="{{url('bolmanantial/boletos/'.$dato->id_boleto.'/cargargasoil')}}"><button class="btn btn-success"><i class="fa fa-bus" aria-hidden="true" title="Cargar Gasoil"></i></button></a> -->
						<a href="{{url('bolmanantial/boletoleagas/'.$dato->id_boleto.'/informeboletoleagas')}}"><button class="btn btn-danger"><i class="fa fa-print" aria-hidden="true" title="Imprimir servicio"></i></button></a>
					</td>
						
					</td>
				</tr>
				
				@endforeach
			</table>
		</div>
		
						<button class="print">Imprimir Documento</button>
	</div>
	
</div>
<script>
$(".print").click(function() {
  window.print();
});
</script>
@endsection
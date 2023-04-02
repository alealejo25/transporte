@extends('layouts.admin')
@section('contenido')

@if(Session::has('Mensaje')){{
	
	Session::get('Mensaje')
}}
@endif
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de ramales <a href="/bolmanantial/boletos/createramal"><button class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i></button></i></a></h3>
		
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive ">
			<table id="tabla" class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Nombre</th>
					<th>Linea</th>
					<th>Opciones</th>
				</thead>
               @foreach ($datos as $dato)
				<tr>
					<td>{{$dato->nombre}}</td>
					<td>{{$dato->linea->numero}}</td>
					<td>
					
						<a href="{{url('bolmanantial/boletos/'.$dato->id.'/editarservicio')}}"><button class="btn btn-success"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>
						<a href="{{url('bolmanantial/boletoleagas/'.$dato->id_boleto.'/informeboletoleagas')}}"><button class="btn btn-danger"><i class="fa fa-print" aria-hidden="true"></i></button></a>

						
					


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


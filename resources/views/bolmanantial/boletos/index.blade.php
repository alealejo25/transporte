@extends('layouts.admin')
@section('contenido')

@if(Session::has('Mensaje')){{
	
	Session::get('Mensaje')
}}
@endif
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Servicios - LEAGAS <a href="boletosleagas/create"><button class="btn btn-success"><i class="fa fa-plus" aria-hidden="true" title="Nuevo Servicio"></i></button></i></a></h3>
		
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive ">
			<table id="miTablaLeagas" class="table table-striped table-bordered table-condensed table-hover">
			  <thead>
        <tr>
          <th>ID</th>
					<th style="width: 70px;">Fecha</th>
					<th>Planilla</th>
					<th>Chofer</th>
					<th>Linea</th>
					<th>Interno</th>
					<th>Serv.</th>
					<th>Turno</th>
					<th>Pax</th>
					<th>Rec.</th>
					<th>horaT</th>
					<th>horaS</th>
					<th>HoraA</th>
					<th>Cambio</th>
					<th style="width: 100px;">Operaciones</th>
        </tr>
    </thead>
    <tbody>
        <!-- Los datos se cargarán dinámicamente mediante DataTables -->
    </tbody>
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
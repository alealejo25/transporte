@extends('layouts.admin')
@section('contenido')
	<div class="row">
		<div class="col-lg-4 col-lg-4 col-lg-4 col-xs-12">
			

			@if(count($errors)>0)
			<div class="alert alert-danger" role="alert">
				<ul>
					
					@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
					@endforeach
				</ul>
			</div>
			@endif	

			<div>
				<h3>Venta de Abonos
				@can('acoplados_create')
				<a href="../abonados/create"><button class="btn btn-success">Nuevo Abonado</button></a>
				@endcan
				</h3>
			</div>
 			{!!Form::open(array('url'=>'boltafi/ventasdeabonos/guardarventa','method'=>'POST','autocomplete'=>'off','enctype'=>'multipart/form-data'))!!} 
			<!-- {!!Form::model(['method'=>'POST','route'=>['camiones.store']])!!}-->


			{{Form::token()}}

			<h3 id='mensaje'></h3>
			<div class="col-lg-6">
				{{Form::label('dni', 'DNI del Abonado')}}
				<input type="text" class="form-control {{$errors->has('dni')?'is-invalid':''}}" placeholder="Ingrese el DNI del abonado..." name="dni" id="dni"  value="{{old('dni')}}">
				{!! $errors->first('dni','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="col-lg-6">
				{{Form::label('numero', 'Numero de Plancha')}}
				<input type="text" class="form-control {{$errors->has('numero')?'is-invalid':''}}" placeholder="Ingrese el Nro de plancha..." name="numero" id="numero"  value="{{old('numero')}}">
				{!! $errors->first('numero','<div class="invalid-feedback">:message</div>')!!}
			</div>
<div id='todo'>
			<div class="col-lg-12">
				{{Form::label('direccion', 'Nombre y Apellido')}}
				<input type="text" class="form-control" readonly onmousedown="return false;" name="nombre" id="nombre"  >
				
			</div>
			<div class="col-lg-12">
				{{Form::label('direccion', 'Dirección')}}
				<input type="text" class="form-control" readonly onmousedown="return false;" name="direccion" id="direccion">
			</div>
			<div class="col-lg-8">
				{{Form::label('dni', 'Colegio/Empresa')}}
			<input type="text" class="form-control" readonly onmousedown="return false;" name="colegio_empresa" id="colegio_empresa">
				
			</div>
			<div class="col-lg-4">
				{{Form::label('dni', 'Turno')}}
				<input type="text" class="form-control" name="turno" id="turno" readonly onmousedown="return false;">
				
			</div>

			<div class="col-lg-6">
				{{Form::label('desde', 'Desde')}}
				<input type="text" class="form-control" readonly onmousedown="return false;" name="desde" id="desde">
			</div>
			<div class="col-lg-6">
				{{Form::label('hasta', 'Hasta')}}
				<input type="text" class="form-control" readonly onmousedown="return false;" name="hasta" id="hasta">
			</div>

			<div class="col-lg-6">
				{{Form::label('tipoabono', 'Tipo de Abono')}}
				<input type="text" class="form-control" readonly onmousedown="return false;" name="tipoabono" id="tipoabono"  >
				
			</div>
			<div class="col-lg-3">
				{{Form::label('dni', 'Boleto')}}
				<input type="text" class="form-control" readonly onmousedown="return false;" name="boleto" id="boleto">
			</div>
			<div class="col-lg-3">
				{{Form::label('dni', 'Cantidad')}}
				<input type="text" class="form-control" readonly onmousedown="return false;"  name="cantidad" id="cantidad">
			
			</div>
</div>

			<div class="Form-group">
				<input type="text" class="form-control"  name="user" id="user" style="visibility:hidden"  value="{{ Auth::user()->id }}">
			</div>
				
			
			
			<div class="Form-group">
				<button class="btn btn-primary" type="submit" id="guardar">Guardar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>
			<div class="Form-group">
					<input type="text" class="form-control"  name="user_id" id="user_id" style="visibility:hidden"  value="{{ Auth::user()->id }}">
				</div>
			
			{!!Form::close()!!}
			
			<div class="Form-group">
				<br/>
				<a href="/finanzas/chequespropios"><button class="btn btn-success">Regresar</button></a>
			</div>

		</div>
	</div> 
<!-- 	<input type="button" name="buscarabonado" id="buscarabonado" value="Buscar Abonado" class="btn btn-warning" >
	<form action="POST" action="/pagos/proveedor/ajax" id="form1">
		@csrf
		<input type="hidden" name="id1" value="1">
		<input type="hidden" name="">
		
	</form> -->

<script>


		$( "#guardar" ).click(function() {

		});
	$(document).ready(function(){

		$("#dni").focus();
		$("#dni").val("");
		$("#numero").val("");
		$("#todo").hide();
	//buscar();
		//function buscar(){
//			$('#ver').click(function(){
		$("#dni").blur(function(){
			$("#todo").show();
			$.ajax({
				url : "/boltafi/ventasdeabonos/buscarabonado",
				type : "POST",
				data : { dni : $("#dni").val(),
						_token : $('input[name="_token"]').val()
						}
				}).done( function( data ){
					if (data.length!=0)
					{
						$('#mensaje').text('');
						for (var i=0; i<data.length ;i++) {
							if(data[i].docpresentada==null || data[i].docpresentada=='NO'){

								if(data[i].boleto==103){
									costo=data[i].tipoabono.costo103;
								}
								if(data[i].boleto==100){
									costo=data[i].tipoabono.costo100;
								}
								if(data[i].boleto==101){
									costo=data[i].tipoabono.costo101;
								}
								$("#nombre").val(data[i].nombre+' '+data[i].apellido);
								$("#direccion").val(data[i].direccion);
								$("#colegio_empresa").val(data[i].colegio_empresa);
								$("#turno").val(data[i].turno);
								$("#desde").val(data[i].desde);
								$("#hasta").val(data[i].hasta);
								$("#tipoabono").val(data[i].tipoabono.tipo);
								$("#boleto").val(data[i].boleto);
								$("#cantidad").val(data[i].tipoabono.cantidad);
								$('#mensaje').text('Valor del Abono $ '+costo+',00 - EL ABONADO NO PRESENTO DOCUMENTACION');
								//$("#dni").focus();
								//$("#dni").val("");
							}
							else{
								if(data[i].boleto==103){
									costo=data[i].tipoabono.costo103;
								}
								if(data[i].boleto==100){
									costo=data[i].tipoabono.costo100;
								}
								if(data[i].boleto==101){
									costo=data[i].tipoabono.costo101;
								}
								$("#nombre").val(data[i].nombre+' '+data[i].apellido);
								$("#direccion").val(data[i].direccion);
								$("#colegio_empresa").val(data[i].colegio_empresa);
								$("#turno").val(data[i].turno);
								$("#desde").val(data[i].desde);
								$("#hasta").val(data[i].hasta);
								$("#tipoabono").val(data[i].tipoabono.tipo);
								$("#boleto").val(data[i].boleto);
								$("#cantidad").val(data[i].tipoabono.cantidad);
								$('#mensaje').text('Valor del Abono $ '+costo+',00');
							}
						}
	
					} 
					else
					{
						$('#mensaje').text('NO EXISTE EL ABONADO CON ESE DNI.');
						$("#dni").focus();
					}
					
		         });
			
			});

			});
			function borrarregistro(id) {
	    	var conf = confirm("¿Está seguro, realmente desea eliminar el registro?");
	    	if (conf == true) {
		        $.post("/pagos/proveedor/ajax/borrar", {
		                id: id,
		                _token : $('input[name="_token"]').val()
		            },
		            function (data, status) {
		            	$('#montoacu').html(data);
		                tabla();
			            }
			        );
			    }
			}
	$('#buscarabonado').click(function(){
		buscar();	

	});

</script>
@endsection
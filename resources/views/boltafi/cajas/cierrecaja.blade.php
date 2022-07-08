@extends('layouts.admin')
@section('contenido')
	<div class="row">
		<div class="col-lg-6 col-lg-6 col-lg-6 col-xs-12">
			<h3>Cierre de Caja - BOLETERIA TAFI VIEJO</h3>

			@if(count($errors)>0)
			<div class="alert alert-danger" role="alert">
				<ul>
					
					@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
					@endforeach
				</ul>
			</div>
			@endif	
 			{!!Form::open(array('url'=>'boltafi/cajas/guardarcierrecajatafi','method'=>'POST','autocomplete'=>'off','enctype'=>'multipart/form-data'))!!} 
			{{Form::token()}}

			<div class="Form-group">
				<!-- <label for="nombre">Dominio</label> -->
				{{Form::label('descripcion', 'Observacion')}}
				<input type="text" class="form-control {{$errors->has('descripcion')?'is-invalid':''}}" placeholder="Coloque una observacion..." name="descripcion" id="descripcion"  value="{{old('descripcion')}}">
				{!! $errors->first('descripcion','<div class="invalid-feedback">:message</div>')!!}

			</div>
			<div class="col-lg-12">
				<label for="montototal">Monto Total de Recaudacion de las dos empresas (ABONOS)</label>
				<input type="text" name="montototal" id="montototal"  class="form-control {{$errors->has('montototal')?'is-invalid':''}}" placeholder="Cantidad" value="0">
				{!! $errors->first('montototal','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="col-lg-12">
			<label for="montototal"></label>
		</div>
			<div class="col-lg-12">
			<label for="montototal">RECAUDACION LA NUEVA FOURNIER</label>
		</div>
		<div class="Form-group">
					<input type="text" class="form-control"  name="user_id" id="user_id" style="visibility:hidden"  value="{{ Auth::user()->id }}">
				</div>
			<div class="col-lg-6">
				<label for="nrolote">Lote de Posnet</label>
				<input type="text" name="nrolote" id="nrolote"  class="form-control {{$errors->has('nrolote')?'is-invalid':''}}" placeholder="Cantidad" value="0">
				{!! $errors->first('nrolote','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="col-lg-6">
				<label for="montolote">Monto Total del Posnet</label>
				<input type="text" name="montolote" id="montolote"  class="form-control {{$errors->has('montolote')?'is-invalid':''}}" placeholder="Monto del Lote" value="0">
				{!! $errors->first('montolote','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="col-lg-2">
				<label for="diez">Cant $10</label>
				<input type="text" name="diez" id="diez"  class="form-control {{$errors->has('diez')?'is-invalid':''}}" placeholder="Cantidad" value="0">
				{!! $errors->first('diez','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="col-lg-2">
				<label for="veinte">Cant $20</label>
				<input type="text" name="veinte" id="veinte" class="form-control {{$errors->has('veinte')?'is-invalid':''}}" placeholder="Cantidad" value="0">
				{!! $errors->first('veinte','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="col-lg-2">
				<label for="cincuenta">Cant $50</label>
				<input type="text" name="cincuenta" id="cincuenta" class="form-control {{$errors->has('cincuenta')?'is-invalid':''}}" placeholder="Cantidad" value="0">
				{!! $errors->first('cincuenta','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="col-lg-2">
				<label for="cien">Cant $100</label>
				<input type="text" name="cien" id="cien" class="form-control {{$errors->has('cien')?'is-invalid':''}}" placeholder="Cantidad" value="0">
				{!! $errors->first('cien','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="col-lg-2">
				<label for="doscientos">Cant $200</label>
				<input type="text" name="doscientos" id="doscientos" class="form-control {{$errors->has('doscientos')?'is-invalid':''}}" placeholder="Cantidad" value="0">
				{!! $errors->first('doscientos','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="col-lg-2">
				<label for="quinientos">Cant $500</label>
				<input type="text" name="quinientos" id="quinientos" class="form-control {{$errors->has('quinientos')?'is-invalid':''}}" placeholder="Cantidad" value="0">
				{!! $errors->first('quinientos','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="col-lg-2">
				<label for="mil">Cant $1000</label>
				<input type="text" name="mil" id="mil" class="form-control {{$errors->has('mil')?'is-invalid':''}}" placeholder="Cantidad" value="0">
				{!! $errors->first('mil','<div class="invalid-feedback">:message</div>')!!}
			</div>


			<div class="col-lg-10">
				<label for="dinerofisico">Dinero Fisico</label>
				<input type="text" name="dinerofisico" id="dinerofisico" class="form-control {{$errors->has('dinerofisico')?'is-invalid':''}}" placeholder="Dinero Fisico..." readonly onmousedown="return false;">
				{!! $errors->first('dinerofisico','<div class="invalid-feedback">:message</div>')!!}
			</div>

			<div class="row">
			</div>
			<div class="Form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>
			{!!Form::close()!!}
			
			<div class="Form-group">
				<br/>
				<a href="/finanzas/cierrecajas"><button class="btn btn-success">Regresar</button></a>
			</div>

	
	</div> 
<script>
	$(document).ready(function(){
		$("#descripcion").focus();
		$("#mil").blur(function(){
			diez=parseFloat($("#diez").val())*10;
			veinte=parseFloat($("#veinte").val())*20;
			cincuenta=parseFloat($("#cincuenta").val())*50;
			cien=parseFloat($("#cien").val())*100;
			doscientos=parseFloat($("#doscientos").val())*200;
			quinientos=parseFloat($("#quinientos").val())*500;
			mil=parseFloat($("#mil").val())*1000;
			montototal=diez+veinte+cincuenta+cien+doscientos+quinientos+mil;
			$("#dinerofisico").val(montototal.toFixed(2));
		});
	});

</script>
@endsection
@extends('layouts.admin')
@section('contenido')
	<div class="row">
		<div class="col-lg-6 col-lg-6 col-lg-6 col-xs-12">
			<h3>Recaudación - BOLETERIA TAFI VIEJO</h3><a href="/boltafi/cajas/verrecaudaciontafi"><button class="btn btn-success">Ver Recaudaciones</button></a></h3>

			@if(count($errors)>0)
			<div class="alert alert-danger" role="alert">
				<ul>
					
					@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
					@endforeach
				</ul>
			</div>
			@endif	
 			{!!Form::open(array('url'=>'boltafi/cajas/guardarrecaudaciontafi','method'=>'POST','autocomplete'=>'off','enctype'=>'multipart/form-data'))!!} 
			{{Form::token()}}
			<div class="col-lg-12">
				<!-- <label for="nombre">Dominio</label> -->
				{{Form::label('descripcion', 'Observacion')}}
				<input type="text" class="form-control {{$errors->has('descripcion')?'is-invalid':''}}" placeholder="Coloque una observacion..." name="descripcion" id="descripcion"  value="{{old('descripcion')}}">
				{!! $errors->first('descripcion','<div class="invalid-feedback">:message</div>')!!}
			</div>

			<div class="col-lg-6">
				<label for="fechai">Fecha DESDE, que desea crear la recaudación</label>
				<input type="date" name="fechai" id="fechai" class="form-control {{$errors->has('fechai')?'is-invalid':''}}" placeholder="Fecha Inicial de recaudacion..." value="{{old('fechai')}}">
				{!! $errors->first('fechai','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="col-lg-6">
				<label for="fechaf">Fecha HASTA, que desea crear la recaudación</label>
				<input type="date" name="fechaf" id="fechaf" class="form-control {{$errors->has('fechaf')?'is-invalid':''}}" placeholder="Fecha final de recaudacion..." value="{{old('fechaf')}}">
				{!! $errors->first('fechaf','<div class="invalid-feedback">:message</div>')!!}
			</div>
			
			<div class="col-lg-12">
			<label for="montototal"></label>
		</div>
			<div class="col-lg-12">
			<label for="montototal">BILLETERO</label>
		</div>
		<div class="Form-group">
					<input type="hidden" class="form-control"  name="user_id" id="user_id" value="{{ Auth::user()->id }}">
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
				<label for="mil">Cant $1.000</label>
				<input type="text" name="mil" id="mil" class="form-control {{$errors->has('mil')?'is-invalid':''}}" placeholder="Cantidad" value="0">
				{!! $errors->first('mil','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="col-lg-2">
				<label for="dosmil">Cant $2.000</label>
				<input type="text" name="dosmil" id="dosmil" class="form-control {{$errors->has('dosmil')?'is-invalid':''}}" placeholder="Cantidad" value="0">
				{!! $errors->first('dosmil','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="col-lg-2">
				<label for="diezmil">Cant $10.000</label>
				<input type="text" name="diezmil" id="diezmil" class="form-control {{$errors->has('diezmil')?'is-invalid':''}}" placeholder="Cantidad" value="0">
				{!! $errors->first('diezmil','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="col-lg-2">
				<label for="veintemil">Cant $20.000</label>
				<input type="text" name="veintemil" id="veintemil" class="form-control {{$errors->has('veintemil')?'is-invalid':''}}" placeholder="Cantidad" value="0">
				{!! $errors->first('veintemil','<div class="invalid-feedback">:message</div>')!!}
			</div>


			<div class="col-lg-10">
				<label for="dinerofisico">Dinero Fisico</label>
				<input type="text" name="dinerofisico" id="dinerofisico" class="form-control {{$errors->has('dinerofisico')?'is-invalid':''}}" placeholder="Dinero Fisico..." readonly onmousedown="return false;" value="0">
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
</div>
<script>
	$(document).ready(function(){
		$("#descripcion").focus();
		$("#veintemil").blur(function(){
			diez=parseFloat($("#diez").val())*10;
			veinte=parseFloat($("#veinte").val())*20;
			cincuenta=parseFloat($("#cincuenta").val())*50;
			cien=parseFloat($("#cien").val())*100;
			doscientos=parseFloat($("#doscientos").val())*200;
			quinientos=parseFloat($("#quinientos").val())*500;
			mil=parseFloat($("#mil").val())*1000;
			dosmil=parseFloat($("#dosmil").val())*2000;
			diezmil=parseFloat($("#diezmil").val())*10000;
			veintemil=parseFloat($("#veintemil").val())*20000;
			montototal=diez+veinte+cincuenta+cien+doscientos+quinientos+mil+dosmil+diezmil+veintemil;
			$("#dinerofisico").val(montototal.toFixed(2));
		});
	});

</script>
@endsection
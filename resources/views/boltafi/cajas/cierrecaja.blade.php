@extends('layouts.admin')
@section('contenido')
	<div class="row">
		<div class="col-lg-6 col-lg-6 col-lg-6 col-xs-12">
			<h3>Cierre de Caja Diario - BOLETERIA TAFI VIEJO</h3>

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
				<label for="montototal">Monto Total de Recaudacion de las dos empresas (SOLO ABONOS)</label>
				<input type="text" name="montototal" id="montototal"  class="form-control {{$errors->has('montototal')?'is-invalid':''}}" placeholder="Cantidad" value="0">
				{!! $errors->first('montototal','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="col-lg-12">
			<label for="montototal"></label>
		</div>
			<div class="col-lg-12">
			<label for="montototal">RECAUDACION LA NUEVA FOURNIER - POSNET</label>
		</div>
		<div class="Form-group">
					<input type="hidden" class="form-control"  name="user_id" id="user_id"   value="{{ Auth::user()->id }}">
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
			

				<div class="col-lg-12">
					<label for="montototal">RECAUDACION LA NUEVA FOURNIER - POSNET</label>
				</div>



			<div class="col-lg-6">
				<label for="dinerofisicolnf">Dinero Fisico - La Nueva Fournier</label>
				<input type="text" name="dinerofisicolnf" id="dinerofisicolnf" class="form-control {{$errors->has('dinerofisicolnf')?'is-invalid':''}}" placeholder="Dinero Fisico La Nueva Fournier..." readonly onmousedown="return false;">
				{!! $errors->first('dinerofisicolnf','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="col-lg-6">
				<label for="dinerofisicoelrayo">Dinero Fisico - El Rayo</label>
				<input type="text" name="dinerofisicoelrayo" id="dinerofisicoelrayo" class="form-control {{$errors->has('dinerofisicoelrayo')?'is-invalid':''}}" placeholder="Dinero Fisico El Rayo..." readonly onmousedown="return false;">
				{!! $errors->first('dinerofisicoelrayo','<div class="invalid-feedback">:message</div>')!!}
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
		$("#montolote").blur(function(){
			montoelrayo=parseFloat($("#montototal").val())/2
			montolnf=montoelrayo+parseFloat($("#montolote").val());
			console.log(montolnf);
			
			$("#dinerofisicolnf").val(montolnf.toFixed(2));
			$("#dinerofisicoelrayo").val(montoelrayo.toFixed(2));
		});
	});

</script>
@endsection
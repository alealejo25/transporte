@extends('layouts.admin')
@section('contenido')
	<div class="row">
		<di v class="col-lg-6 col-lg-6 col-lg-6 col-xs-12">
			<h3>Ingresar Pago de METROPOLITANA SA</h3>

			@if(count($errors)>0)
			<div class="alert alert-danger" role="alert">
				<ul>
					
					@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
					@endforeach
				</ul>
			</div>
			@endif	
 			{!!Form::open(array('url'=>'pagos/cliente/ingresarpagometropolitana','method'=>'POST','autocomplete'=>'off','enctype'=>'multipart/form-data'))!!} 



			{{Form::token()}}
			<div class="Form-group">
				{{Form::label('nrocomprobante', 'Liquidacion Nro:')}}
				<input type="text" class="form-control {{$errors->has('nrocomprobante')?'is-invalid':''}}" placeholder="Liquidacion red de uso..." name="nrocomprobante" id="nrocomprobante"  value="{{old('nrocomprobante')}}">
				{!! $errors->first('nrocomprobante','<div class="invalid-feedback">:message</div>')!!}

			</div>
			<div class="col-lg-6 col-lg-6">
				<label for="fechainicio">Fecha de Inicio</label>
				<input type="date" name="fechainicio" id="fechainicio" class="form-control {{$errors->has('fechainicio')?'is-invalid':''}}" placeholder="Fecha Inicio..." value="{{old('fechainicio')}}">
				{!! $errors->first('fechainicio','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="col-lg-6 col-lg-6">
				<label for="fechafin">Fecha Final</label>
				<input type="date" name="fechafin" id="fechafin" class="form-control {{$errors->has('fechafin')?'is-invalid':''}}" placeholder="Fecha Final..." value="{{old('fechafin')}}">
				{!! $errors->first('fechafin','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				<label for="importe">Importe</label>
				<input type="number" step=0.01 name="importe" class="form-control {{$errors->has('importe')?'is-invalid':''}}" placeholder="Importe..." value="{{old('importe')}}">
				{!! $errors->first('importe','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				<label for="servmetro">Servicios Metropolitana</label>
				<input type="number" step=0.01 name="servmetro" class="form-control {{$errors->has('servmetro')?'is-invalid':''}}" placeholder="Servicios Metropolitana..." value="{{old('servmetro')}}">
				{!! $errors->first('servmetro','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				<label for="fondo">Fondo Prov. de Tpte.</label>
				<input type="number" step=0.01 name="fondo" class="form-control {{$errors->has('fondo')?'is-invalid':''}}" placeholder="Fondo Prov. de Tpte..." value="{{old('fondo')}}">
				{!! $errors->first('fondo','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				<label for="iibb">Ingresos Brutos</label>
				<input type="number" step=0.01 name="iibb" class="form-control {{$errors->has('iibb')?'is-invalid':''}}" placeholder="Ingresos Brutos..." value="{{old('iibb')}}">
				{!! $errors->first('iibb','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				<label for="totaldeducciones">Total Deducciones</label>
				<input type="number" step=0.01 name="totaldeducciones" class="form-control {{$errors->has('totaldeducciones')?'is-invalid':''}}" placeholder="Total Deducciones..." value="{{old('totaldeducciones')}}">
				{!! $errors->first('totaldeducciones','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				<label for="netoapagar">Neto a Pagar</label>
				<input type="number" step=0.01 name="netoapagar" class="form-control {{$errors->has('netoapagar')?'is-invalid':''}}" placeholder="Neto a Pagar..." value="{{old('netoapagar')}}">
				{!! $errors->first('netoapagar','<div class="invalid-feedback">:message</div>')!!}
			</div>
			<div class="Form-group">
				{{Form::label('observacion', 'Observacion')}}
				<input type="text" class="form-control {{$errors->has('observacion')?'is-invalid':''}}" placeholder="Observacion..." name="observacion" id="observacion"  value="{{old('observacion')}}">
				{!! $errors->first('observacion','<div class="invalid-feedback">:message</div>')!!}

			</div>
			<div class="Form-group">
				<label for="caja_id">Selecccione Caja de la EMPRESA</label>
				{!!Form::select('caja_id',$cajas,null,['class' => 'form-control','placeholder'=>'Seleccione una opcion','requerid' ])!!}
			</div>
			<br>
			<div class="Form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>

			
			{!!Form::close()!!}
			
			<div class="Form-group">
				<br/>
				<a href="/movimientoscajas/iniciar"><button class="btn btn-success">Regresar</button></a>
			</div>

		</div>
	</div> 
@endsection
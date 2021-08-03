@extends('layouts.admin')
@section('contenido')
	<div class="row">
		<div class="col-lg-6 col-lg-6 col-lg-6 col-xs-12">
			<h3>Detalle de recaudaciones de abonos lineas 122 y Metropolitana</h3>

			@if(count($errors)>0)
			<div class="alert alert-danger" role="alert">
				<ul>
					
					@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
					@endforeach
				</ul>
			</div>
			@endif	
 			{!!Form::open(array('url'=>'pagos/cliente/ingresar122','method'=>'POST','autocomplete'=>'off','enctype'=>'multipart/form-data'))!!} 
			{{Form::token()}}
			<div class="Form-group col-lg-4">
					<div><label for="responsable">Responsable</label></div>
					<div><input type="text" class="form-control {{$errors->has('responsable')?'is-invalid':''}}" placeholder="Responsable..." name="responsable" id="responsable"  value="{{old('responsable')}}">
					{!! $errors->first('responsable','<div class="invalid-feedback">:message</div>')!!}</div>
			</div>
			<div class="Form-group col-lg-4">
					<div><label for="fechapresentacion">Fecha</label></div>
					<div><input type="date" name="fechapresentacion" id="fechapresentacion" class="form-control {{$errors->has('fechapresentacion')?'is-invalid':''}}" placeholder="Fecha Final..." value="{{old('fechapresentacion')}}">
					{!! $errors->first('fechapresentacion','<div class="invalid-feedback">:message</div>')!!}</div>
			</div>

			<div class="Form-group col-lg-4">
					<div><label for="pv">Punto de Ventas</label></div>
					<div><input type="text" name="pv" id="pv" class="form-control {{$errors->has('pv')?'is-invalid':''}}" value="Alderetes" readonly>
					{!! $errors->first('pv','<div class="invalid-feedback">:message</div>')!!}</div>
					<br>
			</div>
			<div class="Form-group col-lg-12">
					<div><label for="observaciones">Observaciones</label></div>
					<div><input type="text" class="form-control {{$errors->has('observaciones')?'is-invalid':''}}" placeholder="Observaciones..." name="observaciones" id="observaciones"  value="{{old('observaciones')}}">
					{!! $errors->first('responsable','<div class="invalid-feedback">:message</div>')!!}</div>
			</div>
			<label for="fecha">_______________________________________________________________________________________</label>
			<div id="listas">

				 <div class="Form-group col-lg-6 col-lg-6">
						<label for="fecha">Dia</label>
						<input type="date" name="fecha[]" id="fecha" class="form-control {{$errors->has('fecha')?'is-invalid':''}}" placeholder="Fecha Inicio..." value="{{old('fecha')}}">
						{!! $errors->first('fecha','<div class="invalid-feedback">:message</div>')!!}
											<br>
				</div>
				 <div class="Form-group col-lg-12">
					<div><label for="pv">ABONOS 122 POR PLANCA (10 UNIDADES)</label></div>
				 </div>

				<div class="Form-group col-lg-4 col-lg-4">
					<label for="totalarendirp">Total a Rendir</label>
					<input type="number" step=0.01 name="totalarendirp[]" class="form-control {{$errors->has('totalarendirp')?'is-invalid':''}}" placeholder="Total a Rendir..."value="{{old('totalarendirp')}}"> {!! $errors->first('totalarendir','<div class="invalid-feedback">:message</div>')!!}
				</div>
    		<div class="col-lg-4 col-lg-4">
					<label for="abonosdesdep">Abonos Desde</label>
					<input type="number" name="abonosdesdep[]" id="abonosdesdep" class="form-control {{$errors->has('abonosdesdep')?'is-invalid':''}}" placeholder="Abonos desde..." value="{{old('abonosdesdep')}}">
					{!! $errors->first('abonosdesdpe','<div class="invalid-feedback">:message</div>')!!}
				</div>
				<div class="col-lg-4 col-lg-4">
					<label for="abonoshastap">Abonos Hasta</label>
					<input type="number" name="abonoshastap[]" id="abonoshastap" class="form-control {{$errors->has('abonoshastap')?'is-invalid':''}}" placeholder="Abonos hasta..." value="{{old('abonoshastap')}}">
					{!! $errors->first('abonoshastap','<div class="invalid-feedback">:message</div>')!!}
										<br>
				</div>


				<div class="Form-group col-lg-12">
					<div><label for="pv">ABONOS POR UNIDAD</label></div>
				 </div>
				<div class="Form-group col-lg-4 col-lg-4">
					<label for="totalarendiru">Total a Rendir</label>
					<input type="number" step=0.01 name="totalarendiru[]" class="form-control {{$errors->has('totalarendiru')?'is-invalid':''}}" placeholder="Total a Rendir..."value="{{old('totalarendiru')}}"> {!! $errors->first('totalarendiru','<div class="invalid-feedback">:message</div>')!!}
				</div>
    		<div class="col-lg-4 col-lg-4">
					<label for="abonosdesdeu">Abonos Desde</label>
					<input type="number" name="abonosdesdeu[]" id="abonosdesdeu" class="form-control {{$errors->has('abonosdesdeu')?'is-invalid':''}}" placeholder="Abonos desde..." value="{{old('abonosdesdeu')}}">
					{!! $errors->first('abonosdesdeu','<div class="invalid-feedback">:message</div>')!!}
				</div>
				<div class="col-lg-4 col-lg-4">
					<label for="abonoshastau">Abonos Hasta</label>
					<input type="number" name="abonoshastau[]" id="abonoshastau" class="form-control {{$errors->has('abonoshastau')?'is-invalid':''}}" placeholder="Abonos hasta..." value="{{old('abonoshastau')}}">
					{!! $errors->first('abonoshastau','<div class="invalid-feedback">:message</div>')!!}
					<br>
				</div>


				<div class="Form-group col-lg-12">
					<div><label for="pv">CIERRE DE VTAS METROPOLITANA</label></div>
				 </div>
				<div class="Form-group col-lg-4 col-lg-4">
					<label for="totalarendirm">Total a Rendir</label>
					<input type="number" step=0.01 name="totalarendirm[]" class="form-control {{$errors->has('totalarendirm')?'is-invalid':''}}" placeholder="Total a Rendir..."value="{{old('totalarendirm')}}"> {!! $errors->first('totalarendirm','<div class="invalid-feedback">:message</div>')!!}
				</div>
    		<div class="col-lg-4 col-lg-4">
					<label for="cierrelote">Cierre de lote</label>
					<input type="number" name="cierrelote[]" id="cierrelote" class="form-control {{$errors->has('cierrelote')?'is-invalid':''}}" placeholder="Cierre de Lote..." value="{{old('cierrelote')}}">
					{!! $errors->first('cierrelote','<div class="invalid-feedback">:message</div>')!!}
				</div>
				<label for="fecha">_______________________________________________________________________________________</label>
			


			</div>



			<br>
			<div class="Form-group col-lg-12 col-lg-12">
					<input type="button" id="add_field" value="adicionar" class="btn btn-primary">
			</div>
			
			<div class="Form-group col-lg-12 col-lg-12">
					<button class="btn btn-primary" type="submit">Guardar</button>
					<button class="btn btn-danger" type="reset">Cancelar</button>
					<a href="/movimientoscajas/iniciar"><button class="btn btn-success">Regresar</button></a>
			</div>
			{!!Form::close()!!}
			
		
		</div>
	</div> 
@endsection

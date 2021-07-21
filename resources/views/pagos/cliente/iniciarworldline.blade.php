@extends('layouts.admin')
@section('contenido')
	<div class="row">
		<div class="col-lg-6 col-lg-6 col-lg-6 col-xs-12">
			<h3>Ingresar Pago de WORLDLINE SA</h3>

			@if(count($errors)>0)
			<div class="alert alert-danger" role="alert">
				<ul>
					
					@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
					@endforeach
				</ul>
			</div>
			@endif	
 			{!!Form::open(array('url'=>'pagos/cliente/ingresarpagoworldline','method'=>'POST','autocomplete'=>'off','enctype'=>'multipart/form-data'))!!} 
			{{Form::token()}}

			<div class="row">
				<div class="col-lg-8"><label for="nrocomprobante">Orden de Pago Tarjeta</label></div>
				<div class="col-lg-4"><label for="fecha">Fecha</label></div>
			</div>
			<div class="row">
				<div class="col-lg-8">				<input type="text" class="form-control {{$errors->has('nrocomprobante')?'is-invalid':''}}" placeholder="Orden de Pago N°..." name="nrocomprobante" id="nrocomprobante"  value="{{old('nrocomprobante')}}">
				{!! $errors->first('nrocomprobante','<div class="invalid-feedback">:message</div>')!!}</div>
				<div class="col-lg-4"><input type="date" name="fecha" id="fecha" class="form-control {{$errors->has('fecha')?'is-invalid':''}}" placeholder="Fecha Final..." value="{{old('fecha')}}">
				{!! $errors->first('fecha','<div class="invalid-feedback">:message</div>')!!}</div>

			</div>
			<br>
			<div class="row">
				<div class="col-lg-12" align="center"><label for="liquidaciontarjeta">Liquidacion Tarjeta</label></div>
			</div>
			<div class="row">
				<div class="col-lg-4"><label for="fechainicio">Detalle</label></div>
				<div class="col-lg-4"><label for="fechainicio">Pasajes</label></div>
				<div class="col-lg-4"><label for="fechainicio">Importe</label></div>

			</div>
			<div class="row">
				<div class="col-lg-4"><p for="fechainicio">Pasajes-Tarifa 45.00</p></div>
				<div class="col-lg-4"><input type="number" name="pasajenormal" class="form-control {{$errors->has('pasajenormal')?'is-invalid':''}}" placeholder="Cant. de pasajes..." value="{{old('pasajenormal')}}">
				{!! $errors->first('pasajenormal','<div class="invalid-feedback">:message</div>')!!}</div>
				<div class="col-lg-4"><input type="number" step=0.01 name="importenormal" class="form-control {{$errors->has('importenormal')?'is-invalid':''}}" placeholder="Importe..." value="{{old('importenormal')}}">
				{!! $errors->first('importenormal','<div class="invalid-feedback">:message</div>')!!}</div>

			</div>
			<br>
			<div class="row" >
				<div class="col-lg-4"><p for="fechainicio">Pasajes-Ab. Prim. 11.20</p></div>
				<div class="col-lg-4"><input type="number" name="pasajeprim" class="form-control {{$errors->has('pasajeprim')?'is-invalid':''}}" placeholder="Cant. de pasajes..." value="{{old('pasajeprim')}}">
				{!! $errors->first('pasajeprim','<div class="invalid-feedback">:message</div>')!!}</div>
				<div class="col-lg-4"><input type="number" step=0.01 name="importeprim" class="form-control {{$errors->has('importeprim')?'is-invalid':''}}" placeholder="Importe..." value="{{old('importeprim')}}">
				{!! $errors->first('importeprim','<div class="invalid-feedback">:message</div>')!!}</div>

			</div>
			<br>
			<div class="row">
				<div class="col-lg-4"><p for="fechainicio">Pasajes-Ab. Sec. 14.40</p></div>
				<div class="col-lg-4"><input type="number" name="pasajesec" class="form-control {{$errors->has('pasajesec')?'is-invalid':''}}" placeholder="Cant. de pasajes..." value="{{old('pasajesec')}}">
				{!! $errors->first('pasajesec','<div class="invalid-feedback">:message</div>')!!}</div>
				<div class="col-lg-4"><input type="number" step=0.01 name="importesec" class="form-control {{$errors->has('importesec')?'is-invalid':''}}" placeholder="Importe..." value="{{old('importesec')}}">
				{!! $errors->first('importesec','<div class="invalid-feedback">:message</div>')!!}</div>

			</div>
			<br>
			<div class="row">
				<div class="col-lg-4"><p for="fechainicio">Pasajes-Ab. Univ. 17.60</p></div>
				<div class="col-lg-4"><input type="number"  name="pasajeuniv" class="form-control {{$errors->has('pasajeuniv')?'is-invalid':''}}" placeholder="Cant. de pasajes..." value="{{old('pasajeuniv')}}">
				{!! $errors->first('pasajeuniv','<div class="invalid-feedback">:message</div>')!!}</div>
				<div class="col-lg-4"><input type="number" step=0.01 name="importeuniv" class="form-control {{$errors->has('importeuniv')?'is-invalid':''}}" placeholder="Importe..." value="{{old('importeuniv')}}">
				{!! $errors->first('importeuniv','<div class="invalid-feedback">:message</div>')!!}</div>

			</div>
			<br>
			<div class="row" align="right">
				<div class="col-lg-8"><p for="fechainicio">Subtotal</p></div>
				<div class="col-lg-4"><input type="number" step=0.01 name="subtotal" class="form-control {{$errors->has('subtotal')?'is-invalid':''}}" placeholder="Subtotal..." value="{{old('subtotal')}}">
				{!! $errors->first('subtotal','<div class="invalid-feedback">:message</div>')!!}</div>
			</div>
			<br>
			<div class="row">
				<div class="col-lg-12" align="center"><label for="liquidaciontarjeta">Retención</label></div>
			</div>
			<br>
			<div class="row">
				<div class="col-lg-8"><p for="fechainicio">MH08 TRIBUTO ECONOMICO MUNICIPAL</p></div>
				<div class="col-lg-4"><input type="number" step=0.01 name="mh08" class="form-control {{$errors->has('mh08')?'is-invalid':''}}" placeholder="Importe..." value="{{old('mh08')}}">
				{!! $errors->first('mh08','<div class="invalid-feedback">:message</div>')!!}</div>
			</div>
			<br>
			<div class="row">
				<div class="col-lg-8"><p for="fechainicio">MH09 CONTRIB.S/OCUP.Y/O USI DE ESPA</p></div>
				<div class="col-lg-4"><input type="number" step=0.01 name="mh09" class="form-control {{$errors->has('mh09')?'is-invalid':''}}" placeholder="Importe..." value="{{old('mh09')}}">
				{!! $errors->first('mh09','<div class="invalid-feedback">:message</div>')!!}</div>
			</div>
			<br>
			<div class="row">
				<div class="col-lg-8"><p for="fechainicio">MH42 SISTEMA PREPAGO</p></div>
				<div class="col-lg-4"><input type="number" step=0.01 name="mh42" class="form-control {{$errors->has('mh42')?'is-invalid':''}}" placeholder="Importe..." value="{{old('mh42')}}">
				{!! $errors->first('mh42','<div class="invalid-feedback">:message</div>')!!}</div>
			</div>
			<br>
			<div class="row">
				<div class="col-lg-8"><p for="fechainicio">MH44 MH44-SERV. POR BEG PRIMARIOS</p></div>
				<div class="col-lg-4"><input type="number" step=0.01 name="mh44" class="form-control {{$errors->has('mh44')?'is-invalid':''}}" placeholder="Importe..." value="{{old('mh44')}}">
				{!! $errors->first('mh44','<div class="invalid-feedback">:message</div>')!!}</div>
			</div>
			<br>
			<div class="row">
				<div class="col-lg-8"><p for="fechainicio">MH45 MH45-SERV. POR BEG SECUNDARIOS</p></div>
				<div class="col-lg-4"><input type="number" step=0.01 name="mh45" class="form-control {{$errors->has('mh45')?'is-invalid':''}}" placeholder="Importe..." value="{{old('mh45')}}">
				{!! $errors->first('mh45','<div class="invalid-feedback">:message</div>')!!}</div>
			</div>
			<br>
			<div class="row">
				<div class="col-lg-8"><p for="fechainicio">MH47 MH47 AJUSTE BEG DIF. RENOV. 04/</p></div>
				<div class="col-lg-4"><input type="number" step=0.01 name="mh47" class="form-control {{$errors->has('mh47')?'is-invalid':''}}" placeholder="Importe..." value="{{old('mh47')}}">
				{!! $errors->first('mh47','<div class="invalid-feedback">:message</div>')!!}</div>
			</div>
			<br>
			<div class="row">
				<div class="col-lg-8"><p for="fechainicio">MH48 MH47 AJUSTE BEG DIF. EMIS. 04/</p></div>
				<div class="col-lg-4"><input type="number" step=0.01 name="mh48" class="form-control {{$errors->has('mh48')?'is-invalid':''}}" placeholder="Importe..." value="{{old('mh48')}}">
				{!! $errors->first('mh48','<div class="invalid-feedback">:message</div>')!!}</div>
			</div>
			<br>
			<div class="row">
				<div class="col-lg-8"><p for="fechainicio">MH49 SISTEMA PREPAGO BUG</p></div>
				<div class="col-lg-4"><input type="number" step=0.01 name="mh49" class="form-control {{$errors->has('mh49')?'is-invalid':''}}" placeholder="Importe..." value="{{old('mh49')}}">
				{!! $errors->first('mh49','<div class="invalid-feedback">:message</div>')!!}</div>
			</div>
			<br>
			<div class="row">
				<div class="col-lg-8"><p for="fechainicio">MH50 SISTEMA PREPAGO BEG</p></div>
				<div class="col-lg-4"><input type="number" step=0.01 name="mh50" class="form-control {{$errors->has('mh50')?'is-invalid':''}}" placeholder="Importe..." value="{{old('mh50')}}">
				{!! $errors->first('mh50','<div class="invalid-feedback">:message</div>')!!}</div>
			</div>
			<br>
			<div class="row">
				<div class="col-lg-8"><p for="fechainicio">MH51-PERCEPCION IIBB TUCUMAN</p></div>
				<div class="col-lg-4"><input type="number" step=0.01 name="mh51" class="form-control {{$errors->has('mh51')?'is-invalid':''}}" placeholder="Importe..." value="{{old('mh51')}}">
				{!! $errors->first('mh51','<div class="invalid-feedback">:message</div>')!!}</div>
			</div>
			<br>
			<div class="row">
				<div class="col-lg-8"><p for="fechainicio">MH52-PERCEPCION ARCIBA</p></div>
				<div class="col-lg-4"><input type="number" step=0.01 name="mh52" class="form-control {{$errors->has('mh52')?'is-invalid':''}}" placeholder="Importe..." value="{{old('mh52')}}">
				{!! $errors->first('mh52','<div class="invalid-feedback">:message</div>')!!}</div>
			</div>
			<br>
			<div class="row">
				<div class="col-lg-8"><p for="fechainicio">U429 Ajuste TRIBUTO ECONOMICO MUNIC</p></div>
				<div class="col-lg-4"><input type="number" step=0.01 name="u429" class="form-control {{$errors->has('u429')?'is-invalid':''}}" placeholder="Importe..." value="{{old('u429')}}">
				{!! $errors->first('u429','<div class="invalid-feedback">:message</div>')!!}</div>
			</div>
			<br>
			<div class="row">
				<div class="col-lg-8"><p for="fechainicio">U430 Ajuste CONTRIB. S/OCUP. Y/O USO</p></div>
				<div class="col-lg-4"><input type="number" step=0.01 name="u430" class="form-control {{$errors->has('u430')?'is-invalid':''}}" placeholder="Importe..." value="{{old('u430')}}">
				{!! $errors->first('u430','<div class="invalid-feedback">:message</div>')!!}</div>
			</div>
			<br>
			<div class="row">
				<div class="col-lg-8"><p for="fechainicio">U431 Ajuste SISTEMA PREPAGO</p></div>
				<div class="col-lg-4"><input type="number" step=0.01 name="u431" class="form-control {{$errors->has('u431')?'is-invalid':''}}" placeholder="Importe..." value="{{old('u431')}}">
				{!! $errors->first('u431','<div class="invalid-feedback">:message</div>')!!}</div>
			</div>
			<br>
			<div class="row">
				<div class="col-lg-8"><p for="fechainicio">U462 Ajuste SISTEMA PREPAGO BUG</p></div>
				<div class="col-lg-4"><input type="number" step=0.01 name="u462" class="form-control {{$errors->has('u462')?'is-invalid':''}}" placeholder="Importe..." value="{{old('u462')}}">
				{!! $errors->first('u462','<div class="invalid-feedback">:message</div>')!!}</div>
			</div>
			<br>
			<div class="row" align="right">
				<div class="col-lg-8"><p for="fechainicio">Subtotal</p></div>
				<div class="col-lg-4"><input type="number" step=0.01 name="subtotalretenciones" class="form-control {{$errors->has('subtotalretenciones')?'is-invalid':''}}" placeholder="Importe..." value="{{old('subtotalretenciones')}}">
				{!! $errors->first('subtotalretenciones','<div class="invalid-feedback">:message</div>')!!}</div>
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
@extends('layouts.admin')
@section('contenido')
						  
 
 {!!Form::open(array('url'=>'abms/administracion/roles/store','method'=>'GET','autocomplete'=>'off','enctype'=>'multipart/form-data'))!!} 
{{Form::token()}}
	
	<div class="row">
		<div class="col-lg-6 col-lg-6 col-lg-6 col-xs-12">
			<h3>Editar Permisos de Usuarios</h3>
		</div> 
	</div>
	<div class="form-group">
	<input type="text" class="form-control {{$errors->has('nombre')?'is-invalid':''}}" name="nombre" id="nombre"  value="{{$rol->name}}">
	</div>

	<h3>Lista de Permisos</h3>
	<div class="form-group">

			@foreach($permisos as $permiso)
			<div class="col-xl-3 col-lg-3 col-md-sm-6 col-sm-6 col-12 mt-2">
				<input type="checkbox" name="permisos[]" value="{{$permiso->name}}" style="width: 20px; height:20px;"/>
				<span>{{$permiso->name}}</span>
			</div>

			@endforeach

	</div>
	<div>
			{{Form::submit('Guardar',['class'=>'btn btn-sm btn-primary'])}}
	</div>
	{!! Form::close() !!}
@endsection
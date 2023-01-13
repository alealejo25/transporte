@extends('layouts.admin')
@section('contenido')
	<div class="row">
		<div class="col-lg-6 col-lg-6 col-lg-6 col-xs-12">
			<h3>ASIGNAR PERMISO</h3>

			@if(count($errors)>0)
			<div class="alert alert-danger" role="alert">
				<ul>
					
					@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
					@endforeach
				</ul>
			</div>
			@endif	
 			{!!Form::open(array('url'=>'guardarasignarpermiso','method'=>'POST','autocomplete'=>'off','enctype'=>'multipart/form-data'))!!} 
			<!-- {!!Form::model(['method'=>'POST','route'=>['camiones.store']])!!}-->
			{{Form::token()}}

			<div class="Form-group">
				<label for="rol">ROL</label>
				<input type="text" name="rol" class="form-control {{$errors->has('rol')?'is-invalid':''}}" placeholder="Ingrese la descripcion de la mano de obra ..." value="{{old('rol')}}">
				{!! $errors->first('rol','<div class="invalid-feedback">:message</div>')!!}
			</div>

			<div class="Form-group">
				<label for="role_id"> ROL </label>
				{!!Form::select('role_id',$role,null,['class' => 'form-control','placeholder'=>'Seleccione una opcion','requerid' ])!!}
			</div>
					<h3>Lista de Permisos</h3>
	<div class="form-group">
		<ul class="list-unstyled">
			@foreach($permissions as $permission)
			<li>
				<label>
					
					{{Form::checkbox('permissions[]',$permission->id,null)}}
					{{$permission->name}}
					<em>({{$permission->description ?: 'Sin descripcion'}})</em>

				</label>
			</li>
			@endforeach
		</ul>
	</div>
	<div>	
			<br>
			<div class="Form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>

			
			{!!Form::close()!!}
			
			<div class="Form-group">
				<br/>
				<a href="/"><button class="btn btn-success">Regresar</button></a>
			</div>

		</div>
	</div> 
@endsection
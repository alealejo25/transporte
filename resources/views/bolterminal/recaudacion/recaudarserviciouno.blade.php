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
				<h3>Carga de Boletos</h3>
			</div>
 			{!!Form::open(array('url'=>'bolterminal/guardarcargarboletos','method'=>'POST','autocomplete'=>'off','enctype'=>'multipart/form-data','onsubmit'=>'return checkSubmit();'))!!} 
			{{Form::token()}}
@foreach ($servicios as $dato)
<div class="container my-5">
        <div class="row justify-content-center">
        	@if($dato->inicialcod6a!=0)
            <!-- Contenedor 1 -->
            <div class="col-6 col-md-2">
                <div class="p-3 border rounded shadow-sm">
                	<label for="">CODIGO 6a</label>
                    <input name="cod6ai" id="cod6ai" value="{{$dato->inicialcod6a}}" style="text-align:right" type="text" class="form-control mb-3" readonly>
                    <input name="cod6af" id="cod6af" type="text" class="form-control mb-3" placeholder="Ingrese Final Cod6a" style="text-align:right" >
                    <input name="cod6ar" id="cod6ar" type="text" class="form-control" placeholder="Recaudacion" style="text-align:right" readonly>
                </div>
            </div>
            @endif
            @if($dato->inicialcod6b!=0)
            <!-- Contenedor 2 -->
            <div class="col-6 col-md-2">
                <div class="p-3 border rounded shadow-sm">
                	<label for="">CODIGO 6b</label>
                    <input name="cod6bi" id="cod6bi" value="{{$dato->inicialcod6b}}" style="text-align:right" type="text" class="form-control mb-3" readonly>
                    <input name="cod6bf" id="cod6bf" type="text" class="form-control mb-3" placeholder="Ingrese Final Cod6b" style="text-align:right" >
                    <input name="cod6br" id="cod6br" type="text" class="form-control" placeholder="Recaudacion" style="text-align:right" readonly>
                </div>
            </div>
            @endif
            @if($dato->inicialcod7a!=0)
            <!-- Contenedor 3 -->
            <div class="col-6 col-md-2">
                <div class="p-3 border rounded shadow-sm">
                	<label for="">CODIGO 7a</label>
                    <input type="text" class="form-control mb-3" placeholder="Texto 1" value="{{$dato->inicialcod7a}}">
                    <input type="text" class="form-control mb-3" placeholder="Texto 2">
                    <input type="text" class="form-control" placeholder="Texto 3">
                </div>
            </div>
            @endif
            @if($dato->inicialcod7b!=0)
            <!-- Contenedor 4 -->
            <div class="col-6 col-md-2">
                <div class="p-3 border rounded shadow-sm">
                	<label for="">CODIGO 7b</label>
                    <input type="text" class="form-control mb-3" placeholder="Texto 1" value="{{$dato->inicialcod7b}}">
                    <input type="text" class="form-control mb-3" placeholder="Texto 2">
                    <input type="text" class="form-control" placeholder="Texto 3">
                </div>
            </div>
            @endif
            @if($dato->inicialcod8a!=0)
            <!-- Contenedor 5 -->
            <div class="col-6 col-md-2">
                <div class="p-3 border rounded shadow-sm">
                	<label for="">CODIGO 8a</label>
                    <input type="text" class="form-control mb-3" placeholder="Texto 1" value="{{$dato->inicialcod8a}}">
                    <input type="text" class="form-control mb-3" placeholder="Texto 2">
                    <input type="text" class="form-control" placeholder="Texto 3">
                </div>
            </div>
            @endif
            @if($dato->inicialcod8b!=0)
            <!-- Contenedor 6 -->
            <div class="col-6 col-md-2">
                <div class="p-3 border rounded shadow-sm">
                	<label for="">CODIGO 8b</label>
                    <input type="text" class="form-control mb-3" placeholder="Texto 1" value="{{$dato->inicialcod8b}}">
                    <input type="text" class="form-control mb-3" placeholder="Texto 2">
                    <input type="text" class="form-control" placeholder="Texto 3">
                </div>
            </div>
            @endif
            @if($dato->inicialcod10a!=0)
            <!-- Contenedor 1 -->
            <div class="col-6 col-md-2">
                <div class="p-3 border rounded shadow-sm">
                	<label for="">CODIGO 10a</label>
                    <input type="text" class="form-control mb-3" placeholder="Texto 1" value="{{$dato->inicialcod10a}}">
                    <input type="text" class="form-control mb-3" placeholder="Texto 2">
                    <input type="text" class="form-control" placeholder="Texto 3">
                </div>
            </div>
            @endif
            @if($dato->inicialcod10b!=0)
            <!-- Contenedor 2 -->
            <div class="col-6 col-md-2">
                <div class="p-3 border rounded shadow-sm">
                	<label for="">CODIGO 10b</label>
                    <input type="text" class="form-control mb-3" placeholder="Texto 1" value="{{$dato->inicialcod10b}}">
                    <input type="text" class="form-control mb-3" placeholder="Texto 2">
                    <input type="text" class="form-control" placeholder="Texto 3">
                </div>
            </div>
            @endif
            @if($dato->inicialcod12a!=0)
            <!-- Contenedor 3 -->
            <div class="col-6 col-md-2">
                <div class="p-3 border rounded shadow-sm">
                	<label for="">CODIGO 12a</label>
                    <input type="text" class="form-control mb-3" placeholder="Texto 1" value="{{$dato->inicialcod12a}}">
                    <input type="text" class="form-control mb-3" placeholder="Texto 2">
                    <input type="text" class="form-control" placeholder="Texto 3">
                </div>
            </div>
            @endif
            @if($dato->inicialcod12b!=0)
            <!-- Contenedor 4 -->
            <div class="col-6 col-md-2">
                <div class="p-3 border rounded shadow-sm">
                	<label for="">CODIGO 12b</label>
                    <input type="text" class="form-control mb-3" placeholder="Texto 1" value="{{$dato->inicialcod12b}}">
                    <input type="text" class="form-control mb-3" placeholder="Texto 2">
                    <input type="text" class="form-control" placeholder="Texto 3">
                </div>
            </div>
            @endif
            @if($dato->inicialcod14a!=0)
            <!-- Contenedor 5 -->
            <div class="col-6 col-md-2">
                <div class="p-3 border rounded shadow-sm">
                	<label for="">CODIGO 14a</label>
                    <input type="text" class="form-control mb-3" placeholder="Texto 1" value="{{$dato->inicialcod14a}}">
                    <input type="text" class="form-control mb-3" placeholder="Texto 2">
                    <input type="text" class="form-control" placeholder="Texto 3">
                </div>
            </div>
             @endif
            @if($dato->inicialcod14b!=0)
            <!-- Contenedor 6 -->
            <div class="col-6 col-md-2">
                <div class="p-3 border rounded shadow-sm">
                	<label for="">CODIGO 14b</label>
                    <input type="text" class="form-control mb-3" placeholder="Texto 1" value="{{$dato->inicialcod14b}}">
                    <input type="text" class="form-control mb-3" placeholder="Texto 2">
                    <input type="text" class="form-control" placeholder="Texto 3">
                </div>
            </div>
   @endif
            @if($dato->inicialcod15a!=0)
            <!-- Contenedor 1 -->
            <div class="col-6 col-md-2">
                <div class="p-3 border rounded shadow-sm">
                	<label for="">CODIGO 15a</label>
                    <input type="text" class="form-control mb-3" placeholder="Texto 1" value="{{$dato->inicialcod15a}}">
                    <input type="text" class="form-control mb-3" placeholder="Texto 2">
                    <input type="text" class="form-control" placeholder="Texto 3">
                </div>
            </div>
             @endif
            @if($dato->inicialcod15b!=0)
            <!-- Contenedor 2 -->
            <div class="col-6 col-md-2">
                <div class="p-3 border rounded shadow-sm">
                	<label for="">CODIGO 15b</label>
                    <input type="text" class="form-control mb-3" placeholder="Texto 1" value="{{$dato->inicialcod15b}}">
                    <input type="text" class="form-control mb-3" placeholder="Texto 2">
                    <input type="text" class="form-control" placeholder="Texto 3">
                </div>
            </div>
             @endif
            @if($dato->inicialcod18a!=0)
            <!-- Contenedor 3 -->
            <div class="col-6 col-md-2">
                <div class="p-3 border rounded shadow-sm">
                	<label for="">CODIGO 18a</label>
                    <input  type="text" class="form-control mb-3" placeholder="Texto 1" value="{{$dato->inicialcod18a}}">
                    <input type="text" class="form-control mb-3" placeholder="Texto 2">
                    <input type="text" class="form-control" placeholder="Texto 3">
                </div>
            </div>
             @endif
            @if($dato->inicialcod18b!=0)
            <!-- Contenedor 4 -->
            <div class="col-6 col-md-2">
                <div class="p-3 border rounded shadow-sm">
                	<label for="">CODIGO 18b</label>
                    <input type="text" class="form-control mb-3" placeholder="Texto 1" value="{{$dato->inicialcod18b}}">
                    <input type="text" class="form-control mb-3" placeholder="Texto 2">
                    <input type="text" class="form-control" placeholder="Texto 3">
                </div>
            </div>
             @endif
            @if($dato->inicialcod21a!=0)
            <!-- Contenedor 5 -->
            <div class="col-6 col-md-2">
                <div class="p-3 border rounded shadow-sm">
                	<label for="">CODIGO 21a</label>
                    <input type="text" class="form-control mb-3" placeholder="Texto 1" value="{{$dato->inicialcod21a}}">
                    <input type="text" class="form-control mb-3" placeholder="Texto 2">
                    <input type="text" class="form-control" placeholder="Texto 3">
                </div>
            </div>
             @endif
            @if($dato->inicialcod21b!=0)
            <!-- Contenedor 6 -->
            <div class="col-6 col-md-2">
                <div class="p-3 border rounded shadow-sm">
                	<label for="">CODIGO 21b</label>
                    <input type="text" class="form-control mb-3" placeholder="Texto 1" value="{{$dato->inicialcod21b}}">
                    <input type="text" class="form-control mb-3" placeholder="Texto 2">
                    <input type="text" class="form-control" placeholder="Texto 3">
                </div>
            </div>
  			@endif
            @if($dato->inicialcod23a!=0)
            <!-- Contenedor 1 -->
            <div class="col-6 col-md-2">
                <div class="p-3 border rounded shadow-sm">
                	<label for="">CODIGO 23a</label>
                    <input type="text" class="form-control mb-3" placeholder="Texto 1" value="{{$dato->inicialcod23a}}">
                    <input type="text" class="form-control mb-3" placeholder="Texto 2">
                    <input type="text" class="form-control" placeholder="Texto 3">
                </div>
            </div>
             @endif
            @if($dato->inicialcod23b!=0)
            <!-- Contenedor 2 -->
            <div class="col-6 col-md-2">
                <div class="p-3 border rounded shadow-sm">
                	<label for="">CODIGO 23b</label>
                    <input type="text" class="form-control mb-3" placeholder="Texto 1" value="{{$dato->inicialcod23b}}">
                    <input type="text" class="form-control mb-3" placeholder="Texto 2">
                    <input type="text" class="form-control" placeholder="Texto 3">
                </div>
            </div>
             @endif
            @if($dato->inicialcod27a!=0)
            <!-- Contenedor 3 -->
            <div class="col-6 col-md-2">
                <div class="p-3 border rounded shadow-sm">
                	<label for="">CODIGO 27a</label>
                    <input type="text" class="form-control mb-3" placeholder="Texto 1" value="{{$dato->inicialcod27a}}">
                    <input type="text" class="form-control mb-3" placeholder="Texto 2">
                    <input type="text" class="form-control" placeholder="Texto 3">
                </div>
            </div>
             @endif
            @if($dato->inicialcod27b!=0)
            <!-- Contenedor 4 -->
            <div class="col-6 col-md-2">
                <div class="p-3 border rounded shadow-sm">
                	<label for="">CODIGO 27b</label>
                    <input type="text" class="form-control mb-3" placeholder="Texto 1" value="{{$dato->inicialcod27b}}">
                    <input type="text" class="form-control mb-3" placeholder="Texto 2">
                    <input type="text" class="form-control" placeholder="Texto 3">
                </div>
            </div>
             @endif
            @if($dato->inicialcod30a!=0)
            <!-- Contenedor 5 -->
            <div class="col-6 col-md-2">
                <div class="p-3 border rounded shadow-sm">
                	<label for="">CODIGO 30a</label>
                    <input type="text" class="form-control mb-3" placeholder="Texto 1" value="{{$dato->inicialcod30a}}">
                    <input type="text" class="form-control mb-3" placeholder="Texto 2">
                    <input type="text" class="form-control" placeholder="Texto 3">
                </div>
            </div>
             @endif
            @if($dato->inicialcod30b!=0)
            <!-- Contenedor 6 -->
            <div class="col-6 col-md-2">
                <div class="p-3 border rounded shadow-sm">
                	<label for="">CODIGO 30b</label>
                    <input type="text" class="form-control mb-3" placeholder="Texto 1" value="{{$dato->inicialcod30b}}">
                    <input type="text" class="form-control mb-3" placeholder="Texto 2">
                    <input type="text" class="form-control" placeholder="Texto 3">
                </div>
            </div>
  			@endif
            @if($dato->inicialcod32a!=0)
            <!-- Contenedor 1 -->
            <div class="col-6 col-md-2">
                <div class="p-3 border rounded shadow-sm">
                	<label for="">CODIGO 32a</label>
                    <input type="text" class="form-control mb-3" placeholder="Texto 1" value="{{$dato->inicialcod32a}}">
                    <input type="text" class="form-control mb-3" placeholder="Texto 2">
                    <input type="text" class="form-control" placeholder="Texto 3">
                </div>
            </div> 
            @endif
            @if($dato->inicialcod32b!=0)
            <!-- Contenedor 2 -->
            <div class="col-6 col-md-2">
                <div class="p-3 border rounded shadow-sm">
                	<label for="">CODIGO 32b</label>
                    <input type="text" class="form-control mb-3" placeholder="Texto 1" value="{{$dato->inicialcod32b}}">
                    <input type="text" class="form-control mb-3" placeholder="Texto 2">
                    <input type="text" class="form-control" placeholder="Texto 3">
                </div>
            </div>
            @endif
            @if($dato->inicialabonoa!=0)
            <!-- Contenedor 3 -->
            <div class="col-6 col-md-2">
                <div class="p-3 border rounded shadow-sm">
                	<label for="">ABONOa</label>
                    <input type="text" class="form-control mb-3" placeholder="Texto 1" value="{{$dato->inicialcodabonoa}}">
                    <input type="text" class="form-control mb-3" placeholder="Texto 2">
                    <input type="text" class="form-control" placeholder="Texto 3">
                </div>
            </div>
            @endif
            @if($dato->inicialabonob!=0)
            <!-- Contenedor 4 -->
            <div class="col-6 col-md-2">
                <div class="p-3 border rounded shadow-sm">
                	<label for="">ABONOb</label>
                    <input type="text" class="form-control mb-3" placeholder="" value="{{$dato->inicialabonob}}">
                    <input type="text" class="form-control mb-3" placeholder="">
                    <input type="text" class="form-control" placeholder="">
                </div>
            </div>
            @endif
        </div>
    </div>

@endforeach
			<div class="Form-group">
				<input type="text" class="form-control"  name="user_id" id="user_id" style="visibility:hidden"  value="{{ Auth::user()->id }}">
			</div>
				
			
			
			<div class="Form-group">
				<button class="btn btn-primary" type="submit" id="guardar">Cargar</button>
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

<script>
        $(document).ready(function () {
            // Agregar evento blur al campo cod6af
            $('#cod6af').on('blur', function () {
                // Obtener los valores de los campos
                const inicial = parseInt($('#cod6ai').val(), 10);
                const final = parseInt($('#cod6af').val(), 10);

                // Validar que ambos valores sean números
                if (isNaN(inicial) || isNaN(final)) {
                    $('#cod6ar').val('Error: valores inválidos');
                    return;
                }
                if(final<inicial)
                {
                    $('#cod6ar').val('Error: no puede ser mayor');
                    return;
                }
                const resto = final-inicial;

                // Mostrar el resultado en el campo cod6ar
                $('#cod6ar').val(resto);
            });
        });
    </script>
@endsection
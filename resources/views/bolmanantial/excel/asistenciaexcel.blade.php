@extends('layouts.admin')
@section('contenido')
@if(Session::has('Mensaje')){{
    
    Session::get('Mensaje')
}}
@endif
	<div  class="main-content">
        <div class="layout-px-spacing">
            <div class="row layout-top-spacing">
                <div class="col-12 layout-spacing">
                    <div class="widget-content-area">
                        <div class="widget-one">
                            <!--TITULO-->
                            <h4 class="text-center mb-5">Exportar Asistencia de Choferes. </h4>
                            {!!Form::open(['route' => 'exportarasistenciaexcel','method'=>'POST'])!!}
    						{{Form::token()}}
                            <!--ENCABEZADO-->
                            <div class="row">
                                <div class="col-sm-12 col-md-2 col-lg-2">Fecha inicial
                                         <input type="date" name="fechai" id="fechai" class="form-control {{$errors->has('fechai')?'is-invalid':''}}" placeholder="Fecha Inicial..." value="{{old('fechai')}}">
    									{!! $errors->first('fechai','<div class="invalid-feedback">:message</div>')!!}
                                </div>
                                <div class="col-sm-12 col-md-2 col-lg-2">Fecha final
                                        <input type="date" name="fechaf" id="fechaf" class="form-control {{$errors->has('fechaf')?'is-invalid':''}}" value="{{old('fechaf')}}">
    									{!! $errors->first('fechaf','<div class="invalid-feedback">:message</div>')!!}
                                </div>
    						     <div class="col-sm-12 col-md-2 col-lg-2">Seleccione Empresa
                                 	   {!!Form::select('empresa_id',$empresa,null,['class' => 'form-control','placeholder'=>'Seleccione una opcion'])!!}
                                       {!! $errors->first('empresa_id','<div class="invalid-feedback">:message</div>')!!}
                                </div>
                               
                            </div>
                            <div>
		                        <div class="col-sm-12 col-md-2 col-lg-2"> 
                                    <div class="form-group">      
                                        <button type="submit" class="btn btn-info mt-4 mobile-only">Ver</button>
                                    </div>
		                        </div>
            		        </div>

			                 {!!Form::close()!!}

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
<!--  END CONTENT AREA  -->
@endsection
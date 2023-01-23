<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Transporte La Nueva Fournier | Sistema Integral</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
    
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('css/AdminLTE.min.css')}}">
    <!-- daterange picker 
  <link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker.css">-->
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('css/_all-skins.min.css')}}">
    <link rel="apple-touch-icon" href="{{asset('img/apple-touch-icon.png')}}">
    <link rel="shortcut icon" href="{{asset('img/favicon.ico')}}">
    <link rel="stylesheet" href="{{asset('assets/lte/select2/dist/css/select2.min.css')}}">


<!-- include the style 

<script type="text/javascript" src="js/script.js"></script> -->
<!-- datatables --> 
<script src=
"https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
    </script>
<!---------------->

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<!-- bootstrap -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" crossorigin="anonymous"></script>
<link  href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" >

<!-- agregado para probar el modal-->
<!--- sacadp para probar datable<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> -->





<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

<!-- para datatable-->
<script src=
"https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
    </script>
<!----------------------------------------------------------------->
    <!-- estilo para el tamaño del select2 -->
    <style>
      .select2-selection{
        height:calc(1.7em + .75rem + 2px) !important;
      }





a {
  outline: none;
  text-decoration: none;
  padding: 2px 1px 0;
}

a:link {
  color: white;
}

a:visited {
  color: white;
}

a:active {
  color: blue;
}


{ font-family:Arial; }
h2 { padding:0 0 5px 5px; }
h2 a { color: #224f99; }
a { color:#999; text-decoration: none; }
a:hover { color:#802727; }
p { padding:0 0 5px 0; }

input { padding:5px; border:1px solid #999; border-radius:4px; -moz-border-radius:4px; -web-kit-border-radius:4px; -khtml-border-radius:4px; }


    </style>


  <!--  ------->

    <!-- mecorre el menu de la plantilla  AGREGADO PARA HACER VALIDACION -->
<!--     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" /> -->

  </head>
  <div class="Form-group">
    <div class="row"> 
      
    </div>
   </div>
  <body class="hold-transition skin-blue sidebar-mini">
<!----AQUI PEGUE EL LOGIN MEJORAR ESTO  si se borra no pasa nada-->









   
  <!-- MEJORAR ESTO ------->

    <div class="wrapper">

      <header class="main-header">

        <!-- Logo -->
        <a href="/" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>NF</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>La Nueva Fournier</b></span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Navegación</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              
              <!-- User Account: style can be found in dropdown.less -->

              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul >
                        <!-- Authentication Links -->
                        @guest
                           
                                <a class="nav-link" href="{{ route('login') }}" >{{ __('Login') }}</a>
                           
                           
                        @else

                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                   <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                        

                        @endguest
                    </ul>
                </div>


                <ul>
                
                  @auth
                  
                        <a href="#" onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">Cerrar Sesion</a>

                  @endauth
                </ul>
          
            </ul>
          </div>

        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
                    
                    
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header"></li>

            <li>
              <a href="/">
                <i class="fa fa-home"></i> <span>Inicio</span>
              </a>
            </li>
            @can('abms')
            <li class="treeview">
              <a href="#">
                <i class="fa fa-laptop"></i>
                <span>ABM's</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                @can('bancos_index')
                <li><a href="/abms/bancos"><i class="fa fa-circle-o"></i> Bancos</a></li>
                @endcan
                
                @can('cajas_index')
                <li><a href="/abms/cajas"><i class="fa fa-circle-o"></i> Cajas</a></li>
                @endcan
                 @can('abms_choferes')
                 <li class="treeview">
                    <a href="#">
                      <i class="fa fa-folder"></i> <span>Choferes</span>
                      <i class="fa fa-angle-left pull-right"></i>
                    </a>
                     <ul class="treeview-menu">
                      <li><a href="/abms/categoria"><i class="fa fa-circle-o"></i> Categorias</a></li>
                        <li><a href="/abms/choferesleagaslnf"><i class="fa fa-circle-o"></i> Choferes</a></li>
                        <li><a href="/abms/gremio"><i class="fa fa-circle-o"></i> Gremios</a></li>
                        <li><a href="/abms/obrasocial"><i class="fa fa-circle-o"></i> Obra Social</a></li>
                        <li><a href="/abms/tiposdecontratacion"><i class="fa fa-circle-o"></i> Tipo Contratacion</a></li>
                    </ul>
                  </li>
                @endcan 
                @can('abms_coches')
                 <li class="treeview">
                    <a href="#">
                      <i class="fa fa-folder"></i> <span>Coches</span>
                      <i class="fa fa-angle-left pull-right"></i>
                    </a>
                     <ul class="treeview-menu">
                      <li><a href="/abms/carroceria"><i class="fa fa-circle-o"></i> Carroceria</a></li>
                <li><a href="/abms/cocheleagaslnf"><i class="fa fa-circle-o"></i> Coches</a></li>
                        <li><a href="/abms/marca"><i class="fa fa-circle-o"></i> Marca</a></li>
                        <li><a href="/abms/modelo"><i class="fa fa-circle-o"></i> Modelo</a></li>
                        
                    </ul>
                  </li>
                @endcan 
                


               
                @can('cuentasbancariaspropias_index')
                <li><a href="/abms/cuentasbancariaspropias"><i class="fa fa-circle-o"></i> Cuentas Bancarias Propias</a></li>
                @endcan
                @can('cuentasbancariasproveedores_index')
                <li><a href="/abms/cuentasbancariasproveedores"><i class="fa fa-circle-o"></i> Cuentas Bancarias Proveedores</a></li>

                
                @endcan
                @can('proveedores_index')
                <li><a href="/abms/proveedores"><i class="fa fa-circle-o"></i> Proveedores</a></li>
                @endcan
                @can('bancos_index')
                <li><a href="/abms/puntos"><i class="fa fa-circle-o"></i> Puntos</a></li>
                @endcan
                @can('bancos_index')
                <li><a href="/abms/servicios"><i class="fa fa-circle-o"></i> Servicios </a></li>
                @endcan

                @can('bancos_index')
                <li><a href="/bolmanantial/boletosleagas"><i class="fa fa-circle-o"></i> Boletos Leagas </a></li>
                @endcan
                @can('bancos_index')
                <li><a href="/crearrol"><i class="fa fa-circle-o"></i> Crear Rol </a></li>
                @endcan
                @can('bancos_index')
                <li><a href="/asignarrol"><i class="fa fa-circle-o"></i> Asignar Rol </a></li>
                @endcan
                @can('bancos_index')
                <li><a href="/crearpermiso"><i class="fa fa-circle-o"></i> Crear Permiso </a></li>
                @endcan
                @can('bancos_index')
                <li><a href="/asignarpermiso"><i class="fa fa-circle-o"></i> Crear Permiso </a></li>
                @endcan
                

                
              </ul>
            </li>
            @endcan
            @can('comprasvarias')
             <li class="treeview">
              <a href="#">
                <i class="fa fa-shopping-cart"></i>
                <span>Compras Varias</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                @can('prueba20')
                <li><a href="/comprasvarias/iniciaroperacion"><i class="fa fa-circle-o"></i> Iniciar Operacion</a></li>
                @endcan
                @can('proveedores_index')
                <li><a href="/comprasvarias/cargarcompra"><i class="fa fa-circle-o"></i> Cargar Compra</a></li>
                @endcan
                @can('proveedores_index')
                <li><a href="/comprasvarias/cerraroperacion"><i class="fa fa-circle-o"></i> Cerrar Operacion</a></li>
                @endcan
              </ul>
            </li>
             @endcan
             @can('cuentascorrientes')
            <li class="treeview">
              <a href="#">
                <i class="fa fa-users"  aria-hidden="true"></i>
                <span>Cuentas Corrientes</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                @can('ctasctesproveedores')
                <li><a href="/cuentascorrientes/proveedores"><i class="fa fa-circle-o"></i> Proveedores</a></li>
                @endcan
                
              </ul>
            </li>
            @endcan
                       
            @can('finanzas')
            <li class="treeview">
              <a href="#">

                <i class="fa fa-money"></i> <span>Finanzas</span>
                <i class="fa fa-angle-left pull-right"></i>

              </a>
              <ul class="treeview-menu">
                
                @can('chequeterceros')
                <li><a href="/finanzas/chequesterceros"><i class="fa fa-circle-o"></i> Cheques de Terceros</a></li>
                @endcan
                @can('cierresdecaja')
                <li><a href="/finanzas/cierrecajas/create"><i class="fa fa-circle-o"></i> Cierres de Caja</a></li>
                @endcan
                @can('ingresochequetercero')
                <li><a href="/finanzas/chequesterceros/create"><i class="fa fa-circle-o"></i> Ingreso Cheque Tercero</a></li>
                @endcan
                @can('movimientoscaja')
                <li><a href="/finanzas/movimientoscajas/iniciar"><i class="fa fa-circle-o"></i> Movimientos de Caja</a></li>
                @endcan
                @can('transferenciascaja')
                <li><a href="/finanzas/movimientoscajas/ingresartransferencia"><i class="fa fa-circle-o"></i> Transferencias de Cajas</a></li>
                @endcan
                
                <!--<li><a href="configuracion/usuario"><i class="fa fa-circle-o"></i> ***** Cuentas Bancarias falta</a></li>-->
                
              </ul>
            </li>
            @endcan
            @can('pagoproveedores')
            <li class="treeview">
             
              <a href="#">
                <i class="fa fa-users"></i> <span>Pagos a Proveedores</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                @can('opproveedores')
                <li><a href="/pagos/opproveedores"><i class="fa fa-circle-o"></i> Generar OP P/Proveedores </a></li>
                @endcan
                @can('op')
                <li><a href="/pagos/ordenesdepagos"><i class="fa fa-circle-o"></i> OP's La Nueva Fournier</a></li>
                @endcan
                @can('op')
                <li><a href="/pagos/ordenesdepagosleagas"><i class="fa fa-circle-o"></i> OP's Leagas</a></li>
                @endcan
               </ul>
            </li>
            @endcan
            
            @can('bolmanantial')
            <li class="treeview">
              <a href="#">
                <i class="fa fa-users"></i> <span>Boleteria Manantial</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                @can('boletosleagas')
                <li><a href="/bolmanantial/boletosleagas"><i class="fa fa-circle-o"></i> Boletos Leagas</a></li>
                @endcan
                @can('boletosleagas')
                <li><a href="/bolmanantial/reportes/boletosleagas"><i class="fa fa-circle-o"></i> Reporte Boletos Leagas</a></li>
                @endcan
                @can('boletoslnf')
                <li><a href="/bolmanantial/boletoslnf"><i class="fa fa-circle-o"></i> Boletos La Nueva Fournier</a></li>
                @endcan
                
               </ul>
            </li>
            @endcan

            
            @can('boltafi')
            <li class="treeview">
              <a href="#">
                <i class="fa fa-users"></i> <span>Boleteria Tafi</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                @can('abonadostafi')
                <li><a href="/boltafi/abonados"><i class="fa fa-circle-o"></i> Abonados</a></li>
                @endcan
                @can('abonadostafi')
                <li><a href="/boltafi/abonados/presentaciondoc"><i class="fa fa-circle-o"></i> Presentar Documentacion</a></li>
                @endcan
                @can('ventatafi')
                <li><a href="/boltafi/ventasdeabonos/venta"><i class="fa fa-circle-o"></i> Venta de abonos</a></li>
                @endcan
                @can('gastostafi')
                <li><a href="/boltafi/cajas/movimiento"><i class="fa fa-circle-o"></i> Caja-Gastos</a></li>
                @endcan
                @can('cargaplanchatafi')
                <li><a href="/boltafi/planchastafi/create"><i class="fa fa-circle-o"></i> Carga de Planchas </a></li>
                @endcan
                @can('tipoabonotafi')
                <li><a href="/boltafi/tiposdeabonos"><i class="fa fa-circle-o"></i> Tipos de Abonos </a></li>
                @endcan
                @can('cierrecajatafi')
                <li><a href="/boltafi/cajas/cierrecajatafi"><i class="fa fa-circle-o"></i> Cierre de Caja </a></li>
                @endcan
                @can('cierrecajatafi')
                <li><a href="/boltafi/cajas/recaudacion"><i class="fa fa-circle-o"></i> Enviar Recaudacion </a></li>
                @endcan
                @can('anularplanchatafi')
                <li><a href="/boltafi/planchastafi/mostraranularplancha"><i class="fa fa-circle-o"></i> Anular Plancha </a></li>
                @endcan
                @can('planchastafi')
                <li><a href="/boltafi/planchastafi/"><i class="fa fa-circle-o"></i> Planchas </a></li>
                @endcan
                @can('abonadostafi')
                <li><a href="/"><i class="fa fa-circle-o"></i> Caja </a></li>
                @endcan

                @can('boltafi')
                <li><a href="/boltafi/reportes/ventasdiarias"><i class="fa fa-circle-o"></i> Reporte Ventas </a></li>
                @endcan
                @can('boltafi')
                <li><a href="/boltafi/reportes/cierresdecajas"><i class="fa fa-circle-o"></i> Reporte Cierres </a></li>
                @endcan
                @can('boltafi')
                <li><a href="/boltafi/cajas/verrecaudaciontafi"><i class="fa fa-circle-o"></i> Reporte Recaudaciones </a></li>
                @endcan

               </ul>
            </li>
            @endcan
            @can('pagoclientes')
            <li class="treeview">
              <a href="#">
                <i class="fa fa-bus"></i> <span>Pagos de Clientes</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                @can('opproveedores')
                <li><a href="/pagos/cliente/pagometropolitana"><i class="fa fa-circle-o"></i> Metropolitana SA</a></li>
                @endcan
                @can('op')
                <li><a href="/pagos/cliente/pagoworldline"><i class="fa fa-circle-o"></i> Worldline Argentina SA</a></li>
                @endcan
               </ul>
            </li>
            @endcan
            @can('ingresoboleterias')
            <li class="treeview">
              <a href="#">
                <i class="fa fa-bus"></i> <span>Ingreso de bolerias</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                @can('opproveedores')
                <li><a href="/pagos/cliente/pagoboleteria122"><i class="fa fa-circle-o"></i> Boleteria 122</a></li>
                @endcan
                @can('op')
                <li><a href="/pagos/cliente/pagoworldline"><i class="fa fa-circle-o"></i> x</a></li>
                @endcan
               </ul>
            </li>
            @endcan
            @can('consultas')
            <li class="treeview">
              <a href="#">
                <i class="fa fa-flag"></i> <span>Consultas</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="treeview">
                    <a href="#">
                      <i class="fa fa-folder"></i> <span>Pagos</span>
                      <i class="fa fa-angle-left pull-right"></i>
                    </a>
                     <ul class="treeview-menu">

                @can('pdfpagosingresos')
                        <li><a href="configuracion/usuario"><i class="fa fa-circle-o"></i> Ingresos</a></li>
                @endcan
                @can('pdfpagosegresos')
                        <li><a href="configuracion/usuario"><i class="fa fa-circle-o"></i> Salidas</a></li>
                @endcan

                    </ul>
                  </li>

                @can('pdfpagos')
                <li><a href="configuracion/usuario"><i class="fa fa-circle-o"></i> Pagos</a></li>
                @endcan
      
                @can('pdfcierrescajas')
                <li><a href="/reportes/boleteria122"><i class="fa fa-circle-o"></i> Ingreso Boleteria 122</a></li>
                @endcan
                @can('pdfctasctesproveedores')
                <li><a href="/reportes/ctasctesp"><i class="fa fa-circle-o"></i> Ctas Ctes. Prov. LNF</a></li>
                @endcan
                @can('pdfctasctesproveedores')
                <li><a href="/reportes/ctasctespleagas"><i class="fa fa-circle-o"></i> Ctas Ctes. Prov. Leagas</a></li>
                @endcan
               
                @can('pdffacturas')
                <li><a href="configuracion/usuario"><i class="fa fa-circle-o"></i> Facturas</a></li>
                @endcan
                @can('pdfcierrescajas')
                <li><a href="/reportes/cierresdecaja"><i class="fa fa-circle-o"></i> Cierres de Caja</a></li>
                @endcan
               
                
              </ul>
            </li>
             @endcan
             <li>
              <a href="#">
                <i class="fa fa-plus-square"></i> <span>Ayuda</span>
                <small class="label pull-right bg-red">PDF</small>
              </a>
            </li>
            <li>
              <a href="#">
                <i class="fa fa-info-circle"></i> <span>Acerca De...</span>
                <small class="label pull-right bg-yellow">IT</small>
              </a>
            </li>
                        
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>





       <!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        
        <!-- Main content -->
        <section class="content">
          
          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Sistema Integral de Transportes</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  	<div class="row">
	                  	<div class="col-md-12">
		                          <!--Contenido-->
                                @include('flash::message')
                              	@yield('contenido')
                                @yield('contenidologin')
		                          <!--Fin Contenido-->
                           </div>
                        </div>
		                    
                  		</div>
                  	</div><!-- /.row -->
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <!--Fin-Contenido-->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.0.0
        </div>
        <strong>Copyright &copy; 2023 - AG Ingenieria de Software.</strong> Todos los derechos reservados.
      </footer>
  
<!-- datatables --> 
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap.min.js"></script>
<!--------------->
        

    
    <!-- jQuery 2.1.4 -->
    
    <!-- Bootstrap 3.3.5 -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('js/app.min.js')}}"></script>
    <!-- Select2 -->
    <script src="{{asset('assets/lte/select2/dist/js/select2.min.js')}}"></script>




   
    <script>
      $(document).ready(function(){
      $("select").select2({
        width: '100%'
        });
      });
    </script>

    <script>
      
    var campos_max=10;   //max de 10 campos
    var x = 0;
    $('#add_field').click (function(e) {
                e.preventDefault();     //prevenir novos clicks

                if (x < campos_max) {
                        $('#listas').append('<div id="tabs" >\
                                                <div class="Form-group col-lg-6 col-lg-6">\
                                                  <label for="fecha">Dia</label>\
                                                  <input type="date" name="fecha[]" id="fecha" class="form-control" placeholder="Fecha Inicio..." required>\
                                                </div>\
                                                <div class="Form-group col-lg-12">\
                                                  <div><label for="pv">ABONOS 122 POR PLANCA (10 UNIDADES)</label></div>\
                                                </div>\
                                                <div class="Form-group col-lg-4 col-lg-4">\
                                                  <label for="totalarendirp">Total a Rendir</label>\
                                                  <input type="number" step=0.01 name="totalarendirp[]" id="totalarendirp" class="form-control" placeholder="Total a Rendir...">\
                                                </div>\
                                                <div class="col-lg-4 col-lg-4">\
                                                  <label for="abonodesdep">Abonos Desde</label>\
                                                  <input type="number" name="abonodesdep[]" id="abonodesdep" class="form-control" placeholder="Abonos desde...">\
                                                </div>\
                                                <div class="col-lg-4 col-lg-4">\
                                                  <label for="abonohastap">Abonos Hasta</label>\
                                                  <input type="number" name="abonohastap[]" id="abonohastap" class="form-control" placeholder="Abonos hasta...">\
                                                  <br>\
                                                </div>\
                                                <div class="Form-group col-lg-12">\
                                                   <div><label for="pv">ABONOS POR UNIDAD</label></div>\
                                                </div>\
                                                <div class="Form-group col-lg-4 col-lg-4">\
                                                  <label for="totalarendiru">Total a Rendir</label>\
                                                  <input type="number" step=0.01 name="totalarendiru[]" id="totalarendiru" class="form-control" placeholder="Total a Rendir...">\
                                                </div>\
                                                <div class="col-lg-4 col-lg-4">\
                                                  <label for="abonodesdeu">Abonos Desde</label>\
                                                  <input type="number" name="abonodesdeu[]" id="abonodesdeu" class="form-control" placeholder="Abonos desde...">\
                                                </div>\
                                                <div class="col-lg-4 col-lg-4">\
                                                  <label for="abonohastau">Abonos Hasta</label>\
                                                  <input type="number" name="abonohastau[]" id="abonohastau" class="form-control" placeholder="Abonos hasta...">\
                                                  <br>\
                                                </div>\
                                                 <div class="Form-group col-lg-12">\
                                                   <div><label for="pv">CIERRE DE VTAS METROPOLITANA</label></div>\
                                                </div>\
                                                <div class="Form-group col-lg-4 col-lg-4">\
                                                  <label for="totalarendirm">Total a Rendir</label>\
                                                  <input type="number" step=0.01 name="totalarendirm[]" id="totalarendirm" class="form-control" placeholder="Total a Rendir...">\
                                                </div>\
                                                <div class="col-lg-4 col-lg-4">\
                                                  <label for="cierrelote">Cierre de lote</label>\
                                                  <input type="number" name="cierrelote[]" id="cierrelote" class="form-control" placeholder="Cierre de Lote...">\
                                                </div>\
                                                <div class="Form-group col-lg-4 col-lg-4">\
                                                   <button class="btn btn-primary remover_campo" id="tabs1" >Remover</button>\
                                                </div>\
                                                 <label for="fecha">_______________________________________________________________________________________</label>\
                                            </div>\
                                            ');
                    
                x++;

                                              $('#tabs').attr('id', 'tr'+x);   
                                              $('#tabs1').attr('id', 'tr'+x); 
                }
        });
        // Remover o div anterior
        $('#listas').on("click",".remover_campo",function(e) {
                e.preventDefault();
                hola=$(this).get(0).id;
                $("#"+hola).remove();
                x--;
        });
    </script>

    @yield("script")

  </body>
</html>


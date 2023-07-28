<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('auth.login');
// });

// Route::get('/', function () {
//     return view('index');
// });

Route::get('/afip/react', function () {
     return view('/afip/react');
 });
Route::get('/afip/prueba','ReporteController@prueba')->name('prueba');

//para inicio del login
Auth::routes(['register'=>false,'reset'=>false]);


Route::get('logout', 'Auth\LoginController@logout');


Route::get('abms/articulos/listarPdf','ArticuloController@listarPdf')->name('articulos_pdf');
Route::get('abms/camiones/listarPdf','CamionController@listarPdf')->name('camiones_pdf');
Route::get('abms/acoplados/listarPdf','AcopladoController@listarPdf')->name('acoplado_pdf');
Route::get('abms/bancos/listarPdf','BancoController@listarPdf')->name('bancoss_pdf');
Route::get('abms/bienesdeuso/listarPdf','BienDeUsoController@listarPdf')->name('biendeuso_pdf');
Route::get('abms/cajas/listarPdf','CajaController@listarPdf')->name('caja_pdf');
//Route::get('abms/categorias/listarPdf','CategoriaController@listarPdf')->name('categorias_pdf');
Route::get('abms/clientes/listarPdf','ClienteController@listarPdf')->name('clientes_pdf');
Route::get('abms/cuentasbancariaspropias/listarPdf','CuentaBancariaPropiaController@listarPdf')->name('cuentasbancariaspropias_pdf');
Route::get('abms/choferes/listarPdf','ChoferController@listarPdf')->name('choferes_pdf');
Route::get('abms/repuestos/listarPdf','RepuestoController@listarPdf')->name('repuestos_pdf');


Route::get('/','InicioController@index')->middleware('auth');

//probando jquery!!

 Route::get('pagos/inicio', function () {
    return view('pagos/inicio');
});
Route::get('pagos/guardar','PagoController@guardar')->name('guardar');
// prueba

Route::get('fletes/listaranticipoPdf/{id?}/pdf','FleteController@listarPdf')->name('flete_pdf');
Route::get('fletes/listarfletePdf/{id?}/pdf','FleteController@listarPdfflete')->name('fletefinal_pdf');
Route::get('pagos/proveedor/{id?}/pdf','PagoController@listarPdfOPProveedor')->name('OPfinalP_pdf');





Route::resource('abms/acoplados','AcopladoController')->middleware('permission:acoplados_index');

//-----Administracion-----rOLES Y PERMISOS//
Route::get('crearrol','AdministracionController@crearrol');
Route::post('guardarrol','AdministracionController@guardarrol');
Route::get('asignarrol','AdministracionController@asignarrol');
Route::post('guardarasignarrol','AdministracionController@guardarasignarrol');
Route::get('crearpermiso','AdministracionController@crearpermiso');
Route::post('guardarpermiso','AdministracionController@guardarpermiso');
Route::get('asignarpermiso','AdministracionController@asignarpermiso');
Route::post('guardarasignarpermiso','AdministracionController@guardarasignarpermiso');



Route::get('abms/administracion/roles','AdministracionController@index');
Route::get('abms/administracion/roles/{rol?}/editar','AdministracionController@edit');
Route::get('abms/administracion/roles/store','AdministracionController@store');
//Route::get('abms/administracion/roles/create','AdministracionController@create');
//Route::get('abms/administracion/roles/store','AdministracionController@store');
//Route::resource('abms/usuarios','UserController'); 
//Route::resource('abms/usuarios','UserController')->middleware('permission:usuarios_index'); 
//Route::resource('abms/roles','RoleController');
//Route::resource('abms/camiones','CamionController')->middleware('permission:camiones_index'); 

//Route::resource('abms/choferes','ChoferController')->middleware('permission:choferes_index');
//Route::resource('abms/choferesleagaslnf','ChoferLeagasLnfController')->middleware('permission:choferes_index');

Route::resource('abms/puntos','PuntoController')->middleware('permission:choferes_index');
Route::resource('abms/servicios','ServicioController')->middleware('permission:choferes_index');
Route::resource('abms/tarifas','TarifaController');
Route::resource('abms/estaciones','EstacionController');
//Route::resource('abms/categorias','CategoriaController');
Route::resource('abms/articulos','ArticuloController')->middleware('permission:articulos_index');
Route::resource('abms/clientes','ClienteController');
Route::resource('abms/bancos','BancoController')->middleware('permission:bancos_index');
Route::resource('abms/repuestos','RepuestoController');
Route::resource('abms/cajas','CajaController');
Route::resource('abms/proveedores','ProveedorController');
Route::resource('abms/cuentasbancariasproveedores','CuentaBancariaProveedorController');
Route::resource('abms/vehiculosparticulares','VehiculoParticularController');
Route::resource('abms/bienesdeuso','BienDeUsoController');
Route::resource('abms/cuentasbancariaspropias','CuentaBancariaPropiaController');
Route::resource('abms/afipprestamosmoratorias','AfipPrestamoMoratoriaController');
Route::resource('abms/rentasprestamosmoratorias','RentaPrestamoMoratoriaController');
Route::resource('abms/prestamos','PrestamoController');

Route::post('abms/choferesleagaslnf/eliminar/{$id}','ChoferLeagasLnfController@eliminar');
Route::post('abms/choferesleagaslnf/{$id}/activardesactivar','ChoferLeagasLnfController@activardesactivar')->name('activardesactivar');




Route::get('fletes/anticipos/{id?}/editaranticipos', 'FleteController@editaranticipos')->name('editaranticipos');
Route::post('fletes/anticipos/guardaredicionanticipos/{id?}','FleteController@guardaredicionanticipos')->name('guardaredicionanticipos');
Route::get('fletes/anticipos/eliminaranticipo/{id?}','FleteController@eliminaranticipo')->name('eliminaranticipo');
Route::get('fletes/anticipos/{id?}/nuevoanticipo', 'FleteController@nuevoanticipo')->name('nuevoanticipo');

//Route::post('fletes/anticipos/guardaranticipo','FleteController@guardaranticipo')->name('guardaranticipo');
Route::resource('fletes','FleteController');

Route::get('fletes/vales/{id?}/editarvales', 'FleteController@editarvales')->name('editarvales');
Route::get('fletes/vales/{id?}/edicion', 'FleteController@edicion')->name('edicion');
Route::get('fletes/vales/eliminarvale/{id?}','FleteController@eliminarvale')->name('eliminarvale');
Route::get('fletes/vales/{id?}/nuevovale', 'FleteController@nuevovale')->name('nuevovale');
Route::post('fletes/vales/guardarvale','FleteController@guardarvale')->name('guardarvale');
Route::patch('fletes/vales/guardaredicion/{id?}','FleteController@guardaredicion')->name('guardaredicion');
Route::get('fletes/{id?}/cancelarflete', 'FleteController@cancelarflete')->name('cancelarflete');


Route::get('fletes/{id?}/finalizarflete', 'FleteController@finalizarflete')->name('finalizarflete');
Route::post('fletes/guardarfinalizarflete/{id?}','FleteController@guardarfinalizarflete')->name('guardarfinalizarflete');

Route::resource('movimientos/articulos','MovimientoArticuloController');
Route::get('movimientos/articulos/listar','MovimientoArticuloController@show');
Route::get('movimientos/articulos/{id?}/detalle','MovimientoArticuloController@detalle');
Route::get('movimientos/articulos/{id?}/editar','MovimientoArticuloController@editar');
Route::patch('movimientos/articulos/guardaredicion/{id?}','MovimientoArticuloController@guardaredicion');
Route::resource('movimientos/edicionmovimientoarticulo','EdicionMovimientoArticuloController');

Route::get('movimientos/edicionmovimientoarticulo/{id?}/detalle','EdicionMovimientoArticuloController@detalle');
Route::get('movimientos/edicionmovimientoarticulo/{id?}/editardetalle','EdicionMovimientoArticuloController@editardetalle')->name('editardetalle');
Route::patch('movimientos/edicionmovimientoarticulo/guardareditardetalle/{id?}','MovimientoArticuloController@guardareditardetalle')->name('guardareditardetalle');

Route::resource('movimientos/pallets','MovimientoPalletController');





Route::get('finanzas/movimientoscajas/iniciar','MovimientoCajaController@iniciar')->name('finanzas.movimientos.iniciar');


//**************************************************************
//***CHOFERES LEAGAS LNF***************************************
//**************************************************************

Route::get('abms/choferesleagaslnf','ChoferLeagasLnfController@index')->name('choferesleagaslnf');
Route::get('abms/choferesleagaslnf/create','ChoferLeagasLnfController@create')->name('create');
Route::post('abms/choferesleagaslnf/store','ChoferLeagasLnfController@store')->name('store');
Route::get('abms/choferesleagaslnf/{id?}/edit', 'ChoferLeagasLnfController@edit')->name('edit');
Route::get('abms/choferesleagaslnf/{id?}/desactivar', 'ChoferLeagasLnfController@desactivar')->name('desactivar');
Route::patch('abms/choferesleagaslnf/guardardesactivar', 'ChoferLeagasLnfController@guardardesactivar')->name('guardardesactivar');
Route::patch('abms/choferesleagaslnf/update','ChoferLeagasLnfController@update')->name('update');

Route::resource('abms/tiposdecontratacion','TipoContratacionController');
Route::resource('abms/obrasocial','ObraSocialController');
Route::resource('abms/categoria','CategoriaController');
Route::resource('abms/gremio','GremioController');




//**************************************************************
//***COCHES LEAGAS LNF***************************************
//**************************************************************

Route::get('abms/cocheleagaslnf','CocheLeagasLnfController@index')->name('abms.chocheleagaslnf');
Route::get('abms/cocheleagaslnf/create','CocheLeagasLnfController@create')->name('create');
Route::post('abms/cocheleagaslnf/store','CocheLeagasLnfController@store')->name('store');
Route::get('abms/cocheleagaslnf/{id}/edit','CocheLeagasLnfController@edit')->name('edit');
Route::get('abms/cocheleagaslnf/{id}/informecoche','CocheLeagasLnfController@informecoche')->name('informecoche');
Route::patch('abms/cocheleagaslnf/guardaredicioncoche','CocheLeagasLnfController@guardaredicioncoche')->name('guardaredicioncoche');

Route::resource('abms/carroceria','CarroceriaController');
Route::resource('abms/modelo','ModeloController');
Route::resource('abms/marca','MarcaController');


//**************************************************************
//***BOLETERIA MANANTIAL***************************************
//**************************************************************
Route::get('bolmanantial/boletosleagas','BolManantialController@index')->name('bolmanantial.boletosleagas')->middleware('permission:bolmanantial');
Route::get('bolmanantial/boletoslnf','BolManantialController@indexlnf')->name('bolmanantial.boletoslnf')->middleware('permission:bolmanantial');

Route::get('bolmanantial/boletosleagas/create','BolManantialController@create')->name('bolmanantial.boletosleagas.create')->middleware('permission:bolmanantial');
Route::get('bolmanantial/boletosleagas/createlnf','BolManantialController@createlnf')->name('bolmanantial.boletosleagas.createlnf')->middleware('permission:bolmanantial');
Route::post('bolmanantial/boletosleagas/store','BolManantialController@store')->name('store')->middleware('permission:bolmanantial');
Route::get('bolmanantial/boletoleagas/{id}/informeboletoleagas','BolManantialController@informeboletoleagas')->name('informeboletoleagas')->middleware('permission:bolmanantial');

Route::get('bolmanantial/reportes/boletosleagas','BolManantialController@boletosleagas')->name('boletoslegas')->middleware('permission:bolmanantial');
Route::post('bolmanantial/reportes/reporteboletosleagas','BolManantialController@reporteboletosleagas')->name('reporteboletosleagas')->middleware('permission:bolmanantial');




Route::get('bolmanantial/reportes/reportechoferesleagas','BolManantialController@reportechoferesleagas')->name('reportechoferesleagas')->middleware('permission:bolmanantial');

Route::get('bolmanantial/reportes/reportechofereslnf','BolManantialController@reportechofereslnf')->name('reportechofereslnf')->middleware('permission:bolmanantial');

Route::get('bolmanantial/reportes/gasoil','BolManantialController@gasoil')->name('gasoil')->middleware('permission:bolmanantial');
Route::post('bolmanantial/reportes/reportegasoil','BolManantialController@reportegasoil')->name('reportegasoil')->middleware('permission:bolmanantial');
Route::get('bolmanantial/reportes/asistencia','BolManantialController@asistencia')->name('asistencia')->middleware('permission:bolmanantial');
Route::post('bolmanantial/reportes/reporteasistencia','BolManantialController@reporteasistencia')->name('reporteasistencia')->middleware('permission:bolmanantial');
Route::post('bolmanantial/boletosleagas/buscarservicios', 'BolManantialController@buscarservicios')->name('buscarservicios')->middleware('auth');
Route::post('/bolmanantial/boletosleagas/buscarkms', 'BolManantialController@buscarkms')->name('buscarkms')->middleware('auth');

Route::get('bolmanantial/boletos/servicios', 'BolManantialController@servicios')->name('servicios')->middleware('auth')->middleware('permission:servicios');
Route::get('bolmanantial/boletos/createservicio', 'BolManantialController@createservicio')->name('createservicio')->middleware('permission:servicios');
Route::post('bolmanantial/boletosleagas/storeservicio','BolManantialController@storeservicio')->name('storeservicio')->middleware('permission:servicios');
Route::get('bolmanantial/boletos/{id}/editarservicio','BolManantialController@editarservicio')->name('editarservicio')->middleware('permission:servicios');
Route::patch('bolmanantial/boletos/guardaredicionservicios','BolManantialController@guardaredicionservicios')->name('guardaredicionservicios')->middleware('permission:servicios');
Route::get('bolmanantial/boletos/ramal', 'BolManantialController@ramal')->name('ramal')->middleware('permission:ramales');
Route::get('bolmanantial/boletos/createramal', 'BolManantialController@createramal')->name('createramal')->middleware('permission:ramales');
Route::post('bolmanantial/boletosleagas/storeramal','BolManantialController@storeramal')->name('storeramal')->middleware('permission:ramales');
//Route::get('bolmanantial/boletos/{id}/cargargasoil','BolManantialController@cargargasoil')->name('cargargasoil');
Route::get('bolmanantial/boletos/cargargasoilleagas','BolManantialController@cargargasoilleagas')->name('cargargasoilleagas')->middleware('permission:boletoslnf');
Route::patch('bolmanantial/boletos/guardarcargagasoilleagas','BolManantialController@guardarcargagasoilleagas')->name('guardarcargagasoilleagas')->middleware('permission:boletoslnf');
Route::get('bolmanantial/boletos/cargargasoillnf','BolManantialController@cargargasoillnf')->name('cargargasoillnf')->middleware('permission:boletoslnf');
Route::patch('bolmanantial/boletos/guardarcargagasoillnf','BolManantialController@guardarcargagasoillnf')->name('guardarcargagasoillnf')->middleware('permission:boletoslnf');

Route::get('bolmanantial/boletos/{id}/cambiocoche','BolManantialController@cambiocoche')->name('cambiocoche');
Route::patch('bolmanantial/boletos/guardarcambiocoche','BolManantialController@guardarcambiocoche')->name('guardarcambiocoche');



Route::get('bolmanantial/gasoil/gasoilleagas','BolManantialController@gasoilleagas')->name('bolmanantial.gasoil.gasoilleagas')->middleware('permission:bolmanantial');
Route::get('bolmanantial/gasoil/cargargasoilleagas','BolManantialController@cargargasoilleagas')->name('cargargasoilleagas')->middleware('permission:boletoslnf');
Route::patch('bolmanantial/boletos/guardarcargagasoilleagas','BolManantialController@guardarcargagasoilleagas')->name('guardarcargagasoilleagas')->middleware('permission:boletoslnf');
//--------------------------------------------------------------
//-------------- FIN BOLETERIA MANANTIAL -----------------------
//--------------------------------------------------------------


//**************************************************************
//***BOLETERIA TAFI VIEJO***************************************
//**************************************************************

//ABONADOS
Route::get('boltafi/abonados','AbonadoController@index')->name('boltafi.abonados');
Route::get('boltafi/abonados/create','AbonadoController@create')->name('create');
Route::post('boltafi/abonados/store','AbonadoController@store')->name('store');
Route::get('boltafi/abonados/{id?}/edit', 'AbonadoController@edit')->name('edit');
Route::post('boltafi/abonados/guardareditarabonado','AbonadoController@guardareditarabonado')->name('guardareditarabonado');
Route::get('boltafi/abonados/presentaciondoc','AbonadoController@presentaciondoc')->name('presentaciondoc');
Route::post('boltafi/abonados/guardardocumentacion','AbonadoController@guardardocumentacion')->name('guardardocumentacion');


//FIN ABONADOS

//TIPOS DE ABONOS
Route::get('boltafi/tiposdeabonos','TipoAbonoController@index')->name('index');
Route::get('boltafi/tiposdeabonos/create','TipoAbonoController@create')->name('create');
Route::post('boltafi/tiposdeabonos/store','TipoAbonoController@store')->name('store');
//FIN TIPOS DE ABONOS

//PLANCHAS
Route::get('boltafi/planchastafi/create','PlanchaTafiController@create')->name('create');
Route::post('boltafi/planchastafi/store','PlanchaTafiController@store')->name('store');
Route::get('boltafi/planchastafi/mostraranularplancha','PlanchaTafiController@mostraranularplancha')->name('mostraranularplancha');
Route::post('boltafi/planchastafi/anularplancha','PlanchaTafiController@anularplancha')->name('anularplancha');
Route::get('boltafi/planchastafi','PlanchaTafiController@index')->name('boltafi.planchastafi');
Route::get('boltafi/ventasdeabonos/imprimirabono','PlanchaTafiController@imprimirabono')->name('imprimirabono');
//FIN PLANCHAS

//VENTAS
Route::get('boltafi/ventasdeabonos/venta','PlanchaTafiController@venta')->name('venta');
Route::post('boltafi/ventasdeabonos/guardarventa','PlanchaTafiController@guardarventa')->name('guardarventa');
Route::post('boltafi/ventasdeabonos/buscarabonado', 'PlanchaTafiController@buscarabonado')->name('buscarabonado');
Route::get('boltafi/ventasdeabonos/impresion','PlanchaTafiController@impresion')->name('impresion');
//FIN VENTAS

//CAJAS
Route::get('boltafi/cajas/movimiento','CajaTafiController@movimiento')->name('movimiento');
Route::post('boltafi/cajas/guardarmovimiento','CajaTafiController@guardarmovimiento')->name('guardarmovimiento');
Route::get('boltafi/cajas/cierrecajatafi','CajaTafiController@cierrecajatafi')->name('cierrecajatafi');
Route::post('boltafi/cajas/guardarcierrecajatafi','CajaTafiController@guardarcierrecajatafi')->name('guardarcierrecajatafi');
Route::get('boltafi/cajas/recaudacion','CajaTafiController@recaudacion')->name('recaudacion');
Route::post('boltafi/cajas/guardarrecaudaciontafi','CajaTafiController@guardarrecaudaciontafi')->name('guardarrecaudaciontafi');

Route::get('boltafi/cajas/verrecaudaciontafi','CajaTafiController@verrecaudaciontafi')->name('verrecaudaciontafi');
Route::get('boltafi/cajas/{id?}/imprimirrecaudaciontafi', 'CajaTafiController@imprimirrecaudaciontafi')->name('imprimirrecaudaciontafi');

//FIN CAJAS

//REPORTES
Route::get('boltafi/reportes/ventasdiarias','CajaTafiController@ventasdiarias')->name('ventasdiarias');
Route::post('boltafi/reportes/reporteventasboltafi','CajaTafiController@reporteventasboltafi')->name('reporteventasboltafi');
Route::get('boltafi/reportes/cierresdecajas','CajaTafiController@cierresdecajas')->name('cierresdecajas');
Route::post('boltafi/reportes/reportecierresdecajas','CajaTafiController@reportecierresdecajas')->name('reportecierresdecajas');
//FIN DE REPORTES


//**************************************************************
//***FIN BOLETERIA TAFI VIEJO***********************************
//**************************************************************

Route::get('finanzas/movimientoscajas/ingresartransferencia','MovimientoCajaController@ingresartransferencia');
Route::post('finanzas/movimientoscajas/guardartransferencia','MovimientoCajaController@guardartransferencia')->name('guardartransferencia');
Route::get('finanzas/movimientoscajas/ingresarchequepropio','MovimientoCajaController@ingresarchequepropio');
Route::post('finanzas/movimientoscajas/guardarchequepropio','MovimientoCajaController@guardarchequepropio')->name('guardarchequepropio');
Route::resource('finanzas/movimientoscajas','MovimientoCajaController');
Route::resource('finanzas/chequesterceros','ChequeTerceroController');
Route::resource('finanzas/cierrecajas','CierreCajaController');
Route::resource('finanzas/chequespropios','ChequePropioController');



Route::get('pagos/pagoefectivo','PagoController@pagoefectivo');
Route::post('pagos/guardarpagoefectivo','PagoController@guardarpagoefectivo')->name('guardarpagoefectivo');
Route::get('pagos/cheque','PagoController@cheque');
Route::post('pagos/guardarpagocheque','PagoController@guardarpagocheque')->name('guardarpagocheque');
Route::get('pagos/chequepropio','PagoController@chequepropio');
Route::post('pagos/guardarpagochequepropio','PagoController@guardarpagochequepropio')->name('guardarpagochequepropio');
Route::get('pagos/transferencia','PagoController@transferencia');
Route::post('pagos/guardarpagotransferencia','PagoController@guardarpagotransferencia')->name('guardarpagotransferencia');
Route::get('pagos/prestamo','PagoController@prestamo');
Route::get('pagos/listarprestamo','PagoController@listarprestamo');
Route::post('pagos/guardarprestamo','PagoController@guardarprestamo')->name('guardarprestamo');
Route::get('pagos/{id?}/saldarcuota', 'PagoController@saldarcuota')->name('saldarcuota');
Route::get('pagos/anticipo','PagoController@anticipo');
Route::post('pagos/anticipos/guardaranticipo','PagoController@guardaranticipo')->name('guardaranticipo');


Route::get('pagos/opchoferes','PagoController@opchoferes');//pasa datos para inciar la op de choferes
Route::post('pagos/generaropchofer','PagoController@generaropchofer')->name('generaropchofer');

Route::get('pagos/chofer/{id?}/pagoefectivochofer', 'PagoController@pagoefectivochofer')->name('pagoefectivochofer');
Route::get('pagos/chofer/{id?}/pagotransferenciachofer', 'PagoController@pagotransferenciachofer')->name('pagotransferenciachofer');
Route::get('pagos/chofer/{id?}/pagochequepropiochofer', 'PagoController@pagochequepropiochofer')->name('pagochequepropiochofer');
Route::get('pagos/chofer/{id?}/pagochequetercerochofer', 'PagoController@pagochequetercerochofer')->name('pagochequetercerochofer');


Route::get('pagos/proveedor/{id?}/pagochequeterceroproveedor', 'PagoController@pagochequeterceroproveedor')->name('pagochequeterceroproveedor');
Route::get('pagos/proveedor/{id?}/pagochequepropioproveedor', 'PagoController@pagochequepropioproveedor')->name('pagochequepropioproveedor');
Route::get('pagos/proveedor/{id?}/pagoefectivoproveedor', 'PagoController@pagoefectivoproveedor')->name('pagoefectivoproveedor');
Route::get('pagos/proveedor/{id?}/pagotransferenciaproveedor', 'PagoController@pagotransferenciaproveedor')->name('pagotransferenciaproveedor');




Route::post('pagos/chofer/guardarpagoefectivochofer','PagoController@guardarpagoefectivochofer')->name('guardarpagoefectivochofer');
Route::post('pagos/chofer/guardarpagotransferenciachofer','PagoController@guardarpagotransferenciachofer')->name('guardarpagotransferenciachofer');
Route::post('pagos/chofer/guardarpagochequepropiochofer','PagoController@guardarpagochequepropiochofer')->name('guardarpagochequepropiochofer');
Route::post('pagos/chofer/guardarpagochequetercerochofer','PagoController@guardarpagochequetercerochofer')->name('guardarpagochequetercerochofer');

Route::post('pagos/proveedor/guardarpagochequeterceroproveedor','PagoController@guardarpagochequeterceroproveedor')->name('guardarpagochequeterceroproveedor');
Route::post('pagos/proveedor/guardarpagochequepropioproveedor','PagoController@guardarpagochequepropioproveedor')->name('guardarpagochequepropioproveedor');
Route::post('pagos/proveedor/guardarpagoefectivoproveedor','PagoController@guardarpagoefectivoproveedor')->name('guardarpagoefectivoproveedor');
Route::post('pagos/chofer/guardarpagotransferenciaproveedor','PagoController@guardarpagotransferenciaproveedor')->name('guardarpagotransferenciaproveedor');



Route::get('pagos/proveedor/{id?}/cerrarop','PagoController@cerrarop')->name('cerrarop');
Route::get('pagos/chofer/{id?}/cerrarop','PagoController@cerraropchofer')->name('cerraropchofer');



Route::get('pagos/cliente/pagometropolitana','MovimientoCajaController@pagometropolitana')->name('pagometropolitana');
Route::post('pagos/cliente/ingresarpagometropolitana','MovimientoCajaController@ingresarpagometropolitana')->name('ingresarpagometropolitana');


Route::get('pagos/cliente/pagoworldline','MovimientoCajaController@pagoworldline')->name('pagoworldline');
Route::post('pagos/cliente/ingresarpagoworldline','MovimientoCajaController@ingresarpagoworldline')->name('ingresarpagoworldline');

Route::get('pagos/cliente/pagoboleteria122','MovimientoCajaController@pagoboleteria122')->name('pagoboleteria122');
Route::post('pagos/cliente/ingresar122','MovimientoCajaController@ingresar122')->name('ingresar122');

Route::get('pagos/opproveedores','PagoController@opproveedores'); 
Route::post('pagos/generaropproveedor','PagoController@generaropproveedor')->name('generaropproveedor');

Route::get('pagos/ordenesdepagos','PagoController@ordenesdepagos');
Route::get('pagos/ordenesdepagosleagas','PagoController@ordenesdepagosleagas');



Route::get('mantenimientos/camion','MantenimientoController@camion');
Route::post('mantenimientos/guardarcamion','MantenimientoController@guardarcamion')->name('guardarcamion');
Route::get('mantenimientos/listarcamion','MantenimientoController@listarcamion');
Route::get('mantenimientos/{slug?}/editarcamion', 'MantenimientoController@editarcamion')->name('editarcamion');
Route::post('mantenimientos/guardaredicioncamion/{id?}','MantenimientoController@guardaredicioncamion')->name('guardaredicioncamion');
Route::get('mantenimientos/{slug?}/finalizarcamion', 'MantenimientoController@finalizarcamion')->name('finalizarcamion');
//Route::post('mantenimientos/finalizarcamion','MantenimientoController@finalizarcamion')->name('finalizarcamion');

Route::get('mantenimientos/acoplado','MantenimientoController@acoplado');
Route::post('mantenimientos/guardaracoplado','MantenimientoController@guardaracoplado')->name('guardaracoplado');
Route::get('mantenimientos/listaracoplado','MantenimientoController@listaracoplado');
Route::get('mantenimientos/{slug?}/finalizaracoplado', 'MantenimientoController@finalizaracoplado')->name('finalizaracoplado');
Route::post('mantenimientos/guardaredicionacoplado/{id?}','MantenimientoController@guardaredicionacoplado')->name('guardaredicionacoplado');



Route::get('cuentascorrientes/clientes/','CtaCteCController@index');
Route::get('cuentascorrientes/clientes/{id?}/nuevocomprobante', 'CtaCteCController@nuevocomprobante')->name('nuevocomprobante');
Route::get('cuentascorrientes/clientes/{id?}/listar', 'CtaCteCController@listarcomprobantes')->name('listarcomprobantes');

Route::post('cuentascorrientes/clientes/guardarcomprobantec/{id?}','CtaCteCController@guardarcomprobantec')->name('guardarcomprobantec');
Route::post('cuentascorrientes/clientes/guardarfacturac/{id?}','CtaCteCController@guardarfacturac')->name('guardarfacturac');
Route::get('cuentascorrientes/clientes/{id?}/asociar','CtaCteCController@asociarcomprobantec')->name('aosciarcomprobantec');

Route::get('cuentascorrientes/proveedores/','CtaCtePController@index');
Route::get('cuentascorrientes/proveedores/{id?}/nuevocomprobante', 'CtaCtePController@nuevocomprobante')->name('
	nuevocomprobante');
Route::post('cuentascorrientes/proveedores/guardarcomprobantep/{id?}','CtaCtePController@guardarcomprobantep')->name('guardarcomprobantep');
Route::get('cuentascorrientes/proveedores/{id?}/listar', 'CtaCtePController@listarcomprobantes')->name('listarcomprobantes');
Route::get('cuentascorrientes/proveedores/{id?}/listarleagas', 'CtaCtePController@listarcomprobantesleagas')->name('listarcomprobantesleagas');

Route::get('cuentascorrientes/clientes/{id?}/editar', 'CtaCteCController@editarcomprobantec')->name('editarcomprobantec');

Route::post('cuentascorrientes/clientes/{id?}/guardaredicioncomprobante','CtaCteCController@guardaredicioncomprobante')->name('guardaredicioncomprobante');
Route::get('cuentascorrientes/clientes/{id?}/nuevaop', 'CtaCteCController@nuevaop')->name('
	nuevaop');
Route::post('cuentascorrientes/clientes/guardaropc/{id?}','CtaCteCController@guardaropc')->name('guardaropc');


Route::get('cuentascorrientes/choferes/','CtaCteChoController@index');
Route::get('cuentascorrientes/choferes/{id?}/nuevocomprobante', 'CtaCteChoController@nuevocomprobante')->name('
	nuevocomprobante');
Route::post('cuentascorrientes/choferes/guardarcomprobantecho/{id?}','CtaCteChoController@guardarcomprobantecho')->name('guardarcomprobantecho');
Route::get('cuentascorrientes/choferes/{id?}/listar', 'CtaCteChoController@listarcomprobantes')->name('listarcomprobantes');

Route::get('comprasvarias/iniciaroperacion/','CompraVariaController@index');
Route::post('comprasvarias/ingresarcomprasvarias/','CompraVariaController@ingresarcomprasvarias')->name('ingresarcomprasvarias');
Route::get('comprasvarias/cargarcompra/','CompraVariaController@cargarcompra')->name('cargarcompra');
Route::post('comprasvarias/ingresarcompra/','CompraVariaController@ingresarcompra')->name('ingresarcompra');
Route::get('comprasvarias/cerraroperacion/','CompraVariaController@cerraroperacion')->name('cerraroperacion');
Route::post('comprasvarias/ingresarcerraroperacion/','CompraVariaController@ingresarcerraroperacion')->name('ingresarcerraroperacion');



//REPORTES **************************************************************************************************
//CTAS CTES CLIENTES
Route::get('reportes/ctasctesc/','ReporteController@index');
Route::post('reportes/reportectasctesc/','ReporteController@reportectasctesc')->name('reportectasctesc');


//CTAS CTES PROVEEDORES
Route::get('reportes/ctasctesp/','ReporteController@ctasctesp');
Route::get('reportes/ctasctespleagas/','ReporteController@ctasctespleagas');

Route::post('reportes/reportectasctesp/','ReporteController@reportectasctesp')->name('reportectasctesp');
Route::post('reportes/reportectasctespleagas/','ReporteController@reportectasctespleagas')->name('reportectasctespleagas');


//CTAS CTES CHOFERES
Route::get('reportes/ctasctescho/','ReporteController@ctasctescho');
Route::post('reportes/reportectasctescho/','ReporteController@reportectasctescho')->name('reportectasctescho');


//ARTICULOS
Route::get('reportes/articulos/','ReporteController@articulos');
Route::post('reportes/reportearticulos/','ReporteController@reportearticulos')->name('reportearticulos');

//PALLET
Route::get('reportes/pallets/','ReporteController@pallets');
Route::post('reportes/reportepallet/','ReporteController@reportepallet')->name('reportepallet');

//MantenimientoCamion
Route::get('reportes/mantenimientocamion/','ReporteController@mantenimientocamion');
Route::post('reportes/reportemantenimientocamion/','ReporteController@reportemantenimientocamion')->name('reportemantenimientocamion');

//MOVIMIENTO ARTICULOS por fechas
Route::get('reportes/movimientosarticulos/','ReporteController@movimientosarticulos');
Route::post('reportes/reportemovimientosarticulos/','ReporteController@reportemovimientosarticulos')->name('reportemovimientosarticulos');

//CIERRES DE CAJA POR FECHAS
Route::get('reportes/cierresdecaja/','ReporteController@cierresdecaja');
Route::post('reportes/reportecierresdecaja/','ReporteController@reportecierresdecaja')->name('reportecierresdecaja');

//BOLETERIA 122 POR FECHAS
Route::get('reportes/boleteria122/','ReporteController@boleteria122');
Route::post('reportes/reporteboleteria122/','ReporteController@reporteboleteria122')->name('reporteboleteria122');

//************************************************************************************************************


// Auth::routes(['register'=>false,'reset'=>false]);

// Route::get('/home', 'CamionController@index')->name('home'); //cuando se loguea me lleva a esa direccion

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');




// pdfs!!!!!!

Route::get('acoplado-list-pdf','AcopladoController@exportPdf')->name('acoplados.pdf');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

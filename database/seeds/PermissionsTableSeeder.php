<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
use App\Caja;



class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
   
   public function run()
    {

	
	DB::table('cajas')->insert([
        'denominacion'  => 'CAJA LA NUEVA FOURNIER',
        'descripcion'  => 'CAJA PRINCIPAL',
        'condicion'     => '0',
    ]);
	DB::table('cajas')->insert([
        'denominacion'  => 'CAJA LEAGAS',
        'descripcion'  => 'CAJA PRINCIPAL',
        'condicion'     => '0',
    ]);
	DB::table('empresas')->insert([
        'denominacion'  => 'LA NUEVA FOURNIER S.R.L.',
        'cuit'  => '30-71002307-3',
        'condicion'     => '0',
    ]);
    DB::table('empresas')->insert([
        'denominacion'  => 'LEAGAS SA',
        'cuit'  => '33-71484098-9',
        'condicion'     => '0',
    ]);
	DB::table('empresasboltafi')->insert([
        'nombre'  => 'La Nueva Fournier',
        'nombre_corto'  => 'LNF',
        'porcentaje'  => '50'
    ]);
    DB::table('empresasboltafi')->insert([
        'nombre'  => 'El Rayo',
        'nombre_corto'  => 'ER',
        'porcentaje'  => '50'
    ]);

	DB::table('users')->insert([
        'name'  => 'Veronica',
        'Tipo'  => 'Administracion',
        'email'     => 'vero@transporte.com',
        'password'  => bcrypt('12345678'),
    ]);
 	DB::table('users')->insert([
        'name'  => 'Alejandro Gianuzzi',
        'Tipo'  => 'Admin',
        'email'     => 'admin@transporte.com',
        'password'  => bcrypt('12345678'),
    ]);
    DB::table('users')->insert([
        'name'  => 'Consulta',
        'Tipo'  => 'Consulta',
        'email'     => 'consulta@transporte.com',
        'password'  => bcrypt('consulta'),
    ]);

    DB::table('users')->insert([
        'name'  => 'Florencia',
        'Tipo'  => 'BolTafi',
        'email'     => 'florencia@transporte.com',
        'password'  => bcrypt('12345678'),
    ]);
	DB::table('users')->insert([
        'name'  => 'Mauricio',
        'Tipo'  => 'BolTerminal',
        'email'     => 'mauricio@transporte.com',
        'password'  => bcrypt('12345678'),
    ]);

    DB::table('users')->insert([
        'name'  => 'Susana',
        'Tipo'  => 'BolTerminal',
        'email'     => 'susana@transporte.com',
        'password'  => bcrypt('12345678'),
    ]);

    DB::table('users')->insert([
        'name'  => 'Fernanda',
        'Tipo'  => 'SupervisorBol',
        'email'     => 'fernanda@transporte.com',
        'password'  => bcrypt('12345678'),
    ]);
     DB::table('users')->insert([
        'name'  => 'Ixis',
        'tipo'  => 'Dueno',
        'email'     => 'ixis@transporte.com',
        'password'  => bcrypt('lnf1234'),
    ]);
      DB::table('users')->insert([
        'name'  => 'Jorge',
        'tipo'  => 'Dueno',
        'email'     => 'jorge@transporte.com',
        'password'  => bcrypt('lnf1234'),
    ]);


		//Lista de permisos
    	Permission::Create(['name' =>'abonados_index']);
		Permission::Create(['name' =>'abonados_create']);
		Permission::Create(['name' =>'abonados_edit']);
		Permission::Create(['name' =>'abonados_destroy']);
		Permission::Create(['name' =>'tipoabonos_index']);
		Permission::Create(['name' =>'tipoabonos_create']);
		Permission::Create(['name' =>'tipoabonos_edit']);
		Permission::Create(['name' =>'tipoabonos_destroy']);
		Permission::Create(['name' =>'bancos_index']);
		Permission::Create(['name' =>'bancos_create']);
		Permission::Create(['name' =>'bancos_edit']);
		Permission::Create(['name' =>'bancos_destroy']);
		Permission::Create(['name' =>'bienesdeuso_index']);
		Permission::Create(['name' =>'bienesdeuso_create']);
		Permission::Create(['name' =>'bienesdeuso_edit']);
		Permission::Create(['name' =>'bienesdeuso_destroy']);
		Permission::Create(['name' =>'cajas_index']);
		Permission::Create(['name' =>'cajas_create']);
		Permission::Create(['name' =>'cajas_edit']);
		Permission::Create(['name' =>'cajas_destroy']);
		Permission::Create(['name' =>'camiones_index']);
		Permission::Create(['name' =>'camiones_create']);
		Permission::Create(['name' =>'camiones_edit']);
		Permission::Create(['name' =>'camiones_destroy']);
		Permission::Create(['name' =>'categorias_index']);
		Permission::Create(['name' =>'categorias_create']);
		Permission::Create(['name' =>'categorias_edit']);
		Permission::Create(['name' =>'categorias_destroy']);
    	Permission::Create(['name' =>'choferes_index']);
		Permission::Create(['name' =>'choferes_create']);
		Permission::Create(['name' =>'choferes_edit']);
		Permission::Create(['name' =>'choferes_destroy']);
		Permission::Create(['name' =>'clientes_index']);
		Permission::Create(['name' =>'clientes_create']);
		Permission::Create(['name' =>'clientes_edit']);
		Permission::Create(['name' =>'clientes_destroy']);
		Permission::Create(['name' =>'cuentasbancariaspropias_index']);
		Permission::Create(['name' =>'cuentasbancariaspropias_create']);
		Permission::Create(['name' =>'cuentasbancariaspropias_edit']);
		Permission::Create(['name' =>'cuentasbancariaspropias_destroy']);
		Permission::Create(['name' =>'cuentasbancariasproveedores_index']);
		Permission::Create(['name' =>'cuentasbancariasproveedores_create']);
		Permission::Create(['name' =>'cuentasbancariasproveedores_edit']);
		Permission::Create(['name' =>'cuentasbancariasproveedores_destroy']);
		Permission::Create(['name' =>'estaciones_index']);
		Permission::Create(['name' =>'estaciones_create']);
		Permission::Create(['name' =>'estaciones_edit']);
		Permission::Create(['name' =>'estaciones_destroy']);
		Permission::Create(['name' =>'prestamos_index']);
		Permission::Create(['name' =>'prestamos_create']);
		Permission::Create(['name' =>'prestamos_edit']);
		Permission::Create(['name' =>'prestamos_destroy']);
		Permission::Create(['name' =>'proveedores_index']);
		Permission::Create(['name' =>'proveedores_create']);
		Permission::Create(['name' =>'proveedores_edit']);
		Permission::Create(['name' =>'proveedores_destroy']);
		Permission::Create(['name' =>'rentasprestamosmoratorias_index']);
		Permission::Create(['name' =>'rentasprestamosmoratorias_create']);
		Permission::Create(['name' =>'rentasprestamosmoratorias_edit']);
		Permission::Create(['name' =>'rentasprestamosmoratorias_destroy']);
		Permission::Create(['name' =>'repuestos_index']);
		Permission::Create(['name' =>'repuestos_create']);
		Permission::Create(['name' =>'repuestos_edit']);
		Permission::Create(['name' =>'repuestos_destroy']);
		Permission::Create(['name' =>'roles_index']);
		Permission::Create(['name' =>'roles_create']);
		Permission::Create(['name' =>'roles_edit']);
		Permission::Create(['name' =>'roles_destroy']);
		Permission::Create(['name' =>'vehiculosparticulares_index']);
		Permission::Create(['name' =>'vehiculosparticulares_create']);
		Permission::Create(['name' =>'vehiculosparticulares_edit']);
		Permission::Create(['name' =>'vehiculosparticulares_destroy']);
		Permission::Create(['name' =>'tarifas_index']);
		Permission::Create(['name' =>'tarifas_create']);
		Permission::Create(['name' =>'tarifas_edit']);
		Permission::Create(['name' =>'tarifas_destroy']);

		
		Permission::Create(['name' =>'movimientosarticulos']);
		Permission::Create(['name' =>'edicionmovimientoarticulo']);
		Permission::Create(['name' =>'movimientospallets']);

		Permission::Create(['name' =>'ctasctesclientes']);
		Permission::Create(['name' =>'ctascteschoferes']);
		Permission::Create(['name' =>'ctasctesproveedores']);

		Permission::Create(['name' =>'mantenimientocamion']);
		Permission::Create(['name' =>'listarmantenimientocamion']);

		Permission::Create(['name' =>'anticiposchoferes']);
		Permission::Create(['name' =>'prestamochoferes']);		
		Permission::Create(['name' =>'listarprestamochoferes']);		

		Permission::Create(['name' =>'chequeterceros']);
		Permission::Create(['name' =>'cierresdecaja']);		
		Permission::Create(['name' =>'cobrochequepropio']);
		Permission::Create(['name' =>'ingresochequepropio']);
		Permission::Create(['name' =>'ingresochequetercero']);		
		Permission::Create(['name' =>'movimientoscaja']);
		Permission::Create(['name' =>'transferenciascaja']);


		Permission::Create(['name' =>'opchoferes']);		
		Permission::Create(['name' =>'opproveedores']);
		Permission::Create(['name' =>'op']);

		Permission::Create(['name' =>'iniciarflete']);
		Permission::Create(['name' =>'listarfletes']);

		//consultas PDF -------------------------------------------
		Permission::Create(['name' =>'pdfmantenimientos']);
		Permission::Create(['name' =>'pdfstock']);
		Permission::Create(['name' =>'pdfpagosingresos']);
		Permission::Create(['name' =>'pdfpagosegresos']);
		Permission::Create(['name' =>'pdfpagos']);
		Permission::Create(['name' =>'pdfctasctesclientes']);
		Permission::Create(['name' =>'pdfctasctesproveedores']);
		Permission::Create(['name' =>'pdfctascteschoferes']);
		Permission::Create(['name' =>'pdfarticulosclientes']);
		Permission::Create(['name' =>'pdfpallets']);
		Permission::Create(['name' =>'pdfmantenimientoscamiones']);
		Permission::Create(['name' =>'pdfmovimientosarticulos']);
		Permission::Create(['name' =>'pdffacturas']);
		Permission::Create(['name' =>'pdfcierrescajas']);
		Permission::Create(['name' =>'pdffletes']);
		Permission::Create(['name' =>'pdfcierrecajatafi']);
		Permission::Create(['name' =>'pdfrecaudacionestafi']);
		Permission::Create(['name' =>'pdfventastafi']);

		//para usar
		Permission::Create(['name' =>'administradores']);
		Permission::Create(['name' =>'taller']);
		Permission::Create(['name' =>'administracion']);
		Permission::Create(['name' =>'logistica']);
		Permission::Create(['name' =>'consulta']);
		Permission::Create(['name' =>'tallerlogistica']);
		Permission::Create(['name' =>'talleradministracion']);
		Permission::Create(['name' =>'administracionlogistica']);
		Permission::Create(['name' =>'inicio']);
		Permission::Create(['name' =>'dueño']);




		//Boleteria TAFI
		Permission::Create(['name' =>'abonadostafi']);
		Permission::Create(['name' =>'presentardocumentaciontafi']);
		Permission::Create(['name' =>'ventatafi']);
		Permission::Create(['name' =>'gastostafi']);
		Permission::Create(['name' =>'cargaplanchatafi']);
		Permission::Create(['name' =>'tipoabonotafi']);
		Permission::Create(['name' =>'cierrecajatafi']);
		Permission::Create(['name' =>'enviarrecaudaciontafi']);
		Permission::Create(['name' =>'anularplanchatafi']);
		Permission::Create(['name' =>'planchastafi']);
		Permission::Create(['name' =>'cajatafi']);
		Permission::Create(['name' =>'reportestafisupervisor']);
		Permission::Create(['name' =>'reportestafigerente']);
		Permission::Create(['name' =>'reportedueños']);
		
		//MENUS
		Permission::Create(['name' =>'abms']);
		Permission::Create(['name' =>'comprasvarias']);
		Permission::Create(['name' =>'cuentascorrientes']);
		Permission::Create(['name' =>'finanzas']);
		Permission::Create(['name' =>'pagoproveedores']);
		Permission::Create(['name' =>'boltafi']);
		Permission::Create(['name' =>'pagoclientes']);
		Permission::Create(['name' =>'ingresoboleterias']);
		Permission::Create(['name' =>'consultas']);
		//----------------------------------------------



		//---------------------------------------------------------
		$admin=Role::create(['name'=>'Admin']);
		$administracion=Role::create(['name'=>'Administracion']);
		$boltafi=Role::create(['name'=>'BolTafi']);
		$consulta=Role::create(['name'=>'Consulta']);
		$bolterminal=Role::create(['name'=>'BolTerminal']);
		$supervisorbol=Role::create(['name'=>'SupervisorBol']);
		$logistica=Role::create(['name'=>'Logistica']);
		$taller=Role::create(['name'=>'Taller']);
		$dueno=Role::create(['name'=>'Dueno']);

		$admin->givePermissionTo([
			'abonados_index',
			'abonados_create',
			'abonados_edit',
			'abonados_destroy',
			'tipoabonos_index',
			'tipoabonos_create',
			'tipoabonos_edit',
			'tipoabonos_destroy',
			'abonadostafi',
			'presentardocumentaciontafi',
			'ventatafi',
			'gastostafi',
			'cargaplanchatafi',
			'tipoabonotafi',
			'cierrecajatafi',
			'enviarrecaudaciontafi',
			'anularplanchatafi',
			'planchastafi',
			'cajatafi',
			'reportestafisupervisor',
			'reportestafigerente',
			'reportedueños',
			'abms',
			'comprasvarias',
			'cuentascorrientes',
			'finanzas',
			'pagoproveedores',
			'boltafi',
			'pagoclientes',
			'ingresoboleterias',
			'consultas',
			'bancos_index',
			'bancos_create',
			'bancos_edit',
			'bancos_destroy',
			'bienesdeuso_index',
			'bienesdeuso_create',
			'bienesdeuso_edit',
			'bienesdeuso_destroy',
			'cajas_index',
			'cajas_create',
			'cajas_edit',
			'cajas_destroy',
			'camiones_index',
			'camiones_create',
			'camiones_edit',
			'camiones_destroy',
			'categorias_index',
			'categorias_create',
			'categorias_edit',
			'categorias_destroy',
			'choferes_index',
			'choferes_create',
			'choferes_edit',
			'choferes_destroy',
			'clientes_index',
			'clientes_create',
			'clientes_edit',
			'clientes_destroy',
			'cuentasbancariaspropias_index',
			'cuentasbancariaspropias_create',
			'cuentasbancariaspropias_edit',
			'cuentasbancariaspropias_destroy',
			'cuentasbancariasproveedores_index',
			'cuentasbancariasproveedores_create',
			'cuentasbancariasproveedores_edit',
			'cuentasbancariasproveedores_destroy',
			'estaciones_index',
			'estaciones_create',
			'estaciones_edit',
			'estaciones_destroy',
			'prestamos_index',
			'prestamos_create',
			'prestamos_edit',
			'prestamos_destroy',
			'proveedores_index',
			'proveedores_create',
			'proveedores_edit',
			'proveedores_destroy',
			'rentasprestamosmoratorias_index',
			'rentasprestamosmoratorias_create',
			'rentasprestamosmoratorias_edit',
			'rentasprestamosmoratorias_destroy',
			'repuestos_index',
			'repuestos_create',
			'repuestos_edit',
			'repuestos_destroy',
			'roles_index',
			'roles_create',
			'roles_edit',
			'roles_destroy',
			'vehiculosparticulares_index',
			'vehiculosparticulares_create',
			'vehiculosparticulares_edit',
			'vehiculosparticulares_destroy',
			'cuentasbancariaspropias_index',
			'cuentasbancariaspropias_create',
			'cuentasbancariaspropias_edit',
			'cuentasbancariaspropias_destroy',
			'tarifas_index',
			'tarifas_create',
			'tarifas_edit',
			'tarifas_destroy',
			'movimientosarticulos',
			'edicionmovimientoarticulo',
			'movimientospallets',
			'ctasctesclientes',
			'ctascteschoferes',
			'ctasctesproveedores',
			'mantenimientocamion',
			'listarmantenimientocamion',
			'anticiposchoferes',
			'prestamochoferes',
			'listarprestamochoferes',
			'chequeterceros',
			'cierresdecaja',
			'cobrochequepropio',
			'ingresochequepropio',
			'ingresochequetercero',
			'movimientoscaja',
			'transferenciascaja',
			'opchoferes',
			'opproveedores',
			'op',
			'iniciarflete',
			'listarfletes',
			'pdfmantenimientos',
			'pdfstock',
			'pdfpagosingresos',
			'pdfpagosegresos',
			'pdfpagos',
			'pdfctasctesclientes',
			'pdfctasctesproveedores',
			'pdfctascteschoferes',
			'pdfarticulosclientes',
			'pdfpallets',
			'pdfmantenimientoscamiones',
			'pdfmovimientosarticulos',
			'pdffacturas',
			'pdfcierrescajas',
			'pdffletes',
			'pdfcierrecajatafi',
			'pdfrecaudacionestafi',
			'pdfventastafi',
			'administradores',
			'taller',
			'logistica',
			'consulta',
			'administracion',
			'tallerlogistica',
			'talleradministracion',
			'inicio',
		    'administracionlogistica'
		]);

		$logistica->givePermissionTo([
			'iniciarflete',
			'listarfletes',
			'listarmantenimientocamion',
			'choferes_index',
			
			'camiones_index',
			'logistica',
			'tallerlogistica',
			'administracionlogistica',
			'pdffletes',
			'pdfmantenimientoscamiones',
			'pdfctascteschoferes',
			'inicio',
			'pdfmantenimientos'
		]);


		$administracion->givePermissionTo([
			'abms',
			'comprasvarias',
			'cuentascorrientes',
			'finanzas',
			'pagoproveedores',
			'boltafi',
			'pagoclientes',
			'ingresoboleterias',
			'consultas',
			'abonadostafi',
			'reportestafisupervisor',
			'camiones_index',
			'repuestos_index',
			'repuestos_create',
			'repuestos_destroy',
			'movimientosarticulos',
			'edicionmovimientoarticulo',
			'movimientospallets',
			'mantenimientocamion',
			'listarmantenimientocamion',
			'administracionlogistica',
			'administracion',
			'talleradministracion',
			'pdfmantenimientos',
			'pdfstock',
			'pdfarticulosclientes',
			'pdfpallets',
			'pdfmantenimientoscamiones',
			'inicio',
			'pdfmovimientosarticulos'
		]);

		$taller->givePermissionTo([
			'pdfstock',
			'pdfmantenimientoscamiones',
			'pdfmantenimientos',
			'talleradministracion',
			'taller',
			'tallerlogistica',
			'inicio',
			'repuestos_index'
		]);

		$consulta->givePermissionTo([
			'abonadostafi',
			'ventatafi',
			'gastostafi',
			'cargaplanchatafi',
			'tipoabonotafi',
			'cierrecajatafi',
			'anularplanchatafi',
			'planchastafi',
			'reportestafisupervisor',
			'abms',
			'comprasvarias',
			'cuentascorrientes',
			'finanzas',
			'pagoproveedores',
			'boltafi',
			'pagoclientes',
			'ingresoboleterias',
			'consultas',
			'pdfmantenimientos',
			'pdfstock',
			'pdfpagosingresos',
			'pdfpagosegresos',
			'pdfpagos',
			'pdfctasctesclientes',
			'pdfctasctesproveedores',
			'pdfctascteschoferes',
			'pdfarticulosclientes',
			'pdfpallets',
			'pdfmantenimientoscamiones',
			'pdfmovimientosarticulos',
			'pdffacturas',
			'pdfcierrescajas',
			'inicio',
			'pdffletes'
		]);

		$boltafi->givePermissionTo([
			'gastostafi',
			'cierrecajatafi',
			'anularplanchatafi',
			'planchastafi',
			'reportestafisupervisor',
			'boltafi',
			'consultas',
			'abonadostafi',
			'ventatafi',
			'cajatafi',
			'abonados_create',
			'abonados_edit',
			'abonados_destroy',
			'pdfcierrecajatafi',
			'pdfrecaudacionestafi',
			'pdfventastafi',
			'presentardocumentaciontafi',
			'enviarrecaudaciontafi'
		]);

		$supervisorbol->givePermissionTo([
			'abonadostafi',
			'cargaplanchatafi',
			'tipoabonotafi',
			'planchastafi',
			'reportestafisupervisor',
			'boltafi',
			'consultas',
			'tipoabonos_index',
			'tipoabonos_create',
			'tipoabonos_edit',
			'tipoabonos_destroy',
			'pdfcierrecajatafi',
			'pdfrecaudacionestafi',
			'pdfventastafi'

		]);
		$dueno->givePermissionTo([
			'abms',
			'boltafi',
			'abonadostafi',
			'cargaplanchatafi',
			'presentardocumentaciontafi',
			'ventatafi',
			'tipoabonotafi',
			'anularplanchatafi',
			'planchastafi',
			'reportestafisupervisor',
			'boltafi',
			'cajatafi',
			'consultas',
			'tipoabonos_index',
			'tipoabonos_create',
			'tipoabonos_edit',
			'tipoabonos_destroy',
			'abonados_create',
			'abonados_edit',
			'abonados_destroy',
			'pdfcierrecajatafi',
			'pdfrecaudacionestafi',
			'cierrecajatafi',
			'enviarrecaudaciontafi',
			'pdfventastafi'

		]);

		$user=User::find(1);//Vero
		$user->assignRole('Admin');
		$user=User::find(2);//Ale
		$user->assignRole('Admin');
		$user=User::find(3);//CONSULTA
		$user->assignRole('Consulta');
		$user=User::find(4);//CONSULTA
		$user->assignRole('BolTafi');
		$user=User::find(7);//CONSULTA
		$user->assignRole('SupervisorBol');

		$user=User::find(8);//ixis
		$user->assignRole('Dueno');	
		$user=User::find(9);//jorge
		$user->assignRole('Dueno');		
		

	}
}

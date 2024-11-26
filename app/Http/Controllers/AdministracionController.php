<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;
use Laracasts\Flash\Flash;
 use Illuminate\Database\Seeder; 
use App\User;

class AdministracionController extends Controller
{

    public function crearrol()
    {
        return view('administracion.crearrol');
    }
    public function guardarrol(Request $request)
    {
        Role::create(['name' => $request->rol]);
        return view('/');
    }
    public function asignarrol()
    {

        return view('administracion.asignarrol');
    }
    public function guardarasignarrol(Request $request)
    {
        //dd($request);
        
        //para reasiganar un rol hacerlo desde la tabla model_has_roles, cambiar en la columna role_id
        $user = User::find(18);
        $user->assignRole($request->rol);
       // Role::create(['name' => $request->rol]);
        return view('/');
    }
    public function crearpermiso()
    {
        return view('administracion.crearpermiso');
    }
    public function guardarpermiso(Request $request)
    {

        Permission::create(['name' => $request->permiso]);
        return view('/');
    }
    public function asignarpermiso()
    {

        $permissions=Permission::get();
        $role=Role::get();
        
        return view('administracion.asignarpermiso')
        ->with('permissions',$permissions)
        ->with('role',$role);
    }
    public function guardarasignarpermiso(Request $request)
    {
        // para eliminar un permiso a un rol primero  eliminar el permiso asignado al rol en la table y luego ejecutar esto
       // $user=User::find(7);
       //$user->revokePermissionTo('abms');
       //dd('listo');

        //$persmisos=$user->getAllPermissions();

        //$role->hasPermissionTo("abms");

        //$role = Role::find(6);
        //$user=User::find(6);
        //$role->givePermissionTo('universal');
        

        //asignacion de multiples permisos funciona
       $role = Role::find(9);//id del rol
       $role->syncPermissions(request()->input('permissions',[]));
       $role->permissions()->sync($request->get('permissions'));


       // dd('listo a');
            // para asiganar o agregar un permiso a un rol
      //  $role = Role::find(11);
      //  $role->givePermissionTo('servicios');

        dd('listo a');
        return view('/');
    }



    public function index()
    {
        $roles=Role::with('permissions')->get();
        return view('abms.administracion.roles.index',compact('roles'));
    }
        public function edit(Role $rol)
    {
        $permisos=Permission::all();
        $rol->load('permissions');
        
        
        return view('abms.administracion.roles.editar',compact('rol','permisos'));
    }
    public function create()
    {    
        $permissions=Permission::get();
        return view('abms.administracion.roles.create',compact('permissions'));
    }

    public function store(Request $request)
    {
        dd($request);
        $roleparaasignar=Role::find(3);

       $user=User::find(9);//CONSULTA
       $user->removeRole('Admin');
       $user->assignRole($roleparaasignar);
       $user->hasRole('BolTafi');
        dd($user);
        $role=Role::create(['name'=> $request->name,'description'=> $request->description]);
        //actualizar permisos
        $role->permissions()->sync($request->get('permissions'));
        

        $roles=Role::paginate();
        return view('abms.administracion.roles.index',compact('roles'));
        /*return redirect()->route('roles.index')
            ->with('info','Role Guardado con exito');*/
    }

    // Permission::Create(['name' =>'nuevo']);
    //     Role::Create(['analista' =>'analista']);
    //     $admin = Role::find(9);
    //     $admin->givePermissionTo([
    //         'nuevo',
    //                 ]);
}

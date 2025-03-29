<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;
use App\Empleado;
use App\Coche;
use App\Repuesto;
use App\ServiceDetalle;
use App\ServiceEstado;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{


    public function monitoringView()
{
    $services = Service::with(['coche', 'empleado', 'detalles.repuesto'])
        ->whereIn('estado', ['Pendiente', 'En Proceso'])
        ->orWhere(function ($query) {
            $query->whereIn('estado', ['Finalizado', 'Cancelado'])
                  ->orderBy('fecha_service', 'desc')
                  ->limit(5);
        })
        ->get();

    return view('panol.services.monitoring', compact('services'));
}

public function monitoringData(Request $request)
{
    $offset = (int) $request->get('offset', 0);
    $limit = (int) $request->get('limit', 6);

    // Obtener los últimos 30 registros ordenados por ID ascendente
    $services = Service::with(['coche', 'empleado', 'detalles.repuesto'])
        ->orderBy('id', 'asc')
        ->limit(30)
        ->get();

    // Obtener el subconjunto basado en el offset y el límite
    $servicesToShow = $services->slice($offset, $limit);

    return view('panol.services.partials.monitoring_data', compact('servicesToShow'));
}


    public function eliminarRepuestos($id)
    {
        $service = Service::findOrFail($id);
        $repuestos = $service->detalles()->with('repuesto')->get();
        return view('panol.services.eliminar_repuestos', compact('service', 'repuestos'));
    }

    public function destroyRepuestos(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            foreach ($request->repuestos as $rep_id => $data) {
                // Verificar si el checkbox está seleccionado
                if (isset($data['id'])) {
                    $detalle = ServiceDetalle::where('service_id', $id)->where('repuesto_id', $rep_id)->first();
                    if ($detalle) {
                        $cantidadEliminar = intval($data['cantidad']);
                        
                        if ($cantidadEliminar >= $detalle->cantidad) {
                            // Si la cantidad a eliminar es igual o mayor, eliminar el detalle
                            $detalle->repuesto->increment('cantidad_lnf', $detalle->cantidad); // Devolver todo al stock
                            $detalle->delete();
                        } else {
                            // Si es menor, solo restar la cantidad eliminada
                            $detalle->repuesto->increment('cantidad_lnf', $cantidadEliminar);
                            $detalle->decrement('cantidad', $cantidadEliminar);
                        }
                    }
                }
            }
            
            DB::commit();
            return redirect()->route('services.index')->with('success', 'Repuestos eliminados correctamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Error al eliminar repuestos']);
        }
    }

public function agregarRepuestos($id)
    {
        $service = Service::findOrFail($id);
        $repuestos = Repuesto::all();
        return view('panol.services.agregar_repuestos', compact('service', 'repuestos'));
    }

    public function storeRepuestos(Request $request, $id)
    {
        $request->validate([
            'repuestos' => 'required|array|min:1',
            'repuestos.*.id' => 'required|exists:repuestos,id',
            'repuestos.*.cantidad' => 'required|integer|min:1'
        ]);

        DB::beginTransaction();
        try {
            foreach ($request->repuestos as $rep) {
                $repuesto = Repuesto::findOrFail($rep['id']);
                
                if ($repuesto->cantidad_lnf < $rep['cantidad']) {
                    return redirect()->back()->withErrors(['error' => 'Stock insuficiente para ' . $repuesto->nombre]);
                }

                $repuesto->decrement('cantidad_lnf', $rep['cantidad']);

                ServiceDetalle::create([
                    'service_id' => $id,
                    'repuesto_id' => $rep['id'],
                    'cantidad' => $rep['cantidad']
                ]);
            }
            
            DB::commit();
            return redirect()->route('services.index')->with('success', 'Repuestos agregados correctamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Error al agregar repuestos']);
        }
    }



public function updateEstado(Request $request, $id)
    {
        $request->validate([
            'estado' => 'required|in:Pendiente,En Proceso,Finalizado,Cancelado'
        ]);

        DB::beginTransaction();
        try {
            $service = Service::findOrFail($id);
            $estadoAnterior = $service->estado;
            $empleado=$service->empleado_id;
            if ($estadoAnterior !== $request->estado) {
                // Registrar cambio de estado
                ServiceEstado::create([
                    'service_id' => $id,
                    'empleado_id' => $empleado, // Se asume que el usuario está autenticado
                    'estado_anterior' => $estadoAnterior,
                    'estado_nuevo' => $request->estado,
                    'fecha_cambio' => now(),
                ]);
            }

            $service->update(['estado' => $request->estado]);
            
            DB::commit();
            return response()->json(['message' => 'Estado actualizado correctamente']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Error al actualizar el estado'], 500);
        }
    }

    public function index()
{

    $services = Service::with('coche', 'empleado')->get();
    return view('panol.services.index', compact('services'));
}
    public function create()
    {

       $coches = Coche::all();
       $empleados = Empleado::all();
       $repuestos = Repuesto::all();
    
        return view('panol.services.create', compact('empleados', 'coches', 'repuestos'));
    }

    public function store(Request $request)
    {


        $request->validate([
            'coche_id' => 'required|exists:coches,id',
            'empleado_id' => 'required|exists:empleados,id',
            'fecha_service' => 'required|date',
           /* 'estado' => 'required',*/
            'observaciones' => 'nullable|string',
            'repuestos' => 'required|array',
            'repuestos.*.id' => 'required|exists:repuestos,id',
            'repuestos.*.cantidad' => 'required|integer|min:1'
        ]);
        $Mensaje=["required"=>'El :attribute es requerido'];
        

        DB::beginTransaction();
        try {
            $service = Service::create([
                'coche_id' => $request->coche_id,
                'empleado_id' => $request->empleado_id,
                'fecha_service' => $request->fecha_service,
                'estado' => 'Pendiente',
                'observaciones' => $request->observaciones
            ]);

            foreach ($request->repuestos as $rep) {
                $repuesto = Repuesto::findOrFail($rep['id']);
                
                if ($repuesto->cantidad_lnf < $rep['cantidad']) {
                    return response()->json(['error' => 'Stock insuficiente para ' . $repuesto->nombre], 400);
                }
                
                $repuesto->decrement('cantidad_lnf', $rep['cantidad']);
                
                ServiceDetalle::create([
                    'service_id' => $service->id,
                    'repuesto_id' => $rep['id'],
                    'cantidad' => $rep['cantidad']
                ]);
            }
            ServiceEstado::create([
                'service_id' => $service->id,
                'empleado_id' => $request->empleado_id,
                'estado_anterior' => null, // No hay estado anterior al crearlo
                'estado_nuevo' => 'Pendiente',
                'fecha_cambio' => now(),
            ]);
            
            DB::commit();
            return response()->json(['success' => 'Service registrado correctamente']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Error al registrar el service'], 500);
        }
    }
}

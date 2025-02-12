<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Repuesto;
use App\TipoComprobante;
use App\TurnoPanol;
use App\Proveedor;
use App\ComprobanteRepuesto;
use App\MovimientoRepuesto;
use App\AnulacionComprobante;


class PanolController extends Controller
{


/* esto es para lnf */
public function guardarcomprobante(Request $request)
    {
        // Validación de los datos
        $validated = $request->validate([
            'nrocomprobante' => 'required|string|max:255',
            'tipocomprobante' => 'required|exists:tipocomprobantes,id',
            'turnopañol' => 'required|exists:turnopañol,id',
            'fecharecepcion' => 'required|date',
            'fechacomprobante' => 'required|date',
            'proveedor' => 'required|exists:proveedores,id',
            'repuestos' => 'required|array',
            'repuestos.*.id' => 'required|exists:repuestos,id',
            'repuestos.*.cantidad' => 'required|numeric|min:1',
        ]);

        // Guardar el comprobante en la tabla comprobanterepuestos
        $comprobante = new ComprobanteRepuesto();
        $comprobante->nrocomprobante = $validated['nrocomprobante'];
        $comprobante->tipocomprobante_id = $validated['tipocomprobante'];
        $comprobante->turnopañol_id = $validated['turnopañol'];
        $comprobante->fecharecepcion = $validated['fecharecepcion'];
        $comprobante->fechacomprobante = $validated['fechacomprobante'];
        $comprobante->proveedor_id = $validated['proveedor'];
        $comprobante->estadocomprobante_id = 1; // Estado por defecto
        $comprobante->save();

        // Guardar los repuestos en la tabla movimientorepuestos y actualizar cantidad en repuestos
        foreach ($validated['repuestos'] as $repuesto) {
            // Guardar en movimientorepuestos
            $movimiento = new MovimientoRepuesto();
            $movimiento->comprobanterepuesto_id = $comprobante->id;
            $movimiento->repuesto_id = $repuesto['id'];
            $movimiento->cantidad = $repuesto['cantidad'];
            $movimiento->descripcion = 'ori';
            $movimiento->save();

            // Incrementar la cantidad en la tabla repuestos
            $repuestoModelo = Repuesto::findOrFail($repuesto['id']);
            $repuestoModelo->cantidad_lnf += $repuesto['cantidad'];
            $repuestoModelo->save();
        }

        // Respuesta exitosa
        return response()->json(['message' => 'Comprobante, movimientos y actualización de repuestos guardados con éxito.'], 201);
    }
/**** guardar comprobante de LNF *////////////



public function comprobanterepuestos(Request $request)
{
    $validated = $request->validate([
        'nrocomprobante' => 'required|string',
        'tipocomprobante_id' => 'required|integer',
        'turnopañol_id' => 'required|integer',
        'fecharecepcion' => 'required|date',
        'fechacomprobante' => 'required|date',
        'proveedor_id' => 'required|integer',
        'estadocomprobante_id' => 'required|integer',
        'movimientos' => 'required|array',
        'movimientos.*.repuesto_id' => 'required|integer',
        'movimientos.*.cantidad' => 'required|integer',
        'movimientos.*.descripcion' => 'nullable|string',
    ]);

    // Crear el comprobante
    $comprobante = ComprobanteRepuesto::create($validated);

    // Procesar los movimientos
    foreach ($validated['movimientos'] as $movimiento) {
        $movimiento['comprobanterepuesto_id'] = $comprobante->id;
        MovimientoRepuesto::create($movimiento);

        // Actualizar los repuestos
        $repuesto = Repuesto::find($movimiento['repuesto_id']);
        $repuesto->increment('cantidad', $movimiento['cantidad']);
    }

    return response()->json(['message' => 'Comprobante creado exitosamente'], 200);
}





     public function ingresarrepuestos()
    {


        return view('panol.ingresarrepuestos');
            
    }
        public function cargarrepuesto()
    {

    try {
        // Seleccionamos los campos necesarios
        $repuestos = Repuesto::all(['id', 'codigo', 'nombre', 'cantidad_lnf']);
        return response()->json($repuestos);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
    }

    public function cargarproveedor()
    {
        
    try {
        // Seleccionamos los campos necesarios
        $repuestos = Proveedor::all(['id', 'nombre', 'direccion', 'cuit']);
        return response()->json($repuestos);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
    }
  public function cargartipocomprabante()
    {
    try {
        // Seleccionamos los campos necesarios
        $repuestos = TipoComprobante::all(['id', 'nombre']);
        return response()->json($repuestos);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function cargarturnopañol()
    {
    try {
        // Seleccionamos los campos necesarios
        $repuestos = TurnoPanol::all(['id', 'nombre']);
        return response()->json($repuestos);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function guardarRemito(Request $request)
{
    try {
        DB::beginTransaction();

        // Guardar en la tabla remitorepuestos
        $remitoId = DB::table('remitorepuestos')->insertGetId([
            'nro_remito' => $request->nro_remito,
            'fecha' => now()
        ]);

        // Guardar en la tabla movimientoremitorepuestos
        foreach ($request->movimientos as $movimiento) {
            DB::table('movimientoremitorepuestos')->insert([
                'remitorepuestos_id' => $remitoId,
                'repuestos_id' => $movimiento['id_repuesto'],
                'cantidad' => $movimiento['cantidad']
            ]);

            // Actualizar la cantidad en la tabla repuestos
            DB::table('repuestos')->where('id', $movimiento['id_repuesto'])->increment('cantidad', $movimiento['cantidad']);
        }

        DB::commit();

        return response()->json(['message' => 'Remito guardado correctamente.'], 200);
    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json(['error' => $e->getMessage()], 500);
    }
}

 public function buscar(Request $request)
    {

        $query = $request->input('query'); // Capturar la entrada
        $campo = $request->input('campo'); // Saber si busca por "codigo" o "nombre"

        // Buscar repuestos según el campo especificado
        if ($campo === 'codigo') {
            $repuestos = Repuesto::where('codigo', 'like', '%' . $query . '%')->get();
        } elseif ($campo === 'nombre') {
            $repuestos = Repuesto::where('nombre', 'like', '%' . $query . '%')->get();
        } else {
            return response()->json(['error' => 'Campo no válido'], 400);
        }

        // Verificar si se encontraron repuestos
        if ($repuestos->isNotEmpty()) {
            return response()->json($repuestos, 200);
        } else {
            return response()->json(['error' => 'No se encontraron repuestos'], 404);
        }
    }


public function generarinformerepuestos(Request $request)
{
    $filtro = $request->input('filtro', 'todos');
    $valor = $request->input('valor', '');

    // Consulta según el filtro
    if ($filtro === 'marca') {
        $repuestos = Repuesto::where('marca', 'LIKE', "%$valor%")->orderBy('nombre', 'asc')->get();
    } elseif ($filtro === 'nombre') {
        $repuestos = Repuesto::where('nombre', 'LIKE', "%$valor%")->orderBy('nombre', 'asc')->get();
    } else {
        $repuestos = Repuesto::orderBy('nombre', 'asc')->get();
    }

    // Genera la vista HTML para el PDF
    $html = view('panol.informe_pdf', compact('repuestos'))->render();

    // Configuración de Dompdf
    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isRemoteEnabled', true);

    $dompdf = new Dompdf($options);
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    // Retorna el PDF
    return $dompdf->stream('informe_repuestos.pdf', ['Attachment' => false]);
}


public function obtenerComprobantes()
{
    /*$comprobantes = ComprobanteRepuesto::where('estadocomprobante_id', 1)->get(['id', 'nrocomprobante']);
    return response()->json($comprobantes);*/

   /* $comprobantes = DB::table('comprobanterepuestos')
        ->join('movimientosrepuestos', 'comprobanterepuestos.id', '=', 'movimientosrepuestos.comprobanterepuesto_id')
        ->join('repuestos', 'movimientosrepuestos.repuesto_id', '=', 'repuestos.id')
        ->join('marcarepuestos', 'repuestos.marca_id', '=', 'marcarepuestos.id')
        ->select(
            'comprobanterepuestos.id',
            'comprobanterepuestos.nrocomprobante',
            'repuestos.nombre as nombre_repuesto',
            'marcarepuestos.nombre as marca',
            'movimientosrepuestos.cantidad'
        )
        ->distinct()
        ->get();

    return response()->json($comprobantes);*/

       $comprobantes = DB::table('comprobanterepuestos')
        ->join('estadocomprobantes', 'comprobanterepuestos.estadocomprobante_id', '=', 'estadocomprobantes.id')
        ->join('proveedores', 'comprobanterepuestos.proveedor_id', '=', 'proveedores.id')
        ->where('estadocomprobantes.nombre', '=', 'INGRESADO') // Filtro por estado "INGRESADO"
        ->select(
            'comprobanterepuestos.id',
            'comprobanterepuestos.nrocomprobante',
            'proveedores.nombre as proveedor_nombre' // Agregamos el nombre del proveedor
        )
        ->distinct() // Asegura que no se repitan los resultados
        ->limit(50)
        ->orderby('fechacomprobante','desc')
        ->get();

    return response()->json($comprobantes);
}


public function detalleComprobante($id)
{
    $detalles = DB::table('movimientosrepuestos')
        ->join('repuestos', 'movimientosrepuestos.repuesto_id', '=', 'repuestos.id')
        ->join('marcarepuestos', 'repuestos.marca_id', '=', 'marcarepuestos.id')
        ->where('movimientosrepuestos.comprobanterepuesto_id', $id)
        ->select(
            'repuestos.nombre as nombre_repuesto',
            'marcarepuestos.nombre as marca',
            'movimientosrepuestos.cantidad'
        )
        ->get();

    return response()->json(['detalles' => $detalles]);
}

public function anularComprobante(Request $request)
{
    $validatedData = $request->validate([
        'comprobanterepuesto_id' => 'required|exists:comprobanterepuestos,id',
        'motivo' => 'required|string|max:255',
    ]);

    $comprobanterepuestoId = $validatedData['comprobanterepuesto_id'];
    $motivo = $validatedData['motivo'];

    // Iniciar una transacción
    DB::beginTransaction();

    try {
        // Obtener el comprobante
        $comprobante = ComprobanteRepuesto::findOrFail($comprobanterepuestoId);

        // Guardar en la tabla de anulaciones
        $anulacion = new AnulacionComprobante();
        $anulacion->comprobanterepuesto_id = $comprobanterepuestoId;
        $anulacion->motivo = $motivo;
        $anulacion->fecha = now();
        $anulacion->save();

        // Obtener los movimientos asociados al comprobante
        $movimientos = MovimientoRepuesto::where('comprobanterepuesto_id', $comprobanterepuestoId)->get();

        // Restar las cantidades de los repuestos
        foreach ($movimientos as $movimiento) {
            $repuesto = Repuesto::findOrFail($movimiento->repuesto_id);
            $repuesto->cantidad_lnf -= $movimiento->cantidad;
            $repuesto->save();
        }

        // Cambiar estado del comprobante a "anulado"
        $comprobante->estadocomprobante_id = 2;
        $comprobante->save();

        // Confirmar la transacción
        DB::commit();

        return response()->json(['message' => 'Comprobante anulado correctamente.'], 200);
    } catch (\Exception $e) {
        // Revertir la transacción en caso de error
        DB::rollBack();
        return response()->json(['error' => 'Error al anular el comprobante: ' . $e->getMessage()], 500);
    }
}
}

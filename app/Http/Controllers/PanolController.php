<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Repuesto;

class PanolController extends Controller
{
     public function ingresarrepuestos()
    {


        return view('panol.ingresarrepuestos');
            
    }
        public function cargarrepuestos()
    {
        
    try {
        // Seleccionamos los campos necesarios
        $repuestos = Repuesto::all(['id', 'nombre', 'codigo', 'marca', 'cantidad']);
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
}

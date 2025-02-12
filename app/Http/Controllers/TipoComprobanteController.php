<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Models\TipoComprobante;
use App\TipoComprobante;

class TipoComprobanteController extends Controller
{

// Obtener todos los registros
    public function index()
    {
        return response()->json(TipoComprobante::all(), 200);
    }

    // Crear un nuevo registro
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:191',
        ]);

        $tipoComprobante = TipoComprobante::create([
            'nombre' => $validatedData['nombre'],
        ]);

        return response()->json($tipoComprobante, 201);
    }

    // Obtener un registro por ID
    public function show($id)
    {
        $tipoComprobante = TipoComprobante::find($id);

        if (!$tipoComprobante) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }

        return response()->json($tipoComprobante, 200);
    }

    // Actualizar un registro
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:191',
        ]);

        $tipoComprobante = TipoComprobante::find($id);

        if (!$tipoComprobante) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }

        $tipoComprobante->update([
            'nombre' => $validatedData['nombre'],
        ]);

        return response()->json($tipoComprobante, 200);
    }

    // Eliminar un registro
    public function destroy($id)
    {
        $tipoComprobante = TipoComprobante::find($id);

        if (!$tipoComprobante) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }

        $tipoComprobante->delete();

        return response()->json(['message' => 'Registro eliminado correctamente'], 200);
    }
}

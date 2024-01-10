<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repuesto;

class PrestamoController extends Controller
{
    public function buscarPorCodigoBarras($codigo_barras)
    {
        $producto = Repuesto::where('codigo', $codigo_barras)->first();
        return response()->json($producto);
    }
    public function mostrarVista()
    {
        return view('buscar_producto');
    }
}

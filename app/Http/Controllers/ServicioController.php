<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Servicio;

class ServicioController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $datos=Servicio::search($request->name)->orderBy('numero','ASC')->paginate(40);

        return view('abms.servicios.index')
            ->with('datos',$datos);
    }
     public function create()
    {
        return view('abms.servicios.create');
               
    }
}

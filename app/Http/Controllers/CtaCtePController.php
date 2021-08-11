<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proveedor;
use App\CtaCteP;
use App\CtaCtePLeagas;
use App\Empresa;

use Laracasts\Flash\Flash;

class CtaCtePController extends Controller
{
        public function __construct()
    {
        $this->middleware('auth');
    }
	public function index(Request $request)
    {
        
        $proveedores=Proveedor::search($request->name)->orderBy('nombre','ASC')->paginate(10);
        
        return view('cuentascorrientes.proveedores.index')

            ->with('proveedores',$proveedores);

    }


    public function nuevocomprobante($id){
		$proveedores=Proveedor::where('id',$id)->get();
        $empresas=Empresa::orderBy('denominacion','ASC')->pluck('denominacion','id');
		// $vales=Vale::where('flete_id',$id)->get();
		$cuentacorrienteproveedor=CtaCteP::where('proveedor_id',$id)->where('tipocomprobante','FACTURA')->pluck('nrocomprobante','id');
		return view('cuentascorrientes.proveedores.nuevocomprobante')
		 	->with('cuentacorrienteproveedor',$cuentacorrienteproveedor)
		 	->with('proveedores',$proveedores)
            ->with('empresas',$empresas)
  			->with('id',$id);
    }

 public function guardarcomprobantep(Request $request,$id)
    {


          /*VALIDACION -----------------------------------------*/
        $campos=[
            'empresa_id'=>'required',
            'tipocomprobante'=>'required',
            'nrocomprobante'=>'required',
            'fechaemision'=>'required',
            'fechavencimiento'=>'required',
            'importe'=>'required|numeric',
            'importesubtotal'=>'required|numeric'
           
        ];
        $Mensaje=["required"=>'El :attribute es requerido'];
        $this->validate($request,$campos,$Mensaje);

       	$acumulado=Proveedor::where('id',$id)->orderBy('id','DESC')->limit(1)->get();

        // $datosComprobante=new CtaCteP(request()->except('_token'));
        // $datosComprobante->proveedor_id=$id;

        switch ($request->tipocomprobante){
        	case 'FACTURA':
                if($request->empresa_id==1)
                {
                $datosComprobante=new CtaCteP(request()->except('_token'));
                $datosComprobante->proveedor_id=$id;
        		$datosComprobante->debe=$request->importe;
        		$datosComprobante->haber=0;
                $datosComprobante->acumulado=$acumulado[0]->saldolnf + $request->importe;
               
        		$datosComprobante->importesubtotal=$request->importesubtotal;
                $datosComprobante->iva=$request->iva;
                $datosComprobante->percepcioniva=$request->percepcioniva;
                $datosComprobante->ingresobruto=$request->ingresobruto;
                $datosComprobante->tem=$request->tem;
                $datosComprobante->ganancia=$request->ganancia;
                //$datosComprobante->importefinal=$request->importefinal;
                 $editarcliente=Proveedor::where('id',$id)
                              ->update([
                            'saldolnf'=>$datosComprobante->acumulado
                              ]);
               
                }
                else
                {
                $datosComprobante=new CtaCtePLeagas(request()->except('_token'));
                $datosComprobante->proveedor_id=$id;
                $datosComprobante->debe=$request->importe;
                $datosComprobante->haber=0;
                $datosComprobante->acumulado=$acumulado[0]->saldol + $request->importe;
                $datosComprobante->importesubtotal=$request->importesubtotal;
                $datosComprobante->iva=$request->iva;
                $datosComprobante->percepcioniva=$request->percepcioniva;
                $datosComprobante->ingresobruto=$request->ingresobruto;
                $datosComprobante->tem=$request->tem;
                $datosComprobante->ganancia=$request->ganancia;
                $editarcliente=Proveedor::where('id',$id)
                                 ->update([
                            'saldol'=>$datosComprobante->acumulado
                              ]);
                }
        		$datosComprobante->factura_id=null;
        		$datosComprobante->save();
        		
        	break;

        	
        	case 'NOTA DE DEBITO':
                if($request->empresa_id==1)
                {
                    $datosComprobante=new CtaCteP(request()->except('_token'));
                    $datosComprobante->proveedor_id=$id;
            		$datosComprobante->debe=$request->importe;
            		$datosComprobante->haber=0;
            		$datosComprobante->acumulado=$acumulado[0]->saldolnf + $request->importe;
            		$datosComprobante->save();
            		$editarcliente=Proveedor::where('id',$id)
                    ->update([
                    		'saldolnf'=>$datosComprobante->acumulado
                              ]);
                }
                else{
                    $datosComprobante=new CtaCtePLeagas(request()->except('_token'));
                    $datosComprobante->proveedor_id=$id;
                    $datosComprobante->debe=$request->importe;
                    $datosComprobante->haber=0;
                    $datosComprobante->acumulado=$acumulado[0]->saldol + $request->importe;
                    $datosComprobante->save();
                    $editarcliente=Proveedor::where('id',$id)
                    ->update([
                            'saldol'=>$datosComprobante->acumulado
                              ]);
                }
        	break;
        	case 'NOTA DE CREDITO':
                if($request->empresa_id==1)
                {
                    $datosComprobante=new CtaCteP(request()->except('_token'));
                    $datosComprobante->proveedor_id=$id;
            		$datosComprobante->debe=0;
            		$datosComprobante->haber=$request->importe;
            		$datosComprobante->acumulado=$acumulado[0]->saldolnf - $request->importe;
            		$datosComprobante->save();
    				$editarcliente=Proveedor::where('id',$id)
                    ->update([
                              'saldolnf'=>$datosComprobante->acumulado
                              ]);
                }
                else
                {
                    $datosComprobante=new CtaCtePLeagas(request()->except('_token'));
                    $datosComprobante->proveedor_id=$id;
                    $datosComprobante->debe=0;
                    $datosComprobante->haber=$request->importe;
                    $datosComprobante->acumulado=$acumulado[0]->saldol - $request->importe;
                    $datosComprobante->save();
                    $editarcliente=Proveedor::where('id',$id)
                    ->update([
                              'saldol'=>$datosComprobante->acumulado
                              ]);
                }
        	break;
        	case 'REMITO':
                if($request->empresa_id==1)
                {
                    $datosComprobante=new CtaCteP(request()->except('_token'));
                    $datosComprobante->proveedor_id=$id;
            		$datosComprobante->debe=$request->importe;
            		$datosComprobante->haber=0;
            		$datosComprobante->acumulado=$acumulado[0]->saldolnf + $request->importe;
            		$datosComprobante->save();
            		$editarcliente=Proveedor::where('id',$id)
                    ->update([
                    		'saldolnf'=>$datosComprobante->acumulado
                              ]);
                }
            else{
                    $datosComprobante=new CtaCtePLeagas(request()->except('_token'));
                    $datosComprobante->proveedor_id=$id;
                    $datosComprobante->debe=$request->importe;
                    $datosComprobante->haber=0;
                    $datosComprobante->acumulado=$acumulado[0]->saldol + $request->importe;
                    $datosComprobante->save();
                    $editarcliente=Proveedor::where('id',$id)
                    ->update([
                            'saldol'=>$datosComprobante->acumulado
                              ]);
            }


        	break;
        	case 'RECIBO':
             if($request->empresa_id==1)
                {
                $datosComprobante=new CtaCteP(request()->except('_token'));
                $datosComprobante->proveedor_id=$id;
        		$datosComprobante->debe=0;
        		$datosComprobante->haber=$request->importe;
        		$datosComprobante->acumulado=$acumulado[0]->saldolnf - $request->importe;
        		$datosComprobante->save();
				$editarcliente=Proveedor::where('id',$id)
                ->update([
                          'saldolnf'=>$datosComprobante->acumulado
                          ]);
            }
            else
            {
                $datosComprobante=new CtaCtePLeagas(request()->except('_token'));
                $datosComprobante->proveedor_id=$id;
                $datosComprobante->debe=0;
                $datosComprobante->haber=$request->importe;
                $datosComprobante->acumulado=$acumulado[0]->saldol - $request->importe;
                $datosComprobante->save();
                $editarcliente=Proveedor::where('id',$id)
                ->update([
                          'saldol'=>$datosComprobante->acumulado
                          ]);
            
            }
        	break;
        }
   		flash::success('Comprobante ingresado!!! - Tipo '.$request->tipocomprobante. '-' .$request->nrocomprobante);
       return Redirect('cuentascorrientes/proveedores/')->with('Mensaje','Comprobante ingresado!!!');

    }

    public function listarcomprobantes($id)
    {
    	$cuentacorrienteproveedor=CtaCteP::where('proveedor_id',$id)->orderBy('id','DESC')->paginate(10);
    	$proveedor=Proveedor::where('id',$id)->get();


    	$cuentacorrienteproveedor->each(function($cuentacorrienteproveedor){
            $cuentacorrienteproveedor->ctactep;

        });


    	return view('cuentascorrientes.proveedores.listarcomprobantes')
		 	->with('cuentacorrienteproveedor',$cuentacorrienteproveedor)
		 	->with('proveedor',$proveedor);
   }

    public function listarcomprobantesleagas($id)
    {
        $cuentacorrienteproveedor=CtaCtePLeagas::where('proveedor_id',$id)->orderBy('id','DESC')->paginate(10);
        $proveedor=Proveedor::where('id',$id)->get();


        $cuentacorrienteproveedor->each(function($cuentacorrienteproveedor){
            $cuentacorrienteproveedor->ctactepleagas;

        });


        return view('cuentascorrientes.proveedores.listarcomprobantesleagas')
            ->with('cuentacorrienteproveedor',$cuentacorrienteproveedor)
            ->with('proveedor',$proveedor);
   }
}

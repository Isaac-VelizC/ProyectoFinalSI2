<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Compra;
use App\Models\CompraDetalle;
use App\Models\Prenda;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CompraController extends Controller
{
    public function index(Request $request) {
		$sql = trim($request->get('buscarTexto'));
		$compras = Compra::where('fecha_compra', 'like', "%$sql%")->paginate(5);
        return view('admin.compras.index', ['compras' => $compras, 'buscarTexto' => $sql]);
	}

	public function create(Request $request)
	{
		$prendas = Prenda::orderBy('nombre')->get();
		return view('admin.compras.create', ['productos' => $prendas]);
	}

	
	public function store(Request $request)
	{
		//try{
			//DB::beginTransaction();

			$mytime = Carbon::now('America/Mexico_City');
			$compra = new Compra();

			$compra->user_id = Auth::user()->id;
			$compra->num_compra = $request->num_compra;
			$compra->fecha_compra = $mytime->toDateString();
			$compra->total = $request->total_pagar;
			$compra->estado = 'Registrado';

			$compra->save();
			$id_prenda = $request->id_producto;
			$cantidad = $request->cantidad;
			$precio = $request->precio_compra;

			$cont = 0;

			while($cont < count($id_prenda))
			{
				$detalle = new CompraDetalle();
				$productoActualizado = Prenda::find($id_prenda[$cont]);
				
				$detalle->compra_id = $compra->id;
				$detalle->prenda_id = $id_prenda[$cont];
				$detalle->cantidad = $cantidad[$cont];
				$detalle->precio = $precio[$cont];
				$detalle->save();
				$cont = $cont + 1;
				
				$productoActualizado->stock += $detalle->cantidad;
				$productoActualizado->saveOrFail();
			}
			//DB::commit();
		/*}catch(Exception $e){
			DB::rollBack();
		}*/
		
		return redirect('admin/compra');
		//return Redirect::to('admin.compra');
	}

	public function show($id) {
		$compra = Compra::find($id);
		$detalles = CompraDetalle::where('compra_id', $id)->get();
		return view('admin.compras.show', ['compra' => $compra, 'detalles' => $detalles]);
	}

	public function destroy($id) {
		$compra = Compra::findOrFail($id);
		$compra->estado = 'Anulado';
		$compra->save();
		return redirect('admin/compra');
	}
}

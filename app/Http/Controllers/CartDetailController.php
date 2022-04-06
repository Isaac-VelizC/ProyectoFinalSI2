<?php

namespace App\Http\Controllers;

use App\Models\PedidoDetalle;
use App\Models\Prenda;
use Illuminate\Http\Request;

class CartDetailController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function store(Request $request) {
    	$cartDetail = new PedidoDetalle();
		$productoActualizado = Prenda::find($request->prenda_id);

		if ($request->cantidad > $productoActualizado->stock) {
			$msgError = "Prenda agotada";
			return back()->with(compact('msgError'));
		}
		else {
			$cartDetail->pedido_id = auth()->user()->cart->id;
			$cartDetail->prenda_id= $request->prenda_id;
			$cartDetail->cantidad = $request->cantidad;

			if ($productoActualizado->descuento != 0){
				$cartDetail->conDescuento = $request->cantidad * ($productoActualizado->precioUnit - $productoActualizado->precioUnit * $productoActualizado->descuento /100);
			} else {
                $cartDetail->subTotal = $request->cantidad * $productoActualizado->precioUnit;
            }

			$cartDetail->save();
			
			$productoActualizado->stock -= $cartDetail->cantidad;
			$productoActualizado->saveOrFail();

			$msg ="Producto agregado al carrito";
			return back()->with(compact('msg'));
		}
    }

    public function destroy(Request $request) {
    	$cartDetail =  PedidoDetalle::find($request->cart_detail_id);  
		
        $productoActualizado = Prenda::find($cartDetail->prenda_id);
        $productoActualizado->stock += $cartDetail->cantidad;
        $productoActualizado->saveOrFail();

    	if($cartDetail->pedido_id == auth()->user()->cart->id) 	
    		$cartDetail->delete();

    	$msg ="Producto eliminado del carrito";
    	return back()->with(compact('msg'));

    }
}

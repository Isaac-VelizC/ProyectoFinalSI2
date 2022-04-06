<?php

namespace App\Http\Controllers;

use App\Models\PedidoDetalle;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function update(Request $request)
 	{
		 
		$mytime = Carbon::now('America/Mexico_City');
 		$client = auth()->user(); 
    	$cart = $client->cart;
    	$cart->estado = 'Pending';
    	$cart->fecha_pedido = $mytime->toDateString();
		$cart->total = $request->total;
    	$cart->save();

		/*
			$actualizar = PedidoDetalle::find($id);

			$actualizar->subTotal = $request->subTotal;
			$actualizar->conDescuento = $request->conDescuento;
			$actualizar->save();*/


    	$admins = User::where('admin', true)->get();
        //Aqui podemos agregar copia del correo para el cliente,
        //para pruebas solo envía al correo del admin
    	
        //Mail::to($admins)->send(new NewOrder($client, $cart));

    	$msg = 'Tu pedido se ha registrado correctamente. Te contactaremos pronto vía mail!';
    	return back()->with(compact('msg'));
		
 	}
}

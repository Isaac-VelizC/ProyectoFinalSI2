<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Pedido;
use App\Models\PedidoDetalle;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ClienteController extends Controller
{
    public function index(Request $res) {
        
    	$query = $res->input('query');
   	    $clientes = User::where('admin', '0')->where('name', 'like', "%$query%")->orderBy('name')->paginate(10);
   		return view('clientes.index', compact('clientes'));
   }

   public function update(Request $request, $id) {
        //$request->validate($this->validarEdit);
        $cliente = User::find($id);
        $cliente->name = $request->name;
        $cliente->telefono = $request->telefono;
        $cliente->direccion = $request->direccion;
        $cliente->save();
        Session::flash('msg', 'Se actualizo tus datos');
        return back();
    }

   public function show($id)
    {
        $cliente = User::find($id);
        return view('clientes.show')->with(compact('cliente'));
    }
   
   public function destroy($id)
   {
        Pedido::where('user_id', $id)->delete();
        PedidoDetalle::where('pedido_id', $id)->delete();
   		$client = User::find($id);
   		$client->delete();
   		
        Session::flash('msg', 'Se eliminó al Cliente');
   		return back();
   }
}

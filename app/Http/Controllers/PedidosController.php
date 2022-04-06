<?php

namespace App\Http\Controllers;

use App\Models\Opinion;
use App\Models\Pedido;
use App\Models\PedidoDetalle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PedidosController extends Controller
{
    public function ListPedidos() {
        $todosPedidos = Pedido::where("estado", "!=", "Active")->orderBy('fecha_pedido', 'DESC')->paginate(10);
        $PedidosPendientes = Pedido::where('estado', 'Pending')->orderBy('fecha_pedido', 'DESC')->paginate(10);
        $PedidosEnvio = Pedido::where('estado', 'Enviandose')->orderBy('fecha_pedido', 'DESC')->paginate(10);
        $PedidosEntregado = Pedido::where('estado', 'Entregado')->orderBy('fecha_pedido', 'DESC')->paginate(10);
        return view("pedidos.tab", ["ventas" => $todosPedidos, "pendientes" => $PedidosPendientes, "enEnvio" => $PedidosEnvio, "entregados" => $PedidosEntregado]);
    }

    public function index() {
        $pedidosDelCliente = Pedido::where("estado", "!=", "Active")->where("user_id", auth()->user()->id)->get();
        return view("pedidos.index", ["ventas" => $pedidosDelCliente]);
    }

    public function show($id) {
        $venta = Pedido::find($id);
        $detailPedido = PedidoDetalle::where("pedido_id", $id)->get();

        $ConDes = 0;
        $SinDes = 0;
    	$total =0;
    	foreach ($detailPedido as $detail) {
    		    $ConDes += $detail->subTotal;
    		    $SinDes += $detail->conDescuento;
    	}
        
        $total = $SinDes + $ConDes;

        //$comentario = Opinion::find($venta->id);

        //dd($comentario);

        $opinion = "";
        $comentario = Opinion::where("pedido_id", $id)->get();

        foreach ($comentario as $opin){
            if($opin->pedido_id == $id){
                $opinion = $opin->opinion;
            }
        }
        
            return view('pedidos.show',["total" => $total, "opinion" => $opinion])->with(compact('detailPedido', 'comentario', 'venta'));
    }

    public function destroy($id) {
        PedidoDetalle::where('pedido_id', $id)->delete();
        $pedidoDel = Pedido::find($id);
        $pedidoDel->delete();

        Session::flash('msg', 'Se elimino el Pedido y los detalles asociados');
        return back();
    }
}

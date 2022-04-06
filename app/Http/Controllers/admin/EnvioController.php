<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Envio;
use App\Models\Pedido;
use App\Models\PedidoDetalle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class EnvioController extends Controller
{
    
    private $validar = [
        'metodo' => 'required|min:10|max:200',
        'pedido_id' => 'required',
        'costo_envio' => 'nullable| numeric',
    ];

    public function index() 
   {
   	    $envios = Envio::orderBy('id')->paginate(10);
   		return view('admin.envios.index', compact('envios'));
   }

   public function create(){
        $pedidosPendientes = Pedido::where('estado', 'Pending')->orderBy('fecha_pedido')->get();
        return view('admin.envios.create')->with(compact('pedidosPendientes'));
    }

    public function store(Request $request){

        $request->validate($this->validar);
        $envio = new Envio();
        $envio->user_id =  auth()->user()->id;
        $envio->pedido_id = $request->pedido_id;
        $estadoPedido = Pedido::find($request->pedido_id);
        $estadoPedido->estado = 'Enviandose';
        $estadoPedido->update();

        $envio->metodo = $request->metodo;
        $envio->costo_envio = $request->costo_envio;
        $envio->fecha_envio = Carbon::now();
        $envio->save();
        return redirect('admin/envios');
    }

    public function edit($id){
        $pedidosPendientes = Pedido::orderBy('id')->get();
        $enviarEdit = Envio::find($id);
        return view('admin.envios.edit')->with(compact('enviarEdit', 'pedidosPendientes'));
    }

    public function update(Request $request, $id)
    {
        $envio = Envio::find($id);
        $envio->pedido_id = $request->pedido_id;
        $envio->metodo = $request->metodo;
        $envio->costo_envio = $request->costo_envio;
        $envio->fecha_envio = Carbon::now();
        $envio->save();
        return redirect('admin/envios');
    }

    public function show($id)
    {
        $pedido = Pedido::find($id);
        $detailPedido = PedidoDetalle::where("pedido_id", $id)->get();
        
        $ConDes = 0;
        $SinDes = 0;
    	$total =0;
    	foreach ($detailPedido as $detail) {
    		    $ConDes += $detail->subTotal;
    		    $SinDes += $detail->conDescuento;
    	}
        
        $total = $SinDes + $ConDes;
        return view('admin.envios.show',["total" => $total])->with(compact('detailPedido', 'pedido'));
    }

    public function destroy($id)  
    {   
        $envioBorrar = Envio::find($id);
        $envioBorrar->delete();
        
        Session::flash('msg', 'Se eliminó el envio');
        return back();
    }

    public function ActualizarEstadoPedido($id)  
    {   
        $actEstado = Pedido::find($id);
        $actEstado->estado = 'Entregado';
        $actEstado->fecha_entrega = Carbon::now();
        $actEstado->update();
        
        Session::flash('msg', 'Se entrego el Pedido');
        return back();
    }

}

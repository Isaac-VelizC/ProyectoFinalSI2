<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Prenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DescuentoController extends Controller
{
    
    public function index(Request $res) {
    	$query = $res->input('query');

   	    $descu = Prenda::where("descuento", "!=", "0")->orderBy('nombre')->where('nombre', 'like', "%$query%")->paginate(10);
        $total = 0;
        foreach ($descu as $descuento) {
            $div = $descuento->descuento / 100;
            $total = $div * $descuento->precioUnit;
        }
   		return view('admin.products.descuentos.index', ["total" => $total], compact('descu'));
   }

   public function addDescuento($id){
        $descuento = prenda::find($id);
        return view('admin.products.descuentos.descuento')->with(compact('descuento'));
    }

    public function updateDescuento(Request $request, $id)
    {
        $prenda = prenda::find($id);
        $prenda->descuento = $request->descuento;
        $prenda->save();
        return redirect('admin/products');
    }
   
   public function destroy($id)  
   {
   		$product = Prenda::find($id);
        $product->descuento = 0; 
   		$product->update();
   		
        Session::flash('msg', 'Se quito el descuento');
   		return back();
   }
}

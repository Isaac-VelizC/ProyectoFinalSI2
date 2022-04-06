<?php

namespace App\Http\Controllers;

use App\Models\Opinion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class OpinionController extends Controller
{
    public function index(Request $res) {
        $result = DB::select(DB::raw("select count(*) as total_opinion, opinion from opinions group by opinion"));
        $chartData = "";
        foreach($result as $list) {
            $chartData.="['".$list->opinion."', ".$list->total_opinion."],";
        }
        $arr['chartData'] = rtrim($chartData,",");


        
    	$query = $res->input('query');
        $coment = Opinion::where('opinion', 'like', "%$query%")->paginate(10);
        //$coment = Opinion::all();
        return view('admin.opinion.index', $arr)->with(compact('coment'));
    }

    public function store(Request $request) {
        $opinion = new Opinion();
        $opinion->user_id = auth()->user()->id;
        $opinion->pedido_id = $request->pedido_id;
        $opinion->opinion = "ninguno";
        $opinion->comentario = $request->comentario;
        $opinion->save();
        
    	$msg = 'Se realizo exitosamente!';
        return back();
    }

    public function update(Request $request, $id) {
        $opinion = Opinion::find($id);
        $opinion->opinion = $request->opinion;
        $opinion->save();
        return back();
    }

    public function destroy($id)
   {
   		$client = Opinion::find($id);
   		$client->delete();
   		
        Session::flash('msg', 'Se eliminó el comentario');
   		return back();
   }
}

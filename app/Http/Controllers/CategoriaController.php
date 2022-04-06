<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function show(Categoria $category){
  		$products = $category->prendas()->paginate(10);
        $total = 0;
        foreach ($products as $descuento) {
            $div = $descuento->descuento / 100;
            //dd($descuento->precioUnit);
            $total = $descuento->precioUnit * $div;
        }
  		return view('categories.show', ["total" => $total])->with(compact('category','products'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function welcome()
    {
    	$categories = Categoria::has('prendas')->get(); //has - devuelve solo las categorias que tienen productos
    	return view('welcome')->with(compact('categories')); //compact crea un array asociativo de los arametros que le pasamos
    }
}

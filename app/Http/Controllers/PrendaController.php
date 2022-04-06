<?php

namespace App\Http\Controllers;

use App\Models\Prenda;
use Illuminate\Http\Request;

class PrendaController extends Controller
{
    public function show($id) {
   	  $product = Prenda::find($id);
      $images = $product->images;

      $imagesLeft = collect();
      $imagesRight = collect();
      foreach ($images as $key => $image) {
        if($key%2 == 0)
              $imagesLeft->push($image);
        else
              $imagesRight->push($image);
      }
   		return view('prendas.show')->with(compact('product', 'imagesLeft', 'imagesRight'));
   }
}

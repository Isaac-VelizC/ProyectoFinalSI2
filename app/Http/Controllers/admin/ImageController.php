<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Prenda;
use App\Models\PrendaImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ImageController extends Controller
{
    public function index($id) {
    	$product = Prenda::find($id);
    	$images = $product->images()->orderBy('destacada', 'desc')->get();
    	return view('admin.products.images.index')->with(compact('product', 'images'));
    }

    public function store(Request $request, $id) {
    	//guardar imagen
    	$file = $request->file('photo');
    	$path = public_path() . '/clients/images/products';
    	$fileName = uniqid() . $file->getClientOriginalName();
    	$moved = $file->move($path, $fileName);
    	//crear registro
        if($moved)
        {
        	$productImage = new PrendaImage();
        	$productImage->image = $fileName;
        	$productImage->prenda_id = $id;
        	$productImage->save();  
         }
    	return back();		
    }

    public function destroy(Request $request, $id) {
        $productImage = PrendaImage::find($request->image_id);
        if(substr($productImage->image, 0, 4) === "http")
            {
                $deleted = true;
            }else{
                $fullPath = public_path() . '/clients/images/products' . $productImage->image;
                $deleted = File::delete($fullPath);
            }

            if($deleted) 
            {
                $productImage->delete();
            }
        return back();
    }

    public function select($id, $image) {
        PrendaImage::where('prenda_id', $id)->update(['destacada' => false]);
        $productImage = PrendaImage::find($image);
        $productImage->destacada = true;
        $productImage->save();

        return back();
    }
}

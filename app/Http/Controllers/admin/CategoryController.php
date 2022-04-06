<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Prenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    public function index() {
   	    $categories = Categoria::orderBy('id')->paginate(10);
   		return view('admin.categories.index')->with(compact('categories'));
   }

   public function create(){
   		return view('admin.categories.create');
   }

   public function store(Request $request) {
        $this->validate($request, Categoria::$rules);

        $category =	Categoria::create($request->only('nombre','description'));
        //save image file
            if($request->hasFile('image')) {    
                $file = $request->file('image');
                $path = public_path() . '/clients/images/categories';
                $fileName = uniqid() . '-' .$file->getClientOriginalName();
                $moved = $file->move($path, $fileName);
                if ($moved) 
                {
                    $category->image = $fileName;
                    $category->save();
                }
            }
        return redirect('admin/categories');
    }

    public function edit(Categoria $category) {	
   		return view('admin.categories.edit')->with(compact('category'));
    }

    public function update(Request $request, Categoria $category) {
	
        $this->validate($request, Categoria::$rules);

        $category->update($request->only('nombre','description'));
        
            if($request->hasFile('image')) {    
                $file = $request->file('image');
                $path = public_path() . '/clients/images/categories';
                $fileName = uniqid() . '-' . $file->getClientOriginalName();
                $moved = $file->move($path, $fileName);
            
                if ($moved) 
                {
                $previousPath = $path . '/' . $category->image;
                    $category->image = $fileName;
                    $saved = $category->save();

                    if($saved)
                    File::delete($previousPath);
                }
            }
		return redirect('admin/categories');
    }

    public function destroy($id) {
   		$msg='';
        $category = Categoria::find($id);
        $cont = Prenda::where('categoria_id', $id)->count();
        if ($cont <= 0){
            $category->delete();
            $msg ="Categoria eliminada";
        }else{
            $msg ="No es posible eliminar la categoria porque tiene productos relacionados";
        }

   		Session::flash('msg', $msg);
   		return back();
    }
}

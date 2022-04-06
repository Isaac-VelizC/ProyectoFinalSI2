<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prenda extends Model
{
    use HasFactory;

    public function category()
    {
    	return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    public function images()
    {
    	return $this->hasMany(PrendaImage::class);
    }

    public function getFeaturedImageUrlAttribute()
    {
        //imagen destacada
        $featuredImage = $this->images()->where('destacada', true)->first();
        if(!$featuredImage)
            $featuredImage = $this->images()->first(); //primera imagen

        if($featuredImage)
        {            
            return $featuredImage->url;
        }
        return '/clients/images/default.png';
    }

    public function getCategoryNameAttribute()
    {
        if ($this->category)
            return $this->category->nombre();
        else
            return 'General';
    }

    public function marcas(){
        return $this->belongsTo(Marca::class, 'marca_id');
    }
    public function tallas(){
        return $this->belongsTo(Talla::class, 'talla_id');
    }
    public function colors(){
        return $this->belongsTo(Color::class, 'color_id');
    }
}

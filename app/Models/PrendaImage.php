<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrendaImage extends Model
{
    use HasFactory;
    public function product()
    {
    	return $this->belongsTo(Prenda::class);
    }

    public function getUrlAttribute()
    {
    	if(substr($this->image, 0, 4) === "http")
    	{
    		return $this->image;
    	}

    	return '/clients/images/products/' . $this->image;
    }
}

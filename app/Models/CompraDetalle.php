<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompraDetalle extends Model
{
    use HasFactory;
    protected $table = 'compra_detalles';
    public function prenda()
    {
    	return $this->belongsTo(Prenda::class);
    }
    
    public $timestamps = false;
}

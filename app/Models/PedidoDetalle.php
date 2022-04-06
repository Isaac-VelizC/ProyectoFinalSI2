<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoDetalle extends Model
{
    use HasFactory;
    public function prenda()
    {
    	// CartDetail N --------- 1 Product
    	return $this->belongsTo(Prenda::class);
    }
}

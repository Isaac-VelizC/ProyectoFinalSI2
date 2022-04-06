<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opinion extends Model
{
    use HasFactory;
    public function Pedido(){
        return $this->belongsTo(Pedido::class, 'pedido_id');
    }
    
    public function cliente(){
        return $this->belongsTo(User::class, 'user_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    
    protected $table='cart';

    public function products()
    {
        return $this->belongsTo('App\Models\Products','product_id');
    }
}

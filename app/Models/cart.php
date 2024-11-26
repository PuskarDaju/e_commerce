<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    public $table='carts';
    public $timestamps=false;

    protected $guarded=[];
    protected $primaryKey="cart_id";
    public function product(){
        return $this->belongsTo(Product::class,'product_id','id');
    }
    
}

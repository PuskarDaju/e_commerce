<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
  
    public $table='products';
   
    protected $guarded=[];
    public function category(){
        return $this->belongsTo(category::class,'category_id','cid');
    }
   

}


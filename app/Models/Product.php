<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Product extends Model
{
   use Searchable;
    public $table='products';
   
    protected $guarded=[];
    public function category(){
        return $this->belongsTo(category::class,'category_id','cid');
    }
   
    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
           
        ];
    }

}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    public $table='carts';
    public $timestamps=false;

    protected $fillable=[
        'id',
        'userId',
        "ProductId",
        "quantity"
    ];
}

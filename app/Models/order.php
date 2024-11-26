<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\payment;

class order extends Model
{
    const STATUS_PENDING = 'pending';
    const PAYMENT_PENDING = 'pending';
    public $table='orders';
    protected $primaryKey="oid";

    protected $guarded=[];
    public function payment(){
        return $this->hasOne(payment::class,"order_id");
    }


}

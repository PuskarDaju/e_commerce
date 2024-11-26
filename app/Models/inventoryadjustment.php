<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class inventoryadjustment extends Model
{
    const TYPE_SALES = 'sales';
    public $tablename="inventoryadjustments";
    protected $guarded=[];
    public $timestamps=false;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class payment extends Model
{
    const STATUS_PENDING = 'pending';
    public $table='payments';
    protected $guarded=[];
    
}

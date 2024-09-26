<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class UserButtonController extends Controller
{
    public function displayProducts(){
        $products = Product::all();
        return view('user.viewProducts', compact('products'));
    }
}

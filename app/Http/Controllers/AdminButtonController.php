<?php

namespace App\Http\Controllers;

use App\Models\cart;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminButtonController extends Controller
{
    public function gotoProductTable(){
        $stocks=Product::all();
        if($stocks==null || empty($stocks)){
            return view('admin.productTable');
        }
        return view('admin.productTable')->with('stocks',$stocks);
    }
    public function gotoAllOrder(){
        $orders=cart::where('status','in process')->get();
        return view('admin.allOrder',compact('orders'));
    }
   
}

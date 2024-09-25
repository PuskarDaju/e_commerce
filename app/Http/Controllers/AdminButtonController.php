<?php

namespace App\Http\Controllers;

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
    public function gotoAddNew(){
        return view('admin.addNewProduct');
    }
}

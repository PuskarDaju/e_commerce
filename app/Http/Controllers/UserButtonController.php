<?php

namespace App\Http\Controllers;

use App\Models\cart;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserButtonController extends Controller
{
   
    public function displayProducts(){
        $products = Product::all();
        return view('user.viewProducts', compact('products'));
    }
    public function gotoCart(){
        $myProducts=cart::with('product')->where('userId',Auth::id())->get();
        return view('user.myCart')->with('stocks',$myProducts);
    }
    public function searchMyProduct(Request $req){
        $myProducts=Product::search($req->keywords)->get();
        return  view('user.viewProducts')->with('products',$myProducts);

    }
    public function gotoAccount(){
        $user=User::find(Auth::id());
        return view('user.profile',compact('user'));
    }
}

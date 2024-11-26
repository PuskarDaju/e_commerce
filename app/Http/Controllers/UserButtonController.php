<?php

namespace App\Http\Controllers;

use App\Models\cart;
use App\Models\maincart;
use App\Models\notification;
use App\Models\order;
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
      

        $myProducts=cart::with('product.category')->where('user_id',Auth::id())->get();
        
        
        return view('user.myCart')->with('stocks',$myProducts);
    }
    public function gotoOrder(){
        $active=order::where("user_id",Auth::id())->where('order_status','shipped')->get();
        $previous=order::where("user_id",Auth::id())->where('order_status','delivered')->get();
        $pending=order::where("user_id",Auth::id())->where('order_status','pending')->get();
        
        return view('user.myOrder',[
            'active'=>$active,
            "previous"=>$previous,
            "pending"=>$pending,
        ]);
    }
    public function searchMyProduct(Request $req){
        $myProducts=Product::search($req->keywords)->get();
        return  view('user.viewProducts')->with('products',$myProducts);

    }
    public function gotoAccount(){
        $user=User::find(Auth::id());
        return view('user.profile',compact('user'));
    }
    public function gotoNotification(){
        $msg=notification::where('user_id',Auth::id())->get();
       
        return view('user.notification')->with('msges',$msg);
    }
    
}

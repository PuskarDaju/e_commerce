<?php

namespace App\Http\Controllers;

use App\Models\cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserOrderController extends Controller
{
   
    public function AddToCart(Request $request){
        $myCart=new cart();
        $myCart->userId=Auth::id();
        $myCart->productId=$request->id;
        $myCart->quantity= 1;
        $myCart->save();


        $item=Product::find($request->id);
        return view('user.cart')->with("items",$item);

    }
    public function deleteMyItem(Request $req){
        $myItem=cart::where('productId',$req->id)->where('userId',Auth::id())->first();
        $myItem->delete();
        return redirect()->back();
    }
    
}

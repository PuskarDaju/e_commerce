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
    public function addOrder(Request $req) {
        // Check if 'ids' array exists in the request
        if($req->has('ids') && !empty($req->ids)) {
            // Loop through each id in the array
            foreach($req->ids as $id) {
                // Fetch cart data for the given product ID and authenticated user
                $datas = cart::where('productId', $id)->where('userId', Auth::id())->get();
                
                foreach($datas as $data) {
                    // Update the status to 'in process'
                    $data->status = "in process";
                    $data->save();
                }
            }
            
            // Return success response
            return response()->json(['msg' => 'Order successfully processed']);
        }
    
        // Return an error if 'ids' is not found or empty
        return response()->json(['msg' => 'No valid product IDs provided'], 400);
    }
    
    
}

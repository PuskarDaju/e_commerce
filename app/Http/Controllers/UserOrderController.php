<?php

namespace App\Http\Controllers;

use App\Models\cart;
use App\Models\order;
use App\Models\payment;
use App\Models\inventoryadjustment;
use App\Models\maincart;
use App\Models\orderitems;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;




class UserOrderController extends Controller
{
    public function AddToCart(Request $request){

        if($request->quantity==null||$request->quantity==0){
            return redirect()->back()->with('msg',"please Enter at least one Quantity");
           }

        $pro=Product::where('id',$request->id)->first();


        if($pro->stock_quantity<$request->quantity){
            return back()->with('msg',"not enough stock in the store currently please try again with lower quantity");
        }
        $checkMyCart=maincart::where("user_id",Auth::id())->first();
        if($checkMyCart==null){
            $newCart=maincart::create([
                'user_id'=>Auth::id(),
            ]);
            $myCart=new cart();
            $myCart->cart_id=$newCart->id;
            $myCart->user_id=Auth::id();
            $myCart->product_id=$request->id;
            $myCart->quantity= $request->quantity;
            $myCart->save();
        }else{
            $nextCondition=cart::where('cart_id',$checkMyCart->cart_id)->where('product_id',$request->id)->first();
           if($nextCondition!=null){

                return redirect()->back()->with('msg',"Item is already in your cart");

           }else{
            $myCart=new cart();
            $myCart->cart_id=$checkMyCart->cart_id;
            $myCart->user_id=Auth::id();
            $myCart->product_id=$request->id;
            $myCart->quantity= $request->quantity;
            $myCart->save();
           }
        }
        return redirect()->route('viewProducts')->with('msg',"added to cart");

    }
    public function deleteMyItem(Request $req){

      $temp=cart::where("user_id",Auth::id())->where('product_id',$req->id)->delete();
      return redirect()->back();
    }

    public function addSingle(Request $req){
         $data= cart::where('productId', $req->id)->where('userId', Auth::id())->with('product')->first();
            cart::where('productId', $req->id)->where('userId', Auth::id())->update([
            'status'=>'in process',
        ]);
        return redirect()->back();

    }
    public function paymentByUser(Request $request){

        $validator = Validator::make($request->all(), [
            'products' => 'required|array|min:1',
            'products.*' => 'required|exists:products,id',
            'quantities' => 'required|array|size:' . count($request->products),
            'quantities.*' => 'required|integer|min:1',
            'prices' => 'required|array|size:' . count($request->products),
            'prices.*' => 'required|numeric|min:0',
            'address' => 'required|string|max:255',
            'payment_method' => 'required|in:credit_card,paypal,cod,stripe',
            'totalprice' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
        ]);



        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }
        $cartData=maincart::where("user_id",Auth::id())->first();
         $quantities=array_values($request->quantities);
         $prices=array_values($request->prices);

        DB::beginTransaction();

        try {
            $checkOrder=order::where('cart_id',$cartData->cart_id)->where("payment_status","pending")->first();
            if($checkOrder!=null){
                order::where('cart_id',$cartData->cart_id)->where("payment_status","pending")->delete();
            }
            $otp=Str::random(6);
            $order = Order::create([

                'user_id' => Auth::id(),
                'order_status' => Order::STATUS_PENDING,
                'total_amount' => $request->totalprice,
                'shipping_address' => $request->address,
                'billig_address' => $request->address,
                'payment_method' => $request->payment_method,
                'payment_status' => Order::PAYMENT_PENDING, // Use constants if defined
                'cart_id'=>$cartData->cart_id,
                'otp'=>$otp,
            ]);
            $i=0;
            foreach($quantities as $q){

                orderitems::create([
                    'order_id'=>$order->oid,
                    "product_id"=>$request->products[$i],
                    "quantity"=>$q,
                    "price"=>$prices[$i],
                ]);
                $i++;
            }
            Payment::create([
                'order_id' => $order->oid,
                'amount' => $request->totalprice,
                'method' => $request->payment_method,
                'status' => Payment::STATUS_PENDING,
                'transaction_id' => "none",
            ]);
            DB::commit();
            if($request->payment_method=="cod"){
               maincart::where('user_id',Auth::id())->delete();
               return redirect()->back()->with('msg',"please wait for admin's response");
            }
            if ($request->payment_method == "stripe") {
                return view('user.payment', [
                    'stripePublishableKey' => env('STRIPE_KEY'),
                    'total_price' => $request->totalprice,
                    'order_id' => $order->oid,
                ]);
            }



        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while processing your order.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}




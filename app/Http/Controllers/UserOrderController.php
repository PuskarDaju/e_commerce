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
            return response()->json([
                'msg'=>"item is already in the cart",
            ]);

           }else{
            $myCart=new cart();
            $myCart->cart_id=$checkMyCart->cart_id;
            $myCart->user_id=Auth::id();
            $myCart->product_id=$request->id;
            $myCart->quantity= $request->quantity;
            $myCart->save();
            
           }
        }     
        return redirect()->back()->with('msg',"added to cart");

    }
    public function deleteMyItem(Request $req){
        
      $temp=cart::where("user_id",Auth::id())->where('product_id',$req->id)->delete();
      return redirect()->back();
    }
    public function addOrder(Request $req)
    {
        $userId=Auth::id();
        
        //   $sales=sales::create([
        //         'user_id'=>Auth::id(),
        //         'no_of_items'=>count($req->ids),
        //         'total_price'=>0,
        //         'status'=>'in process',
        //     ]);
        // Check if 'ids' array exists in the request
        if($req->has('ids') && !empty($req->ids)) {
            // Loop through each id in the array
            foreach($req->ids as $id) {
                // Fetch cart data for the given product ID and authenticated user
                $datas = cart::where('productId', $id)->where('userId', Auth::id())->with('product')->get();
                // foreach($datas as $data) {
                //     // Update the status to 'in process'
                //     salesDetails::create([
                //         'sid'=>$sales->id,
                //         'items'=>$data->product()->name,
                //     ]);
                //     cart::where('productId', $id)->where('userId', Auth::id())->delete();
                // }
            }
           
            // Return success response
            return response()->json(['msg' => 'Order successfully processed']);
        }
    
        // Return an error if 'ids' is not found or empty
        return response()->json(['msg' => 'No valid product IDs provided'], 400);
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
            'products.*' => 'required|exists:products,id', // Ensure products exist in the database
            'quantities' => 'required|array|size:' . count($request->products),
            'quantities.*' => 'required|integer|min:1', // Each quantity must be an integer ≥ 1
            'prices' => 'required|array|size:' . count($request->products),
            'prices.*' => 'required|numeric|min:0', // Each price must be numeric and ≥ 0
            'address' => 'required|string|max:255',
            'payment_method' => 'required|in:credit_card,paypal,cod,stripe', // Only accept specific payment methods
            'totalprice' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
        ]);

    
    
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422); // Unprocessable Entity
        }
        $cartData=maincart::where("user_id",Auth::id())->first();
         $quantities=array_values($request->quantities);
         $prices=array_values($request->prices);
         
        DB::beginTransaction(); // Start a database transaction
    
        try {
            $checkOrder=order::where('cart_id',$cartData->cart_id)->where("payment_status","pending")->first();
            if($checkOrder!=null){
                order::where('cart_id',$cartData->cart_id)->where("payment_status","pending")->delete();
            }
            // Create the order
            $otp=Str::random(6);
            $order = Order::create([

                'user_id' => Auth::id(),
                'order_status' => Order::STATUS_PENDING, // Use constants if defined
                'total_amount' => $request->totalprice,
                'shipping_address' => $request->address,
                'billig_address' => $request->address,
                'payment_method' => $request->payment_method,
                'payment_status' => Order::PAYMENT_PENDING, // Use constants if defined
                'cart_id'=>$cartData->cart_id,
                'otp'=>$otp,
            ]);
            foreach($quantities as $q){
                $i=0;
                orderitems::create([
                    'order_id'=>$order->oid,
                    "product_id"=>$request->products[$i],
                    "quantity"=>$q,
                    "price"=>$prices[$i],
                ]);
                $i++;
            }
    
            // Create the payment record
            Payment::create([
                'order_id' => $order->oid,
                'amount' => $request->totalprice,
                'method' => $request->payment_method,
                'status' => Payment::STATUS_PENDING, // Use constants if defined
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
                    'order_id' => $order->oid, // Use $order->id to pass the order ID
                ]);
            }
            
               
            
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback transaction on error
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while processing your order.',
                'error' => $e->getMessage(),
            ], 500); // Internal Server Error
        }
    }
}
    
    


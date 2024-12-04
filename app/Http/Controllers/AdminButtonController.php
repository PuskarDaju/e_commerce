<?php

namespace App\Http\Controllers;

use App\Models\cart;
use App\Models\order;
use App\Models\payment;
use App\Models\inventoryadjustment;
use App\Models\notification;
use App\Models\orderitems;
use App\Models\Product;
use App\Models\sale;
use App\Models\salesdetail;
use App\Models\User;
use Hamcrest\Type\IsNumeric;
use Illuminate\Support\Facades\DB;
use Stripe\Stripe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Stripe\Exception\ApiErrorException;
use Stripe\Refund;

class AdminButtonController extends Controller
{
    public function gotoProductTable(){
        $stocks=Product::with('category')->get();
        if($stocks==null || empty($stocks)){
            return view('admin.productTable');
        }
        return view('admin.productTable')->with('stocks',$stocks);
    }
    public function gotoAllOrder(){
       
        $orders= order::whereNot('order_status','completed')->with('payment')->get();
        
        return view('admin.allOrder',compact(var_name: 'orders'));
    }
    public function gotoAdminProfile(){
        $user=Auth::user();
        return view('admin.adminProfile',compact(var_name: 'user'));
    }
    public function declineOrder($id){
        $user=order::where("oid",$id)->first();
        
        $order=order::where('oid',$id)->first();
        
        if($order->payment_status=='completed'){
            
            try {
                DB::beginTransaction();
                // Fetch the order
                $order = order::with('payment')->where('oid', $id)->first();
               
        
                if (!$order) {
                
                    return redirect()->back()->with('error', 'Order not found or unauthorized access.');
                }
                
        
                // Check if the order is eligible for cancellation
                if ($order->payment_status == 'completed') {
                   
                    // Update order status
                    $order->update([
                        'order_status' => 'canceled',
                        'payment_status' => 'refunded',
                    ]);
                    
                   
        
                    // Process refund based on payment method
                    if ($order->payment->method == "stripe") {
                     
                        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
                        
                   
                            $refund = Refund::create([
                                'payment_intent' => $order->payment->transaction_id,
                                'amount' => $order->payment->amount * 100, // Amount in cents
                            ]);
                            
                        

        
                        // Update payment record in the database
                     payment::where('order_id',$order->oid)->update([
                        "status"=>"refunded"
                     ]);
                      
                    }
        
                    // Notify the user
                    notification::create([
                        'user_id' => Auth::id(),
                        'msg' => "Your order #{$id} has been canceled and refunded lol.",
                    ]);
                  DB::commit();
                    
        
                    
        
                    return redirect()->route('user.orders')->with('success', 'Order canceled and refunded successfully.');
                } else {
                    return redirect()->back()->with('error', 'Order cannot be canceled or is not eligible for a refund.');
                }
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
            }
        }
        $notification=notification::create([

            "user_id"=>$order->user_id,
            "msg"=>"Your order of order id ".$order->oid." has been cancelled",
        ]);
        $user=order::where("oid",$id)->delete();
        
        return redirect()->back();
    }
    //public function approveOrder(){}

    public function showGuys(){
        $guys=User::where('userType',"delivery")->get();
        return view('admin.delivery')->with('guys',$guys);
    }
    public function confirmDelivery(Request $req){
        $myOtp=Validator::make(
            $req->all(),[
                "otp"=>"required|string|min:6",
            ]
        );
        if($myOtp->fails()){
            return response()->json([
                'msg'=>"please enter a valid otp",
                
            ]);
        }
        $actualOtp=order::where('otp',$req->otp)->first();
        if($actualOtp!=null){
            $sales=sale::create([
                'user_id'=>$actualOtp->user_id,
                'payment_method'=>$actualOtp->payment_method,
                'total_amount'=>$actualOtp->total_amount,
            ]);
            $detailsOfOrder=orderitems::where('order_id',$actualOtp->oid)->get();
            
            foreach($detailsOfOrder as $a){
                salesdetail::create([
                    'sales_id'=>$sales->id,
                    'product_id'=>$a->product_id,
                    "quantity"=>$a->quantity,
                    "price"=>$a->price,
                ]);
                
               
                $product=Product::where('id',$a->product_id)->first();
                $product->decrement('stock_quantity',$a->quantity);
            }

            $actualOtp->delete();

        }else{

            return response()->json([
                'msg'=>"wrong otp",
            ]);
        }
    }
   
}    
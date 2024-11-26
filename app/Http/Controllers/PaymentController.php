<?php

namespace App\Http\Controllers;

use App\Models\maincart;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\PaymentMethod;
use Stripe\PaymentIntent;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\cart;
use App\Models\order;
use App\Models\payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
 
    
    public function processPayment(Request $request)
{
    Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

    try {
        $user = User::where('id', Auth::id())->first();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => "Unauthorized user. Please sign in before continuing.",
            ]);
        }

        if (!$user->stripe_customer_id) {
            // If the user doesn't have a Stripe customer ID, create a new customer in Stripe
            $customer = \Stripe\Customer::create([
                'email' => $user->email, 
                'name' =>$user->name,  
            ]);

            // Save the customer ID to the database
            $user->stripe_customer_id = $customer->id;
            $user->save();
        } else {
            // Retrieve the existing customer
            $customer = \Stripe\Customer::retrieve($user->stripe_customer_id);
        }

        $paymentMethod = \Stripe\PaymentMethod::retrieve($request->payment_method_id);
        if (!$paymentMethod->customer) {
            $paymentMethod->attach(['customer' => $customer->id]);
        }

        $paymentIntent = \Stripe\PaymentIntent::create([
            'amount' => $request->price * 100, // Convert amount to cents
            'currency' => 'usd',
            'description' => $request->description,
            'customer' => $customer->id, // Link to the Stripe customer
            'payment_method' => $paymentMethod->id, // Use the attached payment method
            'off_session' => true, // For payments without user intervention
            'confirm' => true,    // Confirm the payment immediately
            'metadata' => [
                'user_id' => $user->id,  // Track user ID
                'email' => $user->email, // Track email
                'name' => $user->name,   // Track name
                'order_id' => $request->order_id ?? 'N/A', // Track optional order ID
            ],
        ]);
        if($paymentIntent){
           
            try{
            
            
            order::where('oid',$request->order_id)->update([
               "order_status"=>"shipped",
                'payment_status'=>"completed",
            ]);


           

           payment::where('order_id',$request->order_id)->update([
                "status"=>"completed",
                "transaction_id"=>$paymentIntent->id,
            ]);
           
          
           maincart::where('user_id',Auth::id())->delete();
            

        }catch(\Exception $e){
            DB::rollBack();
        }
        }
        // Return success response
      return redirect()->route('gotoCart')->with('msg',"payment sucessfull");

    } catch (\Stripe\Exception\CardException $e) {
        // Handle card-specific errors
        return response()->json([
            'success' => false,
            'message' => 'Card was declined: ' . $e->getMessage(),
        ]);
    } catch (\Exception $e) {
        // Handle other general errors
        return response()->json([
            'success' => false,
            'message' => 'Payment processing failed: ' . $e->getMessage(),
        ]);
    }
}

    
    public function success(){
        return view('user.success');
    }

}

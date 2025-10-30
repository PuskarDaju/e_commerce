<?php

namespace App\Http\Controllers;

use App\Models\maincart;

use Stripe\Stripe;
use Stripe\Customer;
use Stripe\PaymentMethod;
use Stripe\PaymentIntent;
use Illuminate\Http\Request;
use App\Models\order;
use App\Models\payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function processPayment(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        $request->validate([
            'payment_method_id' => 'required|string',
            'price' => 'required|numeric|min:1',
            'description' => 'nullable|string',
            'order_id' => 'required',
        ]);

        try {
            $user = Auth::user();
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => "Unauthorized user. Please sign in before continuing.",
                ]);
            }

            if (!$user->stripe_customer_id) {
                $customer = Customer::create([
                    'email' => $user->email,
                    'name'  => $user->name,
                ]);
                $user->stripe_customer_id = $customer->id;
                $user->save();
            } else {
                $customer = Customer::retrieve($user->stripe_customer_id);
            }

            // Attach payment method
            $paymentMethod = PaymentMethod::retrieve($request->payment_method_id);
            if (!$paymentMethod->customer) {
                $paymentMethod->attach(['customer' => $customer->id]);
            }

            // Create payment intent
            $paymentIntent = PaymentIntent::create([
                'amount' => $request->price * 100,
                'currency' => 'usd',
                'description' => $request->description,
                'customer' => $customer->id,
                'payment_method' => $paymentMethod->id,
                'off_session' => true,
                'confirm' => true,
                'metadata' => [
                    'user_id' => $user->id,
                    'email' => $user->email,
                    'name' => $user->name,
                    'order_id' => $request->order_id ?? 'N/A',
                ],
            ]);

            // Update DB on success
            if ($paymentIntent) {
                DB::beginTransaction();
                try {
                    Order::where('oid', $request->order_id)->update([
                        "order_status" => "shipped",
                        "payment_status" => "completed",
                    ]);

                    Payment::where('order_id', $request->order_id)->update([
                        "status" => "completed",
                        "transaction_id" => $paymentIntent->id,
                    ]);

                    MainCart::where('user_id', Auth::id())->delete();

                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollBack();
                    throw $e;
                }
            }

            return redirect()->route('gotoCart')->with('msg', "Payment successful");

        } catch (\Stripe\Exception\CardException $e) {
            return response()->json(['success' => false, 'message' => 'Card was declined: ' . $e->getMessage()]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Payment failed: ' . $e->getMessage()]);
        }
    }


    public function success(){
        return view('user.success');
    }

}

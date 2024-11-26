<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\order;
use App\Models\sale;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;



class AuthController extends Controller
{
    public function logMeIn(Request $req){
        $validData=validator::make(
            $req->all(),
            [
                
                'email'=>'required|email',
                'password'=>'required|string'

            ],
            );
            if($validData->fails()){
                return view('Authentication.login')->with('error',"Please enter data in valid format");

            }else{
                $data=([
                    'email'=>$req->email,
                    'password'=>$req->password
                ]);
                
                
               if(Auth::attempt($data)){
                  return redirect()->route('dash');
                
               }

                 
                else{
                    return redirect()->route('login')->with('error',"Invalid Email or Password");
                }
            }
    }
    public function registerMe(Request $req){
        $validData=validator::make(
            $req->all(),[
                'username'=>'required|string',
                'email'=>'required|email:dns,spoof|unique:users,email',
                'password'=>'required|string',
                'confirmPassword'=>'required|string|same:password'
            ]);
            if($validData->fails()){
               return redirect()->route('signUp')->with('error',$validData->errors());
               
            }else{
                $dataToInsert=User::create([
                    'name'=>$req->username,
                    'email'=>$req->email,
                    'password'=>$req->password
                ]);
                if($dataToInsert){
                    return redirect()->route('login')->with('error',"Registration Successful");
                }else{
                    return redirect()->route('signUp')->with('error',"Registration Failed");
                }

            }
    }
    public function logMeOut(){
        session_abort();
        Auth::logout();
        return redirect()->route('login')->with('error',"logged out successfully");
    }
    public function dashBoard(){
        if(Auth::user()){
            $profile=Auth::user();
            if(Auth::user()->userType=='admin'){
               

                $currentDate = Carbon::now('Asia/Kathmandu'); // This sets the correct time zone for Nepal (UTC +5:45)

                // Set today as the end of the week (which is today)
                $endOfWeek = $currentDate;
        
                // Calculate the start of the week as exactly 7 days before today
                $startOfWeek = $currentDate->copy()->subDays(6);
        
                // Convert the start and end of week to 'Y-m-d' format for proper comparison in SQL query
                $startOfWeekFormatted = $startOfWeek->format('Y-m-d');
                $endOfWeekFormatted = $endOfWeek->format('Y-m-d');
        
                
        
                // Get sales data for the last 7 days (using the correct time zone)
                $salesData = Sale::whereDate('created_at', '>=', $startOfWeekFormatted)
                                 ->whereDate('created_at', '<=', $endOfWeekFormatted)
                                 ->selectRaw('DATE(created_at) as date, SUM(total_amount) as total')
                                 ->groupBy('date')
                                 ->orderBy('date', 'asc')
                                 ->get();
        
                
        
                // Prepare data for the chart
                $weekLabels = [];
                $weekSalesData = [];
        
                // Loop through the sales data and prepare the labels and sales totals
                for ($i = 0; $i < 7; $i++) {
                    $date = $startOfWeek->copy()->addDays($i);
                    $weekLabels[] = $date->format('D'); // 'Mon', 'Tue', etc.
        
                    // Check if sales data exists for the current date
                    $salesForDay = $salesData->firstWhere('date', $date->format('Y-m-d'));
                    $weekSalesData[] = $salesForDay ? (float) $salesForDay->total : 0.00; // Default to 0 if no sales for the day
                }

                $pendingOrders=order::where('order_status',"pending")->count();
                $shipOrders=order::where('order_status',"shipped")->count();
                $cancelOrder=order::where('order_status',"cancelled")->count();
                return view('admin.dashboard',[
                    'profile'=>$profile,
                    "pending"=>$pendingOrders,
                    "shipped"=>$shipOrders,
                    'cancel'=>$cancelOrder,
                    'weekLabels'=>$weekLabels,
                    "weekSalesData"=>$weekSalesData,
                ]);
            }else if($profile->userType=='user'){
                return view('user.dashboard',compact('profile'));
            }else if($profile->userType=='delivery'){
                return view("delivery.home");
            }
        }else{
            return redirect()->route('login');
        }
    }
}

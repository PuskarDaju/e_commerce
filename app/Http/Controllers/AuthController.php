<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


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
        if(Auth::user()->userType=='admin'){
            return view('admin.dashboard');
        }else{
            return view('user.dashboard');
        }
    }
}

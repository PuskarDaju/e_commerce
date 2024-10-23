<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class MyProfileController extends Controller
{
    public function changeDetails(Request $request){
        $validUser=Validator::make(
            $request->all(),
            [
                'username'=>'required|string',
                'email'=>'required|email:dns,spoof',Rule::
                unique('users')->ignore(Auth::id()),
                'profilePic' => 'nullable|image|mimes:jpeg,png,jpg',
            ]
            );

            if($validUser->fails()){
                return response()->json(['error'=>$validUser->errors()],400);

            }else{
                if($request->hasFile('profilePic')){
                    $fileName=$request->file('profilePic')->getClientOriginalName();
                    $request->file('image')->storeAs('images/profile',$fileName,'public');
                }
                $user=User::find(Auth::id());
                $user->name=$request->username;
                $user->email=$request->email;
                if($request->profilePic!=null && empty($user->profilePic)){
                    $user->photo=$fileName;
                }
                $user->save();

                return redirect()->route('profile')->with('message',"profileUpdated Successfully");

            }
            

    }
}

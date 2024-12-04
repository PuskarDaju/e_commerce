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
        $validUser = Validator::make(
            $request->all(),
            [
                'username' => 'required|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg',
                'email' => [
                    'required',
                    'email:dns,spoof',
                    Rule::unique('users')->ignore(Auth::id())
                ],
            ]
        );

        if ($validUser->fails()) {
            return response()->json(['error' => $validUser->errors()], 400);
        }else{
            $user=User::find(Auth::id());
            if($request->hasFile('image')){
                $fileName=$request->file('image')->getClientOriginalName();
                $request->file('image')->storeAs('images/profile', $fileName,'public');
                $user->photo=$fileName;
            }
            $user->name=$request->username;
            $user->email=$request->email;
            $user->save();
            return redirect()->back();
        }

       

        


    }
}

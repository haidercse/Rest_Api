<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request){
        $request->validate([
            'name'     => 'required|max:50|string',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();


        $token = $user->createToken('registerToken')->plainTextToken;

        return response()->json([
            'success' => 'User register successfully!!',
            'token' => $token,
        ],201);

    }

    public function login(Request $request){

        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

       $user = User::where('email',$request->email)
             // ->where('password',$request->password)
              ->first();
      
       if ($user ){

            $token = $user->createToken('registerToken')->plainTextToken;
            
            return response()->json([
                'success' => 'User login successfully!!',
                'token' => $token,
            ],201);
       }
       else{
           return response(['message' => 'bad']);
       }

      
       
    }

    public function logout(){
        auth()->user()->tokens()->delete();

        return response()->json([
            'success' => 'Logged out successfully!'
        ]);
    }

    
    
}

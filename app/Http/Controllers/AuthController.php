<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;


class AuthController extends Controller
{
    public function user(){
        return Auth::user();
    }

    public function login(Request $request){
       if(!Auth::attempt($request->only('email', 'password'))){
        return response([
            'message' => 'invalid credentials',
        ], status:Response::HTTP_AUTHORIZED);
       };

       $user = Auth::user();

       $token = $user->createToken('token')->plainTextToken;

       $cookie = cookie('jwt', $token, 60*24);

       return response([
        'message' => $token,
       ])->withCookie($cookie);
    }

    public function register(Request $request){
        return User::create([
            'name' => $request->input(key: 'name'), 
            'email' => $request->input(key: 'email'), 
            'password' => Hash::make($request->input(key: 'password')) 
        ]);
    }
        
    public function logout(){
        $cookie = Cookie::forget('jwt');
    
        return response()->json([
            'message' => 'Success'
        ])->withCookie($cookie);
    }
}

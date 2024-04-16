<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ApiController extends Controller
{
    public function login(Request $request){
        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials)){
            $user = Auth::user();
            $token = $user->createToken('Login')->accessToken;
            return response()->json([
                "status" => 200,
                "success"=>$token
            ],200);

        }

        return response()->json([
            "status" => 401,
            "error"=>"Unauthorized"
        ],401);
    }
}

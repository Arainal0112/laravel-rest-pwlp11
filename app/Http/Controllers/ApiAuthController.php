<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\LoginResource;
use Illuminate\Support\Facades\Hash;

class ApiAuthController extends Controller
{
    public function login(LoginRequest $request){
        //Cek data user
        $user = User::where('username',$request->username)->first();

        if(!$user || !Hash::check($request->password, $user->password)){
            return response()->json([
                'message' => 'User atau password salah'
            ],401);
        }
        //generate token
        $token = $user->createToken('token')->plainTextToken;

        return new LoginResource([
            'message'=>'succes login',
            'user' => $user,
            'token' => $token,
        ],200);
    }
}

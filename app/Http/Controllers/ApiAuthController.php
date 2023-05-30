<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\LoginResource;
use App\Http\Requests\RegisterRequest;

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

    public function logout(Request $request){
        #Hapus
        $request->user()->tokens()->delete();

        #respon
        return response()->noContent();
    }
    public function register(RegisterRequest $request){
        $user=User::create([
            'username'=>$request->username,
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);
        $token = $user->createToken('token')->plainTextToken;
        return new LoginResource([
            'message'=>'succes login',
            'user' => $user,
            'token' => $token,
        ],200);
    }
}

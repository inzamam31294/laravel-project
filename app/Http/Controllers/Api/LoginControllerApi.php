<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class LoginControllerApi extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    public function login(Request $request)
    {
        $user = $request->only('email', 'password');

        try{
            if(! $token = JWTAuth::attempt($user)){
                return response()->json(['error'=>'invalid credentials'], 400);
            }
        }
        catch(JWTExecption $err){

            return response()->json(['error'=>'could not create token'], 500);
        }

        return response()->json([
         'data' => compact('token')]
         ,202);

    }


}


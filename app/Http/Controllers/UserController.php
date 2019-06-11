<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserController extends Controller
{
    public function index()
    {
        $users = \App\User::all();
        
        // dd($users);
        return($users);

        // return view('layouts.user');
    }

    public function getAuthenticatedUser()
    {
        // return('hello!');
        try
        {
            if(! $user = JWTAuth::parseToken()->authenticate()){
                return respone()->json(['user not found'], 404);
            }

        }
        catch(Tymon\JWTAuth\Exceptions\TokenExpiredException $exc)
        {
            return response()->json(['token expired'], $exc->getStatusCode());
        }
        catch(Tymon\JWTAuth\Exceptions\TokenInvalidException $exc)
        {
            return response()->json(['token invalid'], $exc->getStatusCode());
        }
        catch(Tymon\JWTAuth\Exceptions\JWTException $exc)
        {
            return response()->json(['token absent'], $exc->getStatusCode());
        }
        return response()->json([
            'data'=>compact('user')
            ]);
    }


    public function payload()
    {
        return JWTAuth::payload();
    }
















    // public function register(request $request)
    // {
    //     try{
    //     $name=$request->input('name');
    //     $email=$request->input('email');
    //     $password=$request->input('password');
    //     $token=sha1(time());
    //     echo DB:: insert('insert into users(name, email, password, token) values(?, ?, ?, ?)', [$name, $email, $password, $token]);
    //     }
    //     catch(error $err){
    //         return $err->getMessaage();
    //     }
        
    // }
    // public function login(request $request)
    // {
    //     try{
    //         $name=$request->input('name');
    //         // $email=$request->input('email');
    //         $password=$request->input('password');
    //         $token=sha1(time());
    //         $data= DB:: select('select id from users where name=? and password=?', [$name, $password]);
    //         if(count($data)){
    //             echo "logged in successfully!";
    //         }
    //     }
    //     catch(error $err){
    //         return $err->getMessage();
    //     }
      
    // }
}

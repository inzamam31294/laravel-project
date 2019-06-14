<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/register', 'Api\RegisterControllerApi@register');
Route::post('/login', 'Api\LoginControllerApi@login');
Route::post('/forgetpassword', 'Api\ForgetPasswordControllerApi@sendResetLinkEmail');
Route::post('/resetpassword', 'Api\ResetPasswordControllerApi@reset');

Route::group(['middleware' => ['auth.jwt']], function(){
    Route::get('users', 'UserController@getAuthenticatedUser');
    Route::post('payload', 'UserController@payload');
});

// Route::get('users', 'UserController@getAuthenticatedUser');
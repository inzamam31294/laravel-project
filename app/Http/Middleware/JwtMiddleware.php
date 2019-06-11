<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use Exception;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try{
            $user = JWTAuth::parseToken()->authenticate();
        }
        catch(Exception $exc)
        {
            if($exc instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException)
            {
                return response()->json(['status' => 'Token invalid!']);
            }
            else if($exc instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException)
            {
                return response()->json(['status' => 'Token Expired!']);
            }
            else
            {
                return response()->json(['status' => 'Token not found!']);
            }
        }

        return $next($request);
    }
}

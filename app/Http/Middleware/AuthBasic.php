<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
class AuthBasic
{
//     public function handle(Request $request, Closure $next)
//     {
//         if(Auth::onceBasic()){
//             return response()->json(['message' => 'Auth failed'], 401);
//         }
//         return $next($request);
//     }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class authCheck
{
    public function handle(Request $request, Closure $next)
    {
        if(!Auth::user() && ($request->path() != '/login' && $request->path() != '/register')){
            return redirect('/login')->with('fail', 'You have to login or register first!');
        }
        if(Auth::user() && ($request->path() == '/login' || $request->path() == '/register')){
            return redirect('/')->with('fail', 'Logout first please!');
        }
        return $next($request);
    }
}

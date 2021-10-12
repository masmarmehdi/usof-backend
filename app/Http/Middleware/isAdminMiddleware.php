<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\{
    Http\Request,
    Support\Facades\Auth
};

class isAdminMiddleware
{

    public function handle(Request $request, Closure $next){

        if(Auth::user()->role == 'user'){
            return redirect()->route('homepage')->with('fail', 'Only admin can access to this page!');
        }
        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsAdminAuth
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
        if(Auth::check() && !Auth::user()->status){
            Auth::logout();
            abort(401,'用户被限制登录');
        }
        if(Auth::check() && Auth::user()->is_admin)
        {
            return $next($request);
        }
        return redirect('/');
    }
}

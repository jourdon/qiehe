<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ThirdLogin
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
        if(Auth::check()){
            $url ='/users/'.Auth::id().'/edit';
            if(Auth::user()->status==0 && $request->getPathInfo()!= $url && $request->method()=='GET') {
                return redirect(url($url))->with('danger','第三方登录后必须绑定邮箱！');
            }
        }

        return $next($request);
    }
}

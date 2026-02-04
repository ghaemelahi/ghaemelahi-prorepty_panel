<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class CheckActiveUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::guard() && Auth::user()->active == 1)
        {
            return $next($request);
        }else{
            Auth::logout();
            Session::flush();
            return redirect()->route('login')->with('error_deactive_user_system',"کاربر مورد نظر غیرفعال است.");
        }
    }
}

<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::check() == true) {
            if (Auth::user()->userLevel  < 1 ){
                return redirect()->action('AdminController@index');
            }
        } else {
            return redirect()->route('login');
        }
        return $next($request);
    }
}

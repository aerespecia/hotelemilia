<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class FrontDesk
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
            if(!Auth::user()->IsFrontDesk()){
                return redirect()->intended('/');
            }
        }
        
        return $next($request);
    }
}

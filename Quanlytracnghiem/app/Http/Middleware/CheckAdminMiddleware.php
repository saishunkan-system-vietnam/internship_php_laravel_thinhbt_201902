<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckAdminMiddleware
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
        //return $next($request);

        if(Auth::check()&&Auth::user()->type==1){
            return $next($request);
        }else{
            return redirect('/');
        }
    }
}

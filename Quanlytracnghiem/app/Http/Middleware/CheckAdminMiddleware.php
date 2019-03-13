<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Support\MessageBag;

class CheckAdminMiddleware
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
        //return $next($request);

        if(Auth::check() && Auth::user()->type == 1){
            return $next($request);
        }else{
            $errors = new MessageBag (['errorLogin' => 'Only for Admin !!!' ]);
            return redirect('/')->withErrors($errors);
        }
    }
}

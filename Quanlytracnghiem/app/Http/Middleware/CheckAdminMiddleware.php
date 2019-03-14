<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Session;

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
            Auth::logout();
            Session::flush();
            $errors = new MessageBag (['errorLogin' => 'Only for Admin !!!' ]);
            return redirect()->back()->withInput()->withErrors($errors);
            //die('ass');
        }
    }
}

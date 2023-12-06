<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
          //stopping of attempting to go to the login or register page while in a dashboard

          if(!empty(Auth::user())){
            if( url()->current() == route('auth#loginPage')){
                return back();
            }
            return $next($request);
        }
        return $next($request);
    }
}

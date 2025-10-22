<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
   public function handle(Request $request, Closure $next)
   {
       if (Auth::check()) {
           logger('User logged in. Role: ' . Auth::user()->role);
           if (Auth::user()->role == 1) {
               return $next($request);
           } else {
               logger('Access denied: Not admin');
           }
       } else {
           logger('Access denied: Not logged in');
       }
   
       return redirect()->route('login')->with('error', 'Access denied.');
   }


}
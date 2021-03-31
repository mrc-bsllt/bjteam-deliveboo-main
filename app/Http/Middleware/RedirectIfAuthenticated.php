<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */

   //  public function handle($request, Closure $next, $guard = null)
   //  {
   //      if (Auth::guard($guard)->check()) {
   //          return redirect(RouteServiceProvider::HOME);
   //      }

   //      return $next($request);
   //  }

    public function handle($request, Closure $next, $guard = null) {
        if (Auth::guard($guard)->check()) {
          $role = Auth::user()->role;
          switch ($role) {
            case 'seller':
               return redirect('/seller/questions');
               break;
            case 'customer':
               return redirect('/customer/questions');
               break;

            default:
               return redirect('/home');
               break;
          }
        }
        return $next($request);
    }

}

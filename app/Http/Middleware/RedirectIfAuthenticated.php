<?php

namespace App\Http\Middleware;

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
    public function handle($request, Closure $next, $guard = null)
    {
    
        switch ($guard) {
          
          case 'admin':
            if (Auth::guard($guard)->check()) {
              return redirect()->route('admin.dashboard');
            }
          break;
  
            default:
              if (Auth::guard($guard)->check()) 
              {
                if(Auth::user()->user_type == 'owner')
                {
                  return redirect(route('owner'));
                }
                else if(Auth::user()->user_type == 'renter')
                {
                  return redirect(route('renter'));
                }
              }
              break;
          }
          return $next($request);
    }
}

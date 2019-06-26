<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ownerAuth
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
        if( Auth::check() )
        {
            // if user admin take him to his dashboard
            if ( Auth::user()->user_type == 'owner' ) {
                return $next($request);
           }
           // allow admin to proceed with request
           else if ( Auth::user()->user_type == 'renter' ) {
               return redirect(route('renter'));
           }
           else if ( Auth::user()->user_type == 'admin' ) {
               return redirect(route('admin.dashboard'));
           }
        }
        abort(404);  // for other user throw 404 error
    }
}

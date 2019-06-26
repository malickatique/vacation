<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;

class renterAuth
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
            if ( Auth::user()->user_type == 'renter' ) {
                return $next($request);
           }
           // allow admin to proceed with request
           else if ( Auth::user()->user_type == 'owner' ) {
               return redirect(route('owner'));
           }
           else if ( Auth::user()->user_type == 'admin' ) {
               return redirect(route('admin.dashboard'));
           }
        }
        abort(404);  // for other user throw 404 error
    }
}

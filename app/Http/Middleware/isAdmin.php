<?php

namespace App\Http\Middleware;

use Closure;

use Auth;

class isAdmin
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
        if(Auth::user()->user_type != "admin"){
            return redirect(route('quake_list'));
        }
        return $next($request);
    }
}

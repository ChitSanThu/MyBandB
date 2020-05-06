<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class User
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
        if (!Auth::check()) {

            return redirect('/');
        } else if (Auth::user()->hasRole('housekeeping'))
            return redirect('housekeeping/index');
	else if (Auth::user()->hasRole('admin'))
		return $next($request);
        else
            return $next($request);
    }
}

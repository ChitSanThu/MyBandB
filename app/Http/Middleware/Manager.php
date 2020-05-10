<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Manager
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
            return redirect('/')->with('status', 'login first');
        } else if (Auth::user()->hasRole('admin'))
            return $next($request);
        else if (Auth::user()->hasRole('frontdesk'))
            return redirect('user/frontdesk');
        else
            return redirect('housekeeping/index');
    }
}

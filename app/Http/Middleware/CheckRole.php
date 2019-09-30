<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
//use Illuminate\Foundation\Auth;
use Illuminate\Support\Facades\Auth;

//use Dingo\Api\Auth\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user()->roles[0]->id == 1) {
            return $next($request);
        };

        return route('home');
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AlredyLoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (url('login') == $request->url() || url('register')) {
            return back()->with('fail', "Something went wrong");
        }
        return $next($request);
    }
}

// && url('login') == $request->url() || url('register')
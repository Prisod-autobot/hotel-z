<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;
        $user = Auth::user();

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                if ($user->level == "admin") {
                    return redirect()->route('admin');
                } else {
                    return redirect()->route('index');
                }
                // return redirect(RouteServiceProvider::HOME);
            }
        }
        return $next($request);
    }
}
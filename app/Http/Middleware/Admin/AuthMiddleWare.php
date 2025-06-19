<?php

namespace App\Http\Middleware\Admin;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $guardes = config('auth.guards');

        foreach ($guardes as $guard => $value) {
            if(Auth::guard($guard)->check()){
                if(Auth::guard('admin')->check()){
                    return redirect()->route('admin.dashboard');
                }
            }
        }

        return $next($request);
    }
}

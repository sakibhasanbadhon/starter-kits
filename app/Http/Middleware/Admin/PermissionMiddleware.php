<?php

namespace App\Http\Middleware\Admin;

use App\Models\Admin\Admin;
use Closure;
use Illuminate\Http\Request;
use App\Models\Admin\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::guard('admin')->check()){
            if (session()->has('permission')) {
                foreach (session('permission') as $permission) {
                    Gate::define($permission, function ($user) use ($permission) {
                        return true;
                    });
                }
            }
        }

        return $next($request);
    }
}

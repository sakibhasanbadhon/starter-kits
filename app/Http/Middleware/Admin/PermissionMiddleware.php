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
        if(Auth::check()){
            $permissions = Permission::all();
            foreach ($permissions as $permission) {
                Gate::define($permission->slug, function(Admin $admin) use ($permission){
                    return $admin->hasPermission($permission->slug);
                });
            }
        }
        return $next($request);
    }
}

<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // auth()->admin()
        Auth::macro('admin', function () {
            return Auth::guard('admin')->user();
        });

        // string type length define
        Schema::defaultStringLength(191);

        // custom directive
        Blade::if('permission', function($permission){
            if(collect(\Illuminate\Support\Facades\Session::get('permission'))->contains($permission)){
                return true;
            }
            return false;
        });

    }
}

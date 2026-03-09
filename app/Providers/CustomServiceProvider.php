<?php

namespace App\Providers;

use App\Models\Admin\SystemMaintenance;
use Exception;
use Illuminate\Support\ServiceProvider;
use th;

class CustomServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        try {
            $view_share = [];
            $view_share['system_maintenance'] = SystemMaintenance::first();
    
            view()->share($view_share);
        } catch (Exception $e) {
            //throw $th;
        }
    }
}

<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\App;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Schema;
use Yajra\DataTables\Utilities\Config;
use Illuminate\Support\ServiceProvider;

class SettingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('settings', function(){
            return new Setting();
        });
        $loader = AliasLoader::getInstance();
        $loader->alias('Setting',Setting::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        if(!App::runningInConsole() && count(Schema::getColumnListing('settings'))){
            $settings = Setting::all();
            $config = \app(Config::class);
            foreach ($settings as $setting) {
                $config->set('settings.'.$setting->key, $setting->value);
            }
        }
    }
}

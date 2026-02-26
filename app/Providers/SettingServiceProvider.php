<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class SettingServiceProvider extends ServiceProvider
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
            // Share global settings with all blade views
            if (\Illuminate\Support\Facades\Schema::hasTable('settings')) {
                $appName = Setting::getVal('app_name', config('app.name'));
                $appLogo = Setting::getVal('app_logo', '/img/logo.png');
                $primaryColor = Setting::getVal('primary_color', '#0d6efd');

                View::share('globalAppName', $appName);
                View::share('globalAppLogo', $appLogo);
                View::share('globalPrimaryColor', $primaryColor);
            }
        } catch (\Exception $e) {
            // Ignore if DB is not ready yet
        }
    }
}

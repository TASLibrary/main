<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        if(request()->server->has('HTTP_X_FORWARDED_PROTO')){
            \URL::forceScheme('https');
            \URL::forceRootUrl(\Config::get('app.url'));
        }

        $settings = Setting::all();
        foreach ($settings as $setting){
            View::share($setting->name, $setting->value);
        }

    }
}

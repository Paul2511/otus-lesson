<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::if('admin', function() {
            return auth()->check() && Auth::user()->isAdmin();
        });
        Blade::if('guestCheckAuth', function() {
            return auth()->check() && Auth::user()->isGuest();
        });
        Blade::if('trainer', function() {
            return auth()->check() && Auth::user()->isTrainer();
        });
        Blade::if('support', function() {
            return auth()->check() && Auth::user()->isSupport();
        });
        Blade::if('content', function() {
            return auth()->check() && Auth::user()->isContent();
        });
    }
}

<?php


namespace App\Services\Routes\Providers\PublicRoutes;


use App\Http\Controllers\PublicPagesController;
use App\Http\Middleware\Localization;
use Route;


class PublicRoutesProvider
{

    public function register()
    {
        Route::get('', [static::class, 'defaultRoute']);

        Route::middleware(Localization::class)
            ->prefix('{locale}/')
            ->group(function () {
                $this->registerLocalizedRoutes();
            });
    }

    public function defaultRoute()
    {
        return redirect(PublicRoutes::home());
    }

    public function registerLocalizedRoutes()
    {
        Route::get('', [PublicPagesController::class, 'index'])
            ->name('home');
        Route::get('contacts', [PublicPagesController::class, 'contacts'])
            ->name('contacts');
    }

}

<?php

namespace App\Providers;

use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Models\User;
use App\Services\Auth\AuthService;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Illuminate\Http\Request;

class FortifyServiceProvider extends ServiceProvider
{

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
        Fortify::authenticateUsing(function (Request $request) {
            return  app(AuthService::class)->login($request);
        });

        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        Fortify::loginView(function () {
                $data = [
                    'category_name' => 'auth',
                    'page_name' => 'auth_default',
                    'has_scrollspy' => 0,
                    'scrollspy_offset' => '',
                ];
            return view('pages.authentication.auth_login')->with($data);
        });

    }
}

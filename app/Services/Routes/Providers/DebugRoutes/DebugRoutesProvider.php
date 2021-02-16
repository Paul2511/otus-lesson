<?php


namespace App\Services\Routes\Providers\DebugRoutes;


use Auth;
use Route;


class DebugRoutesProvider
{

    public function register()
    {
        Route::prefix('debug')
            ->as('debug.')
            ->middleware('auth')
            ->group(
                function () {
                    Route::get('error', function () {
                        return 1 / 0;
                    })->name('error');

                    Route::get('admin', function () {
                        Auth::user()->role = \App\Models\User::ROLE_ADMIN;
                        Auth::user()->save();

                        dump(Auth::user());
                        // return redirect()->back();
                    });

                    Route::get('default', function () {
                        Auth::user()->role = \App\Models\User::ROLE_DEFAULT;
                        Auth::user()->save();

                        dump(Auth::user());
                        // return redirect()->back();
                    });

                    Route::get('moderator', function () {
                        Auth::user()->role = \App\Models\User::ROLE_MODERATOR;
                        Auth::user()->save();

                        dump(Auth::user());
                        // return redirect()->back();
                    });
                }
            );
    }

}

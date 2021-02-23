<?php


namespace App\Services\Routes\Providers\DebugRoutes;


use App\Models\User;
use Auth;
use Route;
use Str;


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

                    Route::get('token', function () {
                        /** @var User $user */
                        $user = Auth::user();
                        if (!$user) {
                            abort(401);
                        }

                        $token = $user->api_token;
                        if (!$token) {
                            $token = Str::random(60);
                            $user->api_token = $token;
                            $user->save();
                        }

                        dump(compact('token'));
                    });

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

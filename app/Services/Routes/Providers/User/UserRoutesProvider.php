<?php


namespace App\Services\Routes\Providers\User;


use App\Http\Controllers\User\UserDashboardIndexController;
use Illuminate\Support\Facades\Route;

final class UserRoutesProvider
{
    public function registerRoutes()
    {
        Route::get('{locale}/dashboard', UserDashboardIndexController::class)
            ->name(UserRoutes::USER_DASHBOARD)
            ->middleware('auth', 'user', 'log');
        //Admin Routes
        Route::group([
            'prefix' => '{locale}/',
            'where' => ['locale' => '[a-zA-Z]{2}'],
            'as' => 'user.',
            'middleware' => ['auth', 'user', 'log'],
        ], function () {
            Route::redirect('/', UserRoutes::USER_DASHBOARD);
            Route::view('profile', UserRoutes::USER_PROFILE)->name('profile');
            Route::view('contacts', UserRoutes::USER_CONTACTS_INDEX)->name('contacts');
            Route::view('knowledgebase', UserRoutes::USER_KNOWLEDGEBASE_INDEX)->name('knowledgebase');
            Route::view('documents', UserRoutes::USER_DOCUMENTS_INDEX)->name('documents');
            Route::view('payments', UserRoutes::USER_PAYMENTS_INDEX)->name('payments');
            Route::view('orders', UserRoutes::USER_ORDERS_INDEX)->name('orders');
        });
    }
}
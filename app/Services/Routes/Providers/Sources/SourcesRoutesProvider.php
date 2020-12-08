<?php


namespace App\Services\Routes\Providers\Sources;

use App\Http\Controllers\Sources\AboutController;
use App\Http\Controllers\Sources\AdvancedRecordsController;
use App\Http\Controllers\Sources\BalanceReportController;
use App\Http\Controllers\Sources\DashboardController;
use App\Http\Controllers\Sources\EfficiencyStatisticController;
use App\Http\Controllers\Sources\OnlineStatisticController;
use App\Http\Controllers\Sources\ProcessedCallsReportController;
use App\Http\Controllers\Sources\QuotasReportController;
use App\Http\Controllers\Sources\ServiceReportController;
use App\Http\Controllers\Sources\SimpleRecordsController;
use App\Http\Controllers\Sources\StatReportController;
use Illuminate\Support\Facades\Route;

final class SourcesRoutesProvider
{
    public function __construct()
    {
    }

    public function register()
    {
        Route::get('home', DashboardController::class);
        Route::get('about', AboutController::class);
        Route::prefix('records')->group(function () {
            Route::get('simple', SimpleRecordsController::class);
            Route::get('advanced', AdvancedRecordsController::class);
        });
        Route::prefix('reports')->group(function () {
            Route::get('balance', BalanceReportController::class);
            Route::get('processed-calls', ProcessedCallsReportController::class);
            Route::get('quotas', QuotasReportController::class);
            Route::get('service', ServiceReportController::class);
            Route::get('stat', StatReportController::class);
        });
        Route::prefix('statistic')->group(function () {
            Route::get('online', OnlineStatisticController::class);
            Route::get('efficiency', EfficiencyStatisticController::class);
        });
    }

}

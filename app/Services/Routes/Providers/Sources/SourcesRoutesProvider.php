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
    public function register()
    {
        Route::group([
            'middleware' => ['locale','auth','log']
        ], function () {
            Route::get('/', function () {
                return redirect(SourcesRoutes::SOURCES_DASHBOARD);
            });
            Route::get('records', function () {
                return redirect(SourcesRoutes::SOURCES_SIMPLE_RECORDS);
            });
            Route::get('reports', function () {
                return redirect(SourcesRoutes::SOURCES_REPORT_STAT);
            });
            Route::get('statistic', function () {
                return redirect(SourcesRoutes::SOURCES_STATISTIC_ONLINE);
            });
            Route::get('home', DashboardController::class);
            Route::get('about', AboutController::class);
            Route::prefix('records')->group(function () {
                Route::get('simple', [SimpleRecordsController::class, 'view'])->name( SourcesRoutes::SOURCES_SIMPLE_RECORDS);
                Route::post('simple/get', [SimpleRecordsController::class, 'records'])->name( SourcesRoutes::SOURCES_SIMPLE_GET_RECORDS);
                Route::get('advanced', [AdvancedRecordsController::class, 'view'])->name( SourcesRoutes::SOURCES_ADVANCED_RECORDS);

            });
            Route::prefix('reports')->group(function () {
                Route::get('balance', [BalanceReportController::class, 'view'])->name( SourcesRoutes::SOURCES_REPORT_BALANCE);
                Route::get('processed-calls', [ProcessedCallsReportController::class, 'view'])->name( SourcesRoutes::SOURCES_REPORT_PROCESSED_CALLS);
                Route::get('quotas', [QuotasReportController::class, 'view'])->name( SourcesRoutes::SOURCES_REPORT_QUOTAS);
                Route::get('service', [ServiceReportController::class, 'view'])->name( SourcesRoutes::SOURCES_REPORT_SERVICE);
                Route::get('stat', [StatReportController::class, 'view'])->name( SourcesRoutes::SOURCES_REPORT_STAT);
            });
            Route::prefix('statistic')->group(function () {
                Route::get('online', [OnlineStatisticController::class, 'view'])->name( SourcesRoutes::SOURCES_STATISTIC_ONLINE);
                Route::get('efficiency', [EfficiencyStatisticController::class, 'view'])->name( SourcesRoutes::SOURCES_STATISTIC_EFFICIENCY);
            });
        });
    }

}

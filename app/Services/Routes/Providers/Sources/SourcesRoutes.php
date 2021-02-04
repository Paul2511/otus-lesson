<?php


namespace App\Services\Routes\Providers\Sources;


abstract class SourcesRoutes
{
    const SOURCES_DASHBOARD = 'home';
    const SOURCES_ABOUT = 'about';

    const SOURCES_SIMPLE_RECORDS = 'records/simple';
    const SOURCES_SIMPLE_GET_RECORDS = 'records/simple/get';
    const SOURCES_ADVANCED_RECORDS = 'records/advanced';

    const SOURCES_STATISTIC_ONLINE = 'statistic/online';
    const SOURCES_STATISTIC_EFFICIENCY = 'statistic/efficiency';

    const SOURCES_REPORT_BALANCE = 'reports/balance';
    const SOURCES_REPORT_PROCESSED_CALLS = 'reports/processed-calls';
    const SOURCES_REPORT_QUOTAS = 'reports/quotas';
    const SOURCES_REPORT_SERVICE = 'reports/service';
    const SOURCES_REPORT_STAT = 'reports/stat';
    const SOURCES_REPORT_CALLS = 'reports/calls';

}

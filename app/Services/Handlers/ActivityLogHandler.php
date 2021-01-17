<?php

namespace App\Services\Handlers;

use Illuminate\Support\Facades\Log;

class ActivityLogHandler
{
    static function handle()
    {
        $context = RequestParserHandler::handle();
        Log::channel('daily')->info($context['Controller'],$context);
    }

}

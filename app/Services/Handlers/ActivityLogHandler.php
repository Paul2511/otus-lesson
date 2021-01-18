<?php

namespace App\Services\Handlers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class ActivityLogHandler
{
    private RequestParserHandler $requestParserHandler;

    public function __construct(RequestParserHandler $requestParserHandler)
    {
        $this->requestParserHandler = $requestParserHandler;
    }
    public function handle(Request $request)
    {
        $context = $this->requestParserHandler->handle($request);
        Log::channel('daily')->info($context['Controller'],$context);
    }

}

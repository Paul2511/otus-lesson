<?php


namespace App\Services\Helpers;

use Illuminate\Support\Facades\Log;
use Throwable;

class RequestLogger
{
    /**
     * @var RequestParser
     */
    private RequestParser $requestParser;

    public function __construct
    (
        RequestParser $requestParser
    )
    {
        $this->requestParser = $requestParser;
    }

    static function addlog()
    {
        // Request parser
        $context = RequestParser::parse();
        // Daily log message
        Log::channel('daily')->debug($context['Controller'], $context);
    }


}
<?php

namespace App\Exceptions;

use Error;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * @param int             $eventLevel
     * @param Exception|Error $e
     */
    private function reportEvent(int $eventLevel, $e)
    {
        switch ($eventLevel) {
            case E_ERROR:
                $methodName = 'error';
                $channelName = 'slackErr';
                break;
            case E_WARNING:
                $methodName = 'warning';
                $channelName = 'slackWarn';
                break;
            case E_NOTICE:
                $methodName = 'notice';
                $channelName = 'slack';
                break;

            default:
                $methodName = 'info';
                $channelName = 'slack';
                break;
        }

        call_user_func(
            [Log::channel($channelName), $methodName],
            $e->getMessage(),
            [
                'exception' => $e,
            ]
        );
    }

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Error $e) {
            $this->reportEvent(E_ERROR, $e);
        })->stop();

        $this->reportable(function (Exception $e) {
            $level = is_callable([$e, 'getSeverity']) ? $e->getSeverity() : E_WARNING;
            $this->reportEvent($level, $e);
        })->stop();
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\Handlers\ActivityLogHandler;

class ActivityLog
{
    private function getActivityLogHandler(): ActivityLogHandler{
        return app(ActivityLogHandler::class);
    }

    public function handle(Request $request, Closure $next)
    {
        $this->getActivityLogHandler()->handle($request);
        return $next($request);
    }
}

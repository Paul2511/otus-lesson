<?php

namespace App\Http\Controllers\Admin\Queues;

use App\Http\Controllers\Controller;
use App\Services\Queues\QueuesService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdminQueuesController extends Controller
{
    private QueuesService $queuesService;
    public function __construct(
        QueuesService $queuesService
    )
    {
        $this->queuesService = $queuesService;
    }


    public function __invoke():JsonResponse
    {
        $queues = $this->queuesService->getAllQueues();
        return response()->json(['queues'=>$queues]);
    }

}

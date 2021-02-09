<?php

namespace App\Jobs;

use App\Services\Reports\ReportCallsService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ReportCallsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    private function getReportCallsService():ReportCallsService
    {
        return app(ReportCallsService::class);
    }

    public function handle()
    {
        $this->getReportCallsService()->getReport($this->data);
    }
}

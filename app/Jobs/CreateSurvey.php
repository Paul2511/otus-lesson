<?php

namespace App\Jobs;

use App\Services\Surveys\Handlers\CreateSurveyHandler;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateSurvey implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    private array $data;

    /**
     * Create a new job instance.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function getCreateSurveyHandler(): CreateSurveyHandler
    {
        return app(CreateSurveyHandler::class);
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->getCreateSurveyHandler()->handle($this->data);
    }
}

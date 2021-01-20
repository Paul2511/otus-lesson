<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
class LogJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var string
     */
    private $channel;
    /**
     * @var string
     */
    private $level;
    /**
     * @var string
     */
    private $message;
    /**
     * @var array
     */
    private $context;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $channel, string $level, string $message, array $context)
    {
        $this->channel = $channel;
        $this->level = $level;
        $this->message = $message;
        $this->context = $context;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::channel($this->channel)->log($this->level, $this->message, $this->context);
    }
}

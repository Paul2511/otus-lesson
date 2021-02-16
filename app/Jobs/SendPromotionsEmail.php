<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Services\Promotions\Handlers\CreatePromotionHandler;

class SendPromotionsEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private array $data;
    
    public function __construct(
        array $data
    )
    {
        $this->data = $data;
    }

    private function getCreatePromotionHanler(): CreatePromotionHandler
    {
        app(CreatePromotionHandler::class);
    }
    public function handle(): void
    {
        $this->getCreatePromotionHanler()->handle($this->data);
    }
}

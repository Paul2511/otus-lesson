<?php

namespace App\Logging;

use Illuminate\Log\Logger;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\SlackWebhookHandler;

class SlackCustomFormatter
{
    public function __invoke(Logger $logger):void
    {
        foreach ($logger->getHandlers() as $handler) {
            if ($handler instanceof SlackWebhookHandler) {
                $handler->getSlackRecord()->useAttachment(false);
                $handler->setFormatter(new LineFormatter('%channel% %level_name%: %message%'));
            }
        }
    }
}

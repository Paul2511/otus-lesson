<?php

namespace App\Listeners\PetType;

use App\Events\Pet\PetEvent;
use App\Events\PetType\PetTypeEvent;
use App\Models\Translate;
use App\Services\Translates\TranslateService;
use Support\Cache\CacheHelper;
use App\Models\Pet;

class PetTypeDeleteListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    protected function getTranslateService(): TranslateService
    {
        return app(TranslateService::class);
    }

    public function handle(PetTypeEvent $event)
    {
        $service = $this->getTranslateService();
        $event->getPetType()->translates()->each(function (Translate $translate) use ($service) {
            $service->delete($translate);
        });
    }
}

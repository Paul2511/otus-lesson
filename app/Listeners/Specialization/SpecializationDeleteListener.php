<?php

namespace App\Listeners\Specialization;

use App\Events\Specialization\SpecializationEvent;
use App\Models\Translate;
use App\Services\Translates\TranslateService;

class SpecializationDeleteListener
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

    public function handle(SpecializationEvent $event)
    {
        $service = $this->getTranslateService();
        $event->getSpecialization()->translates()->each(function (Translate $translate) use ($service) {
            $service->delete($translate);
        });
    }
}

<?php

namespace App\Listeners\Pet;

use App\Events\Pet\PetEvent;
use App\Helpers\CacheHelper;
use App\Models\Pet;

class PetCacheClear
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

    public function handle(PetEvent $event)
    {
        $pet = $event->getPet();
        $petId = $pet->id;
        $key = CacheHelper::getKey(Pet::$modelName, $petId);
        Pet::flushCache($key);

        $key = CacheHelper::getKey(Pet::$modelName.'s', $pet->client_id);
        Pet::flushCache($key);
    }
}

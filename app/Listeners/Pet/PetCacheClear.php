<?php

namespace App\Listeners\Pet;

use App\Events\Pet\PetEvent;
use Support\Cache\CacheHelper;
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
        if (CacheHelper::isCacheEnabled()) {
            $pet = $event->getPet();
            $petId = $pet->id;
            $key = CacheHelper::getKey(class_basename(Pet::class), $petId);
            Pet::flushCache($key);

            $key = CacheHelper::getKey(\Str::plural(class_basename(Pet::class)), $pet->client_id);
            Pet::flushCache($key);
        }

    }
}

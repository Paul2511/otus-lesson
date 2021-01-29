<?php


namespace App\Services\PetTypes\Repositories;

use App\Models\PetType;
use Illuminate\Database\Eloquent\Collection;
use Support\Cache\CacheHelper;

class PetTypeRepository
{
    public function getAll(?bool $fromCache=false): Collection
    {
        return $fromCache ?
            CacheHelper::remember(PetType::query(), class_basename(Pet::class))->get()->all() :
            PetType::all();
    }
}
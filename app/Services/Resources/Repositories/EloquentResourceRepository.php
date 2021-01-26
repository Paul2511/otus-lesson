<?php


namespace App\Services\Resources\Repositories;


use App\Models\Resource;
use Illuminate\Database\Eloquent\Collection;

class EloquentResourceRepository
{
    const CACHE_TTL = 60*60*24;
    const CACHE_TAG = 'resources';

    public function getList(array $with = []): Collection
    {
        return Resource::remember(self::CACHE_TTL)->cacheTags(self::CACHE_TAG)->whereIsActive(1)->get()->keyBy('id');
    }

}

<?php


namespace App\Services\Resources\Repositories;


use App\Models\Resource;
use Illuminate\Database\Eloquent\Collection;

class EloquentResourceRepository
{

    public function getList(array $with = []): Collection
    {
        return Resource::whereIsActive(1)->get()->keyBy('id');
    }

}

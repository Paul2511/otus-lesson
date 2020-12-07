<?php


namespace App\Services\Surveys\Repositories;


use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;


class EloquentBaseRepository
{
    const DEFAULT_PER_PAGE_COUNT = 25;

    public function paginate(Builder $query, ?int $perPage = null): LengthAwarePaginator
    {
        return $query->paginate($perPage ?? static::DEFAULT_PER_PAGE_COUNT);
    }

}
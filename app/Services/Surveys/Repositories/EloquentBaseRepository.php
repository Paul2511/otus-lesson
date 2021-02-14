<?php


namespace App\Services\Surveys\Repositories;


use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;


class EloquentBaseRepository
{
    public const DEFAULT_PER_PAGE_COUNT = 25;
    public const MAX_API_RESPONSE_SIZE = 250;

    public function paginate(Builder $query, ?int $perPage = null): LengthAwarePaginator
    {
        return $query->paginate($perPage ?? static::DEFAULT_PER_PAGE_COUNT);
    }

    public function applyFilters(Builder $query, array $filters)
    {
        foreach ($filters as $filter) {
            [$column, $condition, $value] = $filter;
            if ($column && $condition && $value) {
                $query->where($column, $condition, $value);
            }
        }
    }
}

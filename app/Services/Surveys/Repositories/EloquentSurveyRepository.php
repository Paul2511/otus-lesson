<?php

namespace App\Services\Surveys\Repositories;

use App\Models\Survey;
use App\Models\User;
use Auth;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;


class EloquentSurveyRepository extends EloquentBaseRepository
{
    public const DEFAULT_CACHE_TIME = 36000;

    public function searchForCurrentUser(?int $perPage = null): LengthAwarePaginator
    {
        $user = Auth::user();
        if (!$user) {
            abort(403);
        }

        if ($user->can('viewTotallyAny', Survey::class)) {
            return $this->search($perPage);
        }

        return $this->searchByUserId($user->id, $perPage);
    }

    public function searchByUserId(int $userId, ?int $perPage = null): LengthAwarePaginator
    {
        /** @noinspection PhpUndefinedMethodInspection */
        $query = Survey::query()->remember(static::DEFAULT_CACHE_TIME);

        $query->where('user_id', '=', $userId);

        return $this->paginate($query, $perPage);
    }

    public function search(?int $perPage = null): LengthAwarePaginator
    {
        $query = Survey::query()->remember(static::DEFAULT_CACHE_TIME);

        return $this->paginate($query, $perPage);
    }

    public function findById(int $id): Survey
    {
        return Survey::find($id)->remember(static::DEFAULT_CACHE_TIME)->get();
    }

    public function store(array $data): Survey
    {
        $user = Auth::user();
        if (!$user) {
            abort(403);
        }

        $survey = new Survey($data);

        $survey->user()->associate($user);

        $survey->save();

        return $survey;
    }

    public function update(Survey $survey, array $data): Survey
    {
        // TODO: Переделать на работу с DTO
        $survey->update($data);

        return $survey;
    }

    public function delete(Survey $survey): ?bool
    {
        return $survey->delete();
    }

    public function getAll(array $filters = [], ?int $limit = null, ?int $offset = 0): Collection
    {
        $limit = min($limit, static::MAX_API_RESPONSE_SIZE);

        /** @noinspection PhpUndefinedMethodInspection */
        $query = Survey::query()->remember(static::DEFAULT_CACHE_TIME);
        $this->applyFilters($query, $filters);
        $query->take($limit);
        $offset && $query->skip($offset);

        return $query->get();
    }
}

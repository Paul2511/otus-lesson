<?php


namespace App\Services\Surveys\Repositories;


use App\Models\Survey;
use App\Models\User;
use Auth;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;


class EloquentSurveyRepository extends EloquentBaseRepository
{

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
        $query = Survey::query();

        $query->where('user_id', '=', $userId);

        return $this->paginate($query, $perPage);
    }

    public function search(?int $perPage = null): LengthAwarePaginator
    {
        $query = Survey::query();

        return $this->paginate($query, $perPage);
    }

    public function findById(int $id): Survey
    {
        return Survey::find($id)->get();
    }

    public function store(array $data): Survey
    {
        $user = $data['_user'] ?? Auth::user();

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

    public function delete(Survey $survey)
    {
        $survey->delete();
    }

}

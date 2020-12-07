<?php


namespace App\Services\Surveys\Repositories;


use App\Models\Survey;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;


class EloquentSurveyRepository extends EloquentBaseRepository
{

    public function searchByUserId(int $userId, ?int $perPage): LengthAwarePaginator
    {
        $query = Survey::query();

        $query->where('user_id', '=', $userId);

        return $this->paginate($query, $perPage);
    }

    public function search(?int $perPage): LengthAwarePaginator
    {
        $query = Survey::query();

        return $query::paginate($query, $perPage);
    }

    public function findById(int $id): Survey
    {
        return Survey::find($id)->get();
    }

    public function createNew(): Survey
    {
        return new Survey;
    }

    public function store(array $data): Survey
    {
        $survey = new Survey($data);

        // TODO: реализовать работу с юзерами
        $survey->user()->associate(User::first());

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
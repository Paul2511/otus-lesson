<?php


namespace App\Services\Surveys\Repositories;


use App\Models\Question;
use App\Models\Survey;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;


class EloquentQuestionRepository extends EloquentBaseRepository
{

    const DEFAULT_CACHE_TIME = 36000;

    public function searchBySurveyId(int $userId, ?int $perPage = null): LengthAwarePaginator
    {
        $query = Question::query()->remember(static::DEFAULT_CACHE_TIME);

        $query->where('survey_id', '=', $userId);

        return $this->paginate($query, $perPage);
    }

    public function search(?int $perPage): LengthAwarePaginator
    {
        $query = Question::query()->remember(static::DEFAULT_CACHE_TIME);

        return $query::paginate($query, $perPage);
    }

    public function findBySurveyOrFail(Survey $survey, int $id): Question
    {
        return $this->findBySurveyIdOrFail($survey->id, $id);
    }

    public function findBySurveyIdOrFail(int $surveyId, int $id): Question
    {
        return Question::whereId($id)
            ->remember(static::DEFAULT_CACHE_TIME)
            ->whereSurveyId($surveyId)
            ->firstOrFail();
    }

    public function findById(int $id): Question
    {
        return Question::find($id)
            ->remember(static::DEFAULT_CACHE_TIME)
            ->get();
    }

    public function store(array $data, Survey $survey): Question
    {
        $question = new Question($data);
        $question->survey()->associate($survey);
        $question->save();

        return $question;
    }

    public function update(Question $question, array $data): Question
    {
        $question->update($data);

        return $question;
    }

    public function delete(Question $question)
    {
        $question->delete();
    }

}

<?php

namespace App\Services\Surveys;

use App\Models\Survey;
use App\Services\Surveys\Handlers\CreateSurveyHandler;
use App\Services\Surveys\Repositories\EloquentSurveyRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;


class SurveysService
{
    public EloquentSurveyRepository $eloquentSurveyRepository;
    private CreateSurveyHandler     $createSurveyHandler;

    public function __construct(
        EloquentSurveyRepository $eloquentSurveyRepository,
        CreateSurveyHandler $createSurveyHandler
    ) {
        $this->eloquentSurveyRepository = $eloquentSurveyRepository;
        $this->createSurveyHandler = $createSurveyHandler;
    }

    public function createFromArray(array $data): Survey
    {
        return $this->createSurveyHandler->handle($data);
    }

    public function searchForCurrentUser(?int $perPage = null): LengthAwarePaginator
    {
        return $this->eloquentSurveyRepository->searchForCurrentUser($perPage);
    }

    public function getAll(?int $limit = null, ?int $offset = 0): Collection
    {
        return $this->eloquentSurveyRepository->getAll([], $limit, $offset);
    }

    public function update(Survey $survey, array $data): Survey
    {
        return $this->eloquentSurveyRepository->update($survey, $data);
    }

    public function delete(Survey $survey): ?bool
    {
        return $this->eloquentSurveyRepository->delete($survey);
    }
}

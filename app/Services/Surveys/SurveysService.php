<?php

namespace App\Services\Surveys;

use App\Jobs\CreateSurvey;
use App\Models\Survey;
use App\Services\Surveys\Handlers\CreateSurveyHandler;
use App\Services\Surveys\Repositories\EloquentSurveyRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;


class SurveysService
{
    public EloquentSurveyRepository $eloquentSurveyRepository;
    private CreateSurveyHandler $createSurveyHandler;

    public function __construct(
        EloquentSurveyRepository $eloquentSurveyRepository,
        CreateSurveyHandler $createSurveyHandler
    ) {
        $this->eloquentSurveyRepository = $eloquentSurveyRepository;
        $this->createSurveyHandler = $createSurveyHandler;
    }

    public function createFromArray(array $data)
    {
        CreateSurvey::dispatch($data);
    }

    public function searchForCurrentUser(?int $perPage = null): LengthAwarePaginator
    {
        return $this->eloquentSurveyRepository->searchForCurrentUser($perPage);
    }
}

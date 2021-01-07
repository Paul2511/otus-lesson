<?php


namespace App\Services\Surveys\Handlers;


use App\Models\Survey;
use App\Services\Surveys\Repositories\EloquentSurveyRepository;


class CreateSurveyHandler
{

    private EloquentSurveyRepository $eloquentSurveyRepository;

    public function __construct(EloquentSurveyRepository $eloquentSurveyRepository)
    {
        $this->eloquentSurveyRepository = $eloquentSurveyRepository;
    }

    public function handle(array $data): Survey
    {
        return $this->eloquentSurveyRepository->store($data);
    }

}
<?php


namespace App\Services\Surveys\Handlers;


use App\Models\Question;
use App\Models\Survey;
use App\Services\Surveys\Repositories\EloquentQuestionRepository;


class CreateQuestionHandler
{

    private EloquentQuestionRepository $eloquentQuestionRepository;

    public function __construct(EloquentQuestionRepository $eloquentQuestionRepository)
    {
        $this->eloquentQuestionRepository = $eloquentQuestionRepository;
    }

    public function handle(array $data, Survey $survey): Question
    {
        return $this->eloquentQuestionRepository->store($data, $survey);
    }

}
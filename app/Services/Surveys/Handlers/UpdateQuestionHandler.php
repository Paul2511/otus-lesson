<?php


namespace App\Services\Surveys\Handlers;


use App\Models\Question;
use App\Models\Survey;
use App\Services\Surveys\Repositories\EloquentQuestionRepository;


class UpdateQuestionHandler
{

    private EloquentQuestionRepository $eloquentQuestionRepository;

    public function __construct(EloquentQuestionRepository $eloquentQuestionRepository)
    {
        $this->eloquentQuestionRepository = $eloquentQuestionRepository;
    }

    public function handle(Question $question, array $data): Question
    {
        return $this->eloquentQuestionRepository->update($question, $data);
    }

}
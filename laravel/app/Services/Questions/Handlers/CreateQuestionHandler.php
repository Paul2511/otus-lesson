<?php


namespace App\Services\Questions\Handlers;


use App\Models\Question;
use App\Services\Questions\DTO\CreateQuestionDTO;
use App\Services\Questions\Repositories\EloquentQuestionRepository;

class CreateQuestionHandler
{

    private EloquentQuestionRepository $repository;

    public function __construct(EloquentQuestionRepository $repository)
    {
        $this->repository = $repository;
    }


    public function handle(CreateQuestionDTO $dto): Question
    {
        $question = $this->repository->createFromDTO($dto);
        $this->repository
            ->saveTranslations($question, $dto)
            ->saveCategories($question, $dto);
        return $question;
    }



}

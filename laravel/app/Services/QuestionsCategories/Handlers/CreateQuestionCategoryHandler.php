<?php


namespace App\Services\QuestionsCategories\Handlers;


use App\Models\QuestionCategory;
use App\Services\QuestionsCategories\DTO\CreateQuestionCategoryDTO;
use App\Services\QuestionsCategories\Repositories\EloquentQuestionCategoryRepository;

class CreateQuestionCategoryHandler
{

    private EloquentQuestionCategoryRepository $repository;

    public function __construct(EloquentQuestionCategoryRepository $repository)
    {
        $this->repository = $repository;
    }


    public function handle(CreateQuestionCategoryDTO $dto): QuestionCategory
    {
        $question = $this->repository->createFromDTO($dto);
        $this->repository
            ->saveTranslations($question, $dto);
        return $question;
    }



}

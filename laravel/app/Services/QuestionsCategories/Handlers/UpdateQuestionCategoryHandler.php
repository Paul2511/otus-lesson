<?php


namespace App\Services\QuestionsCategories\Handlers;


use App\Models\QuestionCategory;
use App\Services\QuestionsCategories\DTO\UpdateQuestionCategoryDTO;
use App\Services\QuestionsCategories\Repositories\EloquentQuestionCategoryRepository;

class UpdateQuestionCategoryHandler
{

    private EloquentQuestionCategoryRepository $repository;

    public function __construct(EloquentQuestionCategoryRepository $eloquentQuestionRepository)
    {
        $this->repository = $eloquentQuestionRepository;
    }


    public function handle(QuestionCategory $question, UpdateQuestionCategoryDTO $dto): QuestionCategory
    {

        $this->repository
            ->updateTitle($question, $dto)
            ->updateFromDTO($question, $dto)
            ->updateParentCategory($question, $dto);
        return $question;
    }



}

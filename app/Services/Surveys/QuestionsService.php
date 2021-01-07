<?php


namespace App\Services\Surveys;


use App\Models\Question;
use App\Models\Survey;
use App\Models\User;
use App\Services\Surveys\Handlers\CreateQuestionHandler;
use App\Services\Surveys\Handlers\UpdateQuestionHandler;
use App\Services\Surveys\Repositories\EloquentQuestionRepository;


class QuestionsService
{

    public EloquentQuestionRepository $eloquentQuestionRepository;
    private CreateQuestionHandler     $createQuestionHandler;
    /**
     * @var UpdateQuestionHandler
     */
    private UpdateQuestionHandler $updateQuestionHandler;

    public function __construct(
        EloquentQuestionRepository $eloquentQuestionRepository,
        CreateQuestionHandler $createQuestionHandler,
        UpdateQuestionHandler $updateQuestionHandler
    ) {
        $this->eloquentQuestionRepository = $eloquentQuestionRepository;
        $this->createQuestionHandler = $createQuestionHandler;
        $this->updateQuestionHandler = $updateQuestionHandler;
    }

    public function createFromArray(array $data, Survey $survey): Question
    {
        return $this->createQuestionHandler->handle($data, $survey);
    }

    public function updateFromArray(Question $question, array $data): Question
    {
        return $this->updateQuestionHandler->handle($question, $data);
    }

    public function updateByIdFromArray(Survey $survey, int $questionId, array $data): Question
    {
        $question = $this->eloquentQuestionRepository->findBySurveyOrFail($survey, $questionId);

        return $this->updateFromArray($question, $data);
    }

    public function checkIfUserOwnsQuestion(User $user, Question $question): bool
    {
        dd($question);
    }

}

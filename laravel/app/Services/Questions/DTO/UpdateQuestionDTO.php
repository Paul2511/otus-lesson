<?php


namespace App\Services\Questions\DTO;


class UpdateQuestionDTO implements DTOInterface
{
    private array $question_category_id;
    private array $title;
    private int $status;
    private array $answer;

    public function __construct(
        array $question_category_id,
        array $title,
        int $status,
        array $answer
    )
    {
        $this->question_category_id = $question_category_id;
        $this->title = $title;
        $this->status = $status;
        $this->answer = $answer;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['question_category_id'] ?? [],
            $data['title'],
            $data['status'],
            $data['answer']
        );
    }

    public function toArray(): array
    {
        return [
            'question_category_id' => $this->question_category_id,
            'title' => $this->title,
            'status' => $this->status,
            'answer' => $this->answer,
        ];
    }

}

<?php


namespace App\Services\Questions\DTO;


class CreateQuestionDTO implements DTOInterface
{
    private array $question_category_id;
    private array $title;
    private int $status;

    public function __construct(
        array $question_category_id,
        array $title,
        int $status
    )
    {
        $this->question_category_id = $question_category_id;
        $this->title = $title;
        $this->status = $status;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['question_category_id'] ?? [],
            $data['title'],
            $data['status']
        );
    }

    public function toArray(): array
    {
        return [
            'question_category_id' => $this->question_category_id,
            'title' => $this->title,
            'status' => $this->status,
        ];
    }

}

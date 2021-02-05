<?php


namespace App\Services\QuestionsCategories\DTO;


class CreateQuestionCategoryDTO implements DTOInterface
{


    private ?int $parent_id;
    private array $title;

    public function __construct(
        ?int $parent_id,
        array $title
    )
    {
        $this->parent_id = $parent_id;
        $this->title = $title;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['parent_id'] ?? null,
            $data['title'],
        );
    }

    public function toArray(): array
    {
        return [
            'parent_id' => $this->parent_id,
            'title' => $this->title,
        ];
    }

}

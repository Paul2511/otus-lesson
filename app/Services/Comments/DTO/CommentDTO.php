<?php


namespace App\Services\Comments\DTO;

use App\Http\Requests\Comment\CommentRequest;
use Spatie\DataTransferObject\DataTransferObject;
class CommentDTO extends DataTransferObject
{
    public string $type;

    public int $row_id;

    public ?int $user_id;

    public string $body;

    protected bool $ignoreMissing = true;

    public static function fromRequest(CommentRequest $request)
    {
        $result = [
            'type' => $request->get('type'),
            'row_id' => $request->get('row_id'),
            'body' => $request->get('body'),
        ];

        return new self($result);
    }

    public static function fromArray(array $data): self
    {
        return new self($data);
    }
}
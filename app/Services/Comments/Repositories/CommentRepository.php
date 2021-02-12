<?php


namespace App\Services\Comments\Repositories;

use App\Http\Requests\ApiGetRequest;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Collection;
abstract class CommentRepository
{
    abstract public function findById(int $id): Comment;

    /**
     * @return Comment[]|\Illuminate\Database\Eloquent\Builder[]|Collection|mixed
     */
    abstract public function get();

    abstract public function create(array $data): Comment;

    abstract public function update(Comment $comment, array $data): bool;

    /** @return bool|null */
    abstract public function delete(Comment $comment);

    /**
     * @var ApiGetRequest
     */
    protected $request;

    /**
     * @var Comment|\Illuminate\Database\Eloquent\Builder
     */
    protected $query;

    protected $tag;

    public function __construct(ApiGetRequest $request)
    {
        $this->request = $request;
        $this->tag = \Str::plural(class_basename(Comment::class));

        $this->query = Comment::query();
    }
}
<?php


namespace App\Services\Comments\Repositories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Collection;
class EloquentCommentRepository extends CommentRepository
{

    public function findById(int $id): Comment
    {
        return Comment::findOrFail($id);
    }

    /**
     * @return Comment[]|\Illuminate\Database\Eloquent\Builder[]|Collection
     */
    public function get()
    {
        return $this->query->get();
    }

    public function create(array $data): Comment
    {
        $data = collect($data)->whereNotNull()->all();

        return Comment::create($data);
    }

    /**
     * @return bool|null
     * @throws \Exception
     */
    public function delete(Comment $comment)
    {
        return $comment->delete();
    }

    public function update(Comment $comment, array $data): bool
    {
        $data = collect($data)->whereNotNull()->all();

        return $comment->update($data);
    }
}
<?php


namespace App\Services\Comments\Handlers;


use App\Exceptions\Comment\CommentDeleteException;
use App\Models\Comment;
use App\Services\Comments\Repositories\CommentRepository;

class CommentDeleteHandler
{
    /**
     * @var CommentRepository
     */
    private $repository;

    public function __construct(CommentRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @throws CommentDeleteException
     */
    public function handle(Comment $comment): void
    {
        try {
            $this->repository->delete($comment);
        } catch (\Throwable $e) {
            throw new CommentDeleteException($e->getMessage());
        }
    }
}
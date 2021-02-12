<?php


namespace App\Services\Comments;


use App\Exceptions\Comment\CommentCreateException;
use App\Exceptions\Comment\CommentDeleteException;
use App\Exceptions\Comment\CommentUpdateException;
use App\Models\Comment;
use App\Models\User;
use App\Services\Comments\DTO\CommentDTO;
use App\Services\Comments\Handlers\CommentDeleteHandler;
use App\Services\Comments\Repositories\CommentRepository;
use Support\Log\LogHelper;

class CommentService
{

    /**
     * @var CommentRepository
     */
    private $repository;
    /**
     * @var CommentDeleteHandler
     */
    private $deleteHandler;

    public function __construct(
        CommentRepository $repository,
        CommentDeleteHandler $deleteHandler
    )
    {
        $this->repository = $repository;
        $this->deleteHandler = $deleteHandler;
    }

    public function findById(int $id): Comment
    {
        return $this->repository->findById($id);
    }

    /**
     * @throws CommentCreateException
     */
    public function create(CommentDTO $createData): Comment
    {
        /** @var User $my */
        $my = auth()->user();
        $createData->user_id = $my->id;

        $data = $createData->toArray();

        \DB::beginTransaction();

        try {
            $comment = $this->repository->create($data);

            \DB::commit();

            return $comment;
        } catch (\Throwable $e) {
            LogHelper::slack("Ошибка создания комментария", [
                'userId'=>auth()->user()->getAuthIdentifier(),
                'error'=>$e->getMessage(),
                'comment'=>$data
            ]);
            throw new CommentCreateException($e->getMessage());
        }
    }

    /**
     * @throws CommentUpdateException
     */
    public function update(Comment $comment, CommentDTO $updateData): Comment
    {
        $data = $updateData->all();
        \DB::beginTransaction();

        try {
            $result = $this->repository->update($comment, $data);

            if (!$result) {
                throw new CommentUpdateException();
            }

            \DB::commit();

            $comment->refresh();

            return $comment;
        } catch (\Throwable $e) {
            LogHelper::slack("Ошибка обновления комментария #{$comment->id}", [
                'userId'=>auth()->user()->getAuthIdentifier(),
                'error'=>$e->getMessage(),
                'commentData'=>$data
            ]);

            throw new CommentUpdateException($e->getMessage());
        }
    }

    /**
     * @throws CommentDeleteException
     */
    public function delete(Comment $comment): void
    {
        \DB::beginTransaction();
        try {

            $this->deleteHandler->handle($comment);
            \DB::commit();
        } catch (\Throwable $e) {
            LogHelper::slack("Ошибка удаления комментария", [
                'userId' => auth()->user()->getAuthIdentifier(),
                'error' => $e->getMessage(),
                'commentId' => $comment->id
            ]);
            throw new CommentDeleteException($e->getMessage());
        }
    }

}
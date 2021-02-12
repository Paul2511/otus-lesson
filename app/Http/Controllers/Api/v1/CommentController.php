<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\CommentRequest;
use App\Http\Resources\Comment\CommentResource;
use App\Models\Comment;
use App\Services\Comments\DTO\CommentDTO;
use Illuminate\Http\JsonResponse;
use App\Services\Comments\CommentService;
use Illuminate\Http\Resources\Json\JsonResource;
class CommentController extends Controller
{
    /**
     * @var CommentService
     */
    private $commentService;

    public function __construct(
        CommentService $commentService
    )
    {
        $this->middleware('auth.jwt:api');
        $this->authorizeResource(Comment::class, 'comment');
        $this->commentService = $commentService;
    }

    /**
     * @throws \App\Exceptions\Comment\CommentCreateException
     */
    public function store(CommentRequest $request): JsonResponse
    {
        $data = CommentDTO::fromRequest($request);

        $comment = $this->commentService->create($data);

        $message = [
            'message'=>[
                'title'=>trans('form.message.successTitle'),
                'text'=>trans('form.message.successText')]
        ];

        return (new CommentResource($comment))
            ->additional($message)
            ->response()
            ->setStatusCode(self::JSON_STATUS_CREATED);
    }

    /**
     * @throws \App\Exceptions\Comment\CommentUpdateException
     */
    public function update(CommentRequest $request, Comment $comment): JsonResponse
    {
        $data = CommentDTO::fromRequest($request);

        $comment = $this->commentService->update($comment, $data);

        $message = [
            'message'=>[
                'title'=>trans('form.message.successTitle'),
                'text'=>trans('form.message.successText')]
        ];

        return (new CommentResource($comment))
            ->additional($message)
            ->response()
            ->setStatusCode(self::JSON_STATUS_ACCEPTED);
    }

    /**
     * @throws \App\Exceptions\Comment\CommentDeleteException
     */
    public function destroy(Comment $comment): JsonResponse
    {
        $this->commentService->delete($comment);

        $message = [
            'message'=>[
                'title'=>trans('form.message.successDeleteTitle'),
                'text'=>trans('form.message.successDeleteText')]
        ];

        return response()->json($message);
    }
}

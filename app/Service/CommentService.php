<?php
namespace App\Service;
use App\Service\Handlers\{CreateCommentHandler, UpdateCommentHandler, DeleteCommentHandler};

class TodoService{
	protected $createCommentHandler;
    protected $updateCommentHandler;
    protected $deleteCommentHandler;

	public function __construct(CreateCommentHandler $createCommentHandler, UpdateCommentHandler $updateCommentHandler, DeleteCommentHandler $deleteCommentHandler)
	{
        $this->createCommentHandler = $createCommentHandler;
        $this->updateCommentHandler = $updateCommentHandler;
        $this->deleteCommentCommentHandler = $deleteCommentHandler;
	}

	public createComment($request)
	{
		$this->createCommentHandler->handle($request);
	}
	
	public updateTodo($request, $id)
	{
		$this->updateCommentHandler->handle($request, $id);
	}
	
	public deleteTodo($id)
	{
		$this->deleteCommentHandler->handle($id);
	}
	
	public giveMeAllTodo()
	{
		return $this->giveMeAllCommentHandler->handle();
	}

	public giveMeTodo($id)
	{
		return $this->giveMeCommentHandler->handle($id);
	}
}
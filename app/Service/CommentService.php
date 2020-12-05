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

	public function createComment($request)
	{
		$this->createCommentHandler->handle($request);
	}
	
	public function updateTodo($request, $id)
	{
		$this->updateCommentHandler->handle($request, $id);
	}
	
	public function deleteTodo($id)
	{
		$this->deleteCommentHandler->handle($id);
	}
	
	public function giveMeAllTodo()
	{
		return $this->giveMeAllCommentHandler->handle();
	}

	public function giveMeTodo($id)
	{
		return $this->giveMeCommentHandler->handle($id);
	}
}
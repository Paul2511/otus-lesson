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

	public function createComment($data)
	{
		$this->createCommentHandler->handle($data);
	}
	
	public function updateComment($data, $id)
	{
		$this->updateCommentHandler->handle($data, $id);
	}
	
	public function deleteComment($id)
	{
		$this->deleteCommentHandler->handle($id);
	}
}
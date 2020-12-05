<?php
namespace App\Service\Handlers;
use App\Models\Comment;
use App\Repositories\EloquentCommentRepository;

class DeleteCommentHandler implements HandlerInterface
{
	private $commentRepository;

	public function __construct(EloquentCommentRepository $commentRepository){
		$this->commentRepository = $commentRepository;
	}

    public function handle()
    {
    	return $this->commentRepository->delete($id);
    }
}
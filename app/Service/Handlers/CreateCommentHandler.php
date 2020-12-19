<?php
namespace App\Service\Handlers;
use App\Models\Comment;
use App\Repositories\EloquentCommentRepository;

class CreateCommentHandler implements HandlerInterface
{
	private $commentRepository;

	public function __construct(EloquentCommentRepository $commentRepository){
		$this->commentRepository = $commentRepository;
	}

    public function handle($data)
    {
    	return $this->commentRepository->create($data);
    }
}
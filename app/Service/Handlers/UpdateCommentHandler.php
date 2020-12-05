<?php
namespace App\Service\Handlers;
use App\Models\Comment;
use App\Repositories\EloquentCommentRepository;

class UpdateCommentHandler implements HandlerInterface
{
	private $commentRepository;

	public function __construct(EloquentCommentRepository $commentRepository){
		$this->commentRepository = $commentRepository;
	}

    public function handle(Request $request, $id)
    {
    	$data = $request->only($this->commentRepository->getModel()->fillable);
    	return $this->commentRepository->update($data, $id);
    }
}
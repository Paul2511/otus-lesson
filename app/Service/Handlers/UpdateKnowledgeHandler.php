<?php
namespace App\Service\Handlers;
use App\Models\Knowledge;
use App\Repositories\EloquentKnowledgeRepository;

class UpdateKnowledgeHandler implements HandlerInterface
{
	private $knowledgeRepository;

	public function __construct(EloquentKnowledgeRepository $knowledgeRepository){
		$this->knowledgeRepository = $knowledgeRepository;
	}

    public function handle(Request $request, $id)
    {
    	$data = $request->only($this->knowledgeRepository->getModel()->fillable);
    	return $this->knowledgeRepository->update($data, $id);
    }
}
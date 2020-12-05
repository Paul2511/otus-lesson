<?php
namespace App\Service\Handlers;
use App\Models\Knowledge;
use App\Repositories\EloquentKnowledgeRepository;

class GiveMeKnowledgeHandler implements HandlerInterface
{
	private $taskRepository;

	public function __construct(EloquentKnowledgeRepository $knowledgeRepository){
		$this->knowledgeRepository = $knowledgeRepository;
	}

    public function handle($id)
    {
    	return $this->knowledgeRepository->show($id);
    }
}
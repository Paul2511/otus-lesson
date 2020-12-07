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

    public function handle($data, $id)
    {
    	return $this->knowledgeRepository->update($data, $id);
    }
}
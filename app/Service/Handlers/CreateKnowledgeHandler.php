<?php
namespace App\Service\Handlers;
use App\Models\Knowledge;
use App\Repositories\EloquentKnowledgeRepository;

class CreateKnowledgeHandler implements HandlerInterface
{
	private $knowledgeRepository;

	public function __construct(EloquentKnowledgeRepository $knowledgeRepository){
		$this->knowledgeRepository = $knowledgeRepository;
	}

    public function handle($data)
    {
    	return $this->knowledgeRepository->create($data);
    }
}
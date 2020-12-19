<?php
namespace App\Service\Handlers;
use App\Models\Knowledge;
use App\Repositories\EloquentKnowledgeRepository;

class GiveMeAllKnowledgeHandler implements HandlerInterface
{
	private $knowledgeRepository;

	public function __construct(EloquentKnowledgeRepository $knowledgeRepository){
		$this->knowledgeRepository = $knowledgeRepository;
	}

    public function handle()
    {
    	return $this->knowledgeRepository->all();
    }
}
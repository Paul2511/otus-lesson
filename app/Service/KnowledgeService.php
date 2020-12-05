<?php
namespace App\Service;
use App\Service\Handlers\{CreateKnowledgeHandler, UpdateKnowledgeHandler, DeleteKnowledgeHandler, GiveMeKnowledgeHandler, GiveMeAllKnowledgeHandler};
class TaskService{
	protected $createKnowledgeHandler;
    protected $updateKnowledgeHandler;
    protected $deleteKnowledgeHandler;
    protected $giveMeKnowledgeHandler;
    protected $giveMeAllKnowledgeHandler;

	public function __construct(CreateKnowledgeHandler $createKnowledgeHandler, UpdateKnowledgeHandler $updateKnowledgeHandler, DeleteKnowledgeHandler $deleteKnowledgeHandler, GiveMeKnowledgeHandler $giveMeKnowledgeHandler, GiveMeAllKnowledgeHandler $giveMeAllKnowledgeHandler)
	{
        $this->createKnowledgeHandler = $createKnowledgeHandler;
        $this->updateKnowledgeHandler = $updateKnowledgeHandler;
        $this->deleteKnowledgeHandler = $deleteKnowledgeHandler;
        $this->giveMeKnowledgeHandler = $giveMeKnowledgeHandler;
        $this->giveMeAllKnowledgeHandler = $giveMeAllKnowledgeHandler;
	}

	public createKnowledge($request)
	{
		$this->createKnowledgeHandler->handle($request);
	}
	
	public updateKnowledge($request, $id)
	{
		$this->updateKnowledgeHandler->handle($request, $id);
	}
	
	public deleteKnowledge($id)
	{
		$this->deleteKnowledgeHandler->handle($id);
	}
	
	public giveMeAllKnowledge()
	{
		return $this->giveMeAllKnowledgeHandler->handle();
	}

	public giveMeKnowledge($id)
	{
		return $this->giveMeKnowledgeHandler->handle($id);
	}
}
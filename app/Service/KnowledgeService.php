<?php
namespace App\Service;
use App\Service\Handlers\{CreateKnowledgeHandler, UpdateKnowledgeHandler, DeleteKnowledgeHandler, GiveMeKnowledgeHandler, GiveMeAllKnowledgeHandler};
use Illuminate\Support\Facades\Cache;
class KnowledgeService{
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

	public function createKnowledge($data)
	{
		$this->createKnowledgeHandler->handle($data);
	}
	
	public function updateKnowledge($data, $id)
	{
		$this->updateKnowledgeHandler->handle($data, $id);
	}
	
	public function deleteKnowledge($id)
	{
		$this->deleteKnowledgeHandler->handle($id);
	}
	
	public function getKnowledges()
	{
		return $this->giveMeAllKnowledgeHandler->handle();
	}

	public function getKnowledge($id)
	{
		return $this->giveMeKnowledgeHandler->handle($id);
	}
	public function getCachedKnowledges(){
		return Cache::tags(["knowlegde"])->remember("knowledges", 3600 * 24, function(){
                return $this->getKnowledges();
        });
	}
	public function updateKnowledgeCache(){
		Cache::tags(["knowlegde"])->flush();
	}
}
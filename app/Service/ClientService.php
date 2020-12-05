<?php
namespace App\Service;
use App\Service\Handlers\{CreateClientHandler, UpdateClientHandler, DeleteClientHandler, GiveMeClientHandler, GiveMeAllClientHandler};
class UserService{
	protected $createClientHandler;
    protected $updateClientHandler;
    protected $deleteClientHandler;
    protected $giveMeClientHandler;
    protected $giveMeAllClientHandler;

	public function __construct(CreateClientHandler $createClientHandler, UpdateClientHandler $updateClientHandler, DeleteClientHandler $deleteClientHandler, GiveMeClientHandler $giveMeClientHandler, GiveMeAllClientHandler $giveMeAllClientHandler)
	{
        $this->createClientHandler = $createClientHandler;
        $this->updateClientHandler = $updateClientHandler;
        $this->deleteClientHandler = $deleteClientHandler;
        $this->giveMeClientHandler = $giveMeClientHandler;
        $this->giveMeAllClientHandler = $giveMeAllClientHandler;
	}

	public function createClient($request)
	{
		$this->createClientHandler->handle($request);
	}
	
	public function updateClient($request, $id)
	{
		$this->updateClientHandler->handle($request, $id);
	}
	
	public function deleteClient($id)
	{
		$this->deleteClientHandler->handle($id);
	}
	
	public function giveMeAllClient()
	{
		return $this->giveMeAllClientHandler->handle();
	}

	public function giveMeClient($id)
	{
		return $this->giveMeClientHandler->handle($id);
	}
}
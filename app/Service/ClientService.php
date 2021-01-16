<?php
namespace App\Service;
use App\Service\Handlers\{CreateClientHandler, UpdateClientHandler, DeleteClientHandler, GiveMeClientHandler, GiveMeAllClientHandler};
class ClientService{
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

	public function createClient($data)
	{
		$this->createClientHandler->handle($data);
	}
	
	public function updateClient($data, $id)
	{
		$this->updateClientHandler->handle($data, $id);
	}
	
	public function deleteClient($id)
	{
		$this->deleteClientHandler->handle($id);
	}
	
	public function getClients()
	{
		return $this->giveMeAllClientHandler->handle();
	}

	public function getClient($id)
	{
		return $this->giveMeClientHandler->handle($id);
	}
}
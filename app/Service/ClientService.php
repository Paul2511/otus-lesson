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

	public createClient($request)
	{
		$this->createClientHandler->handle($request);
	}
	
	public updateClient($request, $id)
	{
		$this->updateClientHandler->handle($request, $id);
	}
	
	public deleteClient($id)
	{
		$this->deleteClientHandler->handle($id);
	}
	
	public giveMeAllClient()
	{
		return $this->giveMeAllClientHandler->handle();
	}

	public giveMeClient($id)
	{
		return $this->giveMeClientHandler->handle($id);
	}
}
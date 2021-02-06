<?php
namespace App\Service\Handlers;
use App\Models\Client;
use App\Repositories\EloquentClientRepository;

class DeleteClientHandler implements HandlerInterface
{
	private $clientRepository;

	public function __construct(EloquentClientRepository $clientRepository){
		$this->clientRepository = $clientRepository;
	}

    public function handle($id)
    {
    	return $this->clientRepository->delete($id);
    }
}
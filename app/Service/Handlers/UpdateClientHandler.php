<?php
namespace App\Service\Handlers;
use App\Models\Client;
use App\Repositories\EloquentClientRepository;

class UpdateClientHandler implements HandlerInterface
{
	private $clientRepository;

	public function __construct(EloquentClientRepository $clientRepository){
		$this->clientRepository = $clientRepository;
	}

    public function handle($data, $id)
    {
    	return $this->clientRepository->update($data, $id);
    }
}
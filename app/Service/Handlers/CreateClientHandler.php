<?php
namespace App\Service\Handlers;
use App\Models\Client;
use App\Repositories\EloquentClientRepository;

class CreateClientHandler implements HandlerInterface
{
	private $clientRepository;

	public function __construct(EloquentClientRepository $clientRepository){
		$this->clientRepository = $clientRepository;
	}

    public function handle(Request $request)
    {
    	$data = $request->only($this->clientRepository->getModel()->fillable);
    	return $this->clientRepository->create($data);
    }
}
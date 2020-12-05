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

    public function handle(Request $request, $id)
    {
    	$data = $request->only($this->clientRepository->getModel()->fillable);
    	return $this->clientRepository->update($data, $id);
    }
}
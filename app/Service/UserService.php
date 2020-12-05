<?php
namespace App\Service;
use App\Service\Handlers\{CreateUserHandler, UpdateUserHandler, DeleteUserHandler, GiveMeUserHandler, GiveMeAllUserHandler};
class UserService{
	protected $createUserHandler;
    protected $updateUserHandler;
    protected $deleteUserHandler;
    protected $giveMeUserHandler;
    protected $giveMeAllUserHandler;

	public function __construct(CreateUserHandler $createUserHandler, UpdateUserHandler $updateUserHandler, DeleteUserHandler $deleteUserHandler, GiveMeUserHandler $giveMeUserHandler, GiveMeAllUserHandler $giveMeAllUserHandler)
	{
        $this->createUserHandler = $createUserHandler;
        $this->updateUserHandler = $updateUserHandler;
        $this->deleteUserHandler = $deleteUserHandler;
        $this->giveMeUserHandler = $giveMeUserHandler;
        $this->giveMeAllUserHandler = $giveMeAllUserHandler;
	}

	public createUser($request)
	{
		$this->createUserHandler->handle($request);
	}
	
	public updateUser($request, $id)
	{
		$this->updateUserHandler->handle($request, $id);
	}
	
	public deleteUser($id)
	{
		$this->deleteUserHandler->handle($id);
	}
	
	public giveMeAllUser()
	{
		return $this->giveMeAllUserHandler->handle();
	}

	public giveMeUser($id)
	{
		return $this->giveMeUserHandler->handle($id);
	}
}
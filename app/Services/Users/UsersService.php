<?php

namespace App\Services\Users;

use App\Models\User;
use App\Services\Users\DTO\CreateUserDTO;
use App\Services\Users\DTO\UpdateUserDTO;
use App\Services\Users\Handlers\CreateUserHandler;
use App\Services\Users\Handlers\UpdateUserHandler;
use App\Services\Users\Handlers\ShowUsersHandler;
use App\Services\Users\Translators\UserStatusesTranslator;
use App\Services\Users\Handlers\ShowRootUsersHandler;
use App\Http\Requests\Admin\AdminUsersStoreRequest;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\Admin\AdminBaseController;

class UsersService {
    
    private CreateUserHandler $createUserHandler;
    private UpdateUserHandler $updateUserHandler;
    private UserStatusesTranslator $categoryStatusesTranslator;
    private ShowUsersHandler $showUsersHandler;
    
    public function __construct(
            UpdateUserHandler $updateUserHandler,
            CreateUserHandler $createUserHandler,
            UserStatusesTranslator $categoryStatusesTranslator,
            ShowUsersHandler $showUsersHandler
            ) {
        $this->createUserHandler = $createUserHandler;
        $this->updateUserHandler = $updateUserHandler;
        $this->categoryStatusesTranslator = $categoryStatusesTranslator;
        $this->showUsersHandler = $showUsersHandler;
    }
    public function showUserList(){
        return $this->showUsersHandler->getUsersList();;
    }
    
    public function createUser(CreateUserDTO $createUserDTO):User{
        return $this->createUserHandler->handler($createUserDTO);
    }
    
    public function translateStatuses(string $lang):array
    {
        return $this->categoryStatusesTranslator->translator($lang);
    }
    
    public function updateUser(UpdateUserDTO $updateUserDTO){
        $this->updateUserHandler->handler($updateUserDTO);
    }
}

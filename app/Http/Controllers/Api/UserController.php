<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserUpdateRequest;
use App\Http\Resources\Pet\PetResource;
use App\Http\Resources\User\UserResource;
use App\Models\Pet;
use App\Services\Pets\PetService;
use App\Services\Users\DTO\UserUpdateData;
use App\Services\Users\UserService;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class UserController extends Controller
{
    /**
     * @var UserService
     */
    private $usersService;
    /**
     * @var PetService
     */
    private $petService;

    public function __construct(
        UserService $usersService,
        PetService $petService
    )
    {
        $this->usersService = $usersService;
        $this->middleware('auth.jwt:api');

        //Один метод вместо $this->authorize
        $this->authorizeResource(User::class, 'user');
        $this->petService = $petService;
    }

    /**
     * Отображает список всех пользователей
     */
    public function index(): JsonResource
    {
        //
    }


    /**
     * Отображение одного пользователя
     */
    public function show(User $user): JsonResource
    {
        $user = $this->usersService->findUser($user->id);

        return new UserResource($user);
    }

    /**
     * @throws \App\Exceptions\User\UserUpdateException
     */
    public function update(UserUpdateRequest $request, User $user): JsonResponse
    {
        $data = UserUpdateData::fromRequest($request);

        $user = $this->usersService->updateUser($user, $data);

        $message = [
            'message'=>[
                'title'=>trans('form.message.successTitle'),
                'text'=>trans('form.message.successText')]
        ];

        return (new UserResource($user))
            ->additional($message)
            ->response()
            ->setStatusCode(self::JSON_STATUS_ACCEPTED);
    }

    /**
     * @throws AuthorizationException
     * @throws \App\Exceptions\Client\ClientNotFoundException
     */
    public function pets(User $user): JsonResource
    {
        if (!$this->authorize('relations', User::class)) {
            throw new AuthorizationException();
        }

        $pets = $this->petService->getUserPets($user);

        return PetResource::collection($pets);
    }

}

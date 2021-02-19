<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pet\PetGetRequest;
use App\Http\Requests\User\UserGetRequest;
use App\Http\Requests\User\UserRegisterRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Http\Resources\Comment\CommentResource;
use App\Http\Resources\Pet\PetCollection;
use App\Http\Resources\Pet\PetResource;
use App\Http\Resources\Specialization\SpecializationResource;
use App\Http\Resources\User\UserCollection;
use App\Http\Resources\User\UserResource;
use App\Models\Pet;
use App\Services\Pets\PetService;
use App\Services\Users\DTO\UserRegisterData;
use App\Services\Users\DTO\UserUpdateData;
use App\Services\Users\UserService;
use App\Models\User;
use App\States\User\Role\ClientUserRole;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class UserController extends Controller
{
    /**
     * @var UserService
     */
    private $userService;
    /**
     * @var PetService
     */
    private $petService;

    public function __construct(
        UserService $userService,
        PetService $petService
    )
    {
        $this->userService = $userService;
        $this->middleware('auth.jwt:api');

        //Один метод вместо $this->authorize
        $this->authorizeResource(User::class, 'user');
        $this->petService = $petService;
    }

    /**
     * @throws AuthorizationException
     */
    public function list(UserGetRequest $request): JsonResource
    {
        if (!$this->authorize('list', User::class)) {
            throw new AuthorizationException();
        }

        $perPage = $request->get('per_page', self::RESULTS_PER_PAGE);

        $users = $this->userService->getUsers($perPage, true);

        return new UserCollection($users);
    }


    /**
     * Отображение одного пользователя
     */
    public function show(User $user): JsonResource
    {
        $user = $this->userService->findUser($user->id);

        return new UserResource($user);
    }

    /**
     * @throws \App\Exceptions\User\UserUpdateException
     */
    public function update(UserUpdateRequest $request, User $user): JsonResponse
    {
        $data = UserUpdateData::fromRequest($request);

        $user = $this->userService->updateUser($user, $data);

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
    public function pets(PetGetRequest $request, User $user): JsonResource
    {
        if (!$this->authorize('relations', User::class)) {
            throw new AuthorizationException();
        }

        $perPage = $request->get('per_page', self::RESULTS_PER_PAGE);

        $pets = $this->petService->getPets($user, $perPage, true);

        return new PetCollection($pets);
    }

    /**
     * @throws AuthorizationException
     */
    public function comments(User $user): JsonResource
    {
        if (!$this->authorize('comments', User::class)) {
            throw new AuthorizationException();
        }

        return CommentResource::collection($user->comments);
    }

    /**
     * @throws \App\Exceptions\User\UserRegisterException
     */
    public function store(UserRegisterRequest $request, UserService $userService): JsonResponse
    {
        $userData = UserRegisterData::fromRequest($request);
        $user = $userService->registerUser($userData);

        $message = [
            'message'=>[
                'title'=>trans('form.message.successTitle'),
                'text'=>trans('form.message.successText')]
        ];

        return (new UserResource($user))
            ->additional($message)
            ->response()
            ->setStatusCode(self::JSON_STATUS_CREATED);

    }

}

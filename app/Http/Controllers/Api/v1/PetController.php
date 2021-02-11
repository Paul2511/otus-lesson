<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pet\PetCreateRequest;
use App\Http\Requests\Pet\PetGetRequest;
use App\Http\Requests\Pet\PetUpdateRequest;
use App\Http\Resources\Pet\PetCollection;
use App\Http\Resources\Pet\PetResource;
use App\Models\Pet;
use App\Models\User;
use App\Services\Pets\DTO\PetCreateData;
use App\Services\Pets\DTO\PetUpdateData;
use Illuminate\Auth\Access\AuthorizationException;
use \Illuminate\Http\JsonResponse;
use App\Services\Pets\PetService;
use Illuminate\Http\Resources\Json\JsonResource;

class PetController extends Controller
{
    /**
     * @var PetService
     */
    private $petService;

    public function __construct(
        PetService $petService
    )
    {
        $this->petService = $petService;
        $this->middleware('auth.jwt:api');

        $this->authorizeResource(Pet::class, 'pet');
    }

    /**
     * Возвращает питомцев залогиненного пользователя
     * @throws \App\Exceptions\Client\ClientNotFoundException
     */
    public function index(): JsonResource
    {
        /** @var User $user */
        $user = auth()->user();
        $pets = $this->petService->getPets($user);

        return PetResource::collection($pets);
    }

    /**
     * Возвращает всех питомцев
     * @throws AuthorizationException
     * @throws \App\Exceptions\Client\ClientNotFoundException
     */
    public function list(PetGetRequest $request): JsonResource
    {
        if (!$this->authorize('list', Pet::class)) {
            throw new AuthorizationException();
        }

        $perPage = $request->get('per_page', self::RESULTS_PER_PAGE);

        $pets = $this->petService->getPets(null, $perPage, true);

        return new PetCollection($pets);
    }


    public function show(Pet $pet): JsonResource
    {
        return new PetResource($pet);
    }

    /**
     * @throws \App\Exceptions\Client\ClientNotFoundException
     * @throws \App\Exceptions\Pet\PetCreateException
     */
    public function store(PetCreateRequest $request)
    {
        $data = PetCreateData::fromRequest($request);

        $pet = $this->petService->createPet($data);

        $message = [
            'message'=>[
                'title'=>trans('form.message.successTitle'),
                'text'=>trans('form.message.successText')]
        ];

        return (new PetResource($pet))
            ->additional($message)
            ->response()
            ->setStatusCode(self::JSON_STATUS_CREATED);
    }

    /**
     * @throws \App\Exceptions\Pet\PetUpdateException
     */
    public function update(PetUpdateRequest $request, Pet $pet)
    {
        $data = PetUpdateData::fromRequest($request);

        $pet = $this->petService->updatePet($pet, $data);

        $message = [
            'message'=>[
                'title'=>trans('form.message.successTitle'),
                'text'=>trans('form.message.successText')]
        ];

        return (new PetResource($pet))
            ->additional($message)
            ->response()
            ->setStatusCode(self::JSON_STATUS_ACCEPTED);
    }

    /**
     * @throws \App\Exceptions\Pet\PetDeleteException
     */
    public function destroy(Pet $pet): JsonResponse
    {
        $this->petService->deletePet($pet);

        $message = [
            'message'=>[
                'title'=>trans('form.message.successDeleteTitle'),
                'text'=>trans('form.message.successDeleteText')]
        ];

        return response()->json($message);
    }
}

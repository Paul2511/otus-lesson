<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use App\Models\User;
use Illuminate\Http\Request;
use \Illuminate\Http\JsonResponse;
use App\Services\Pets\PetService;
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

        //Один метод вместо $this->authorize
        $this->authorizeResource(Pet::class, 'pet');
    }

    /**
     * @param User $user
     * @return JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(User $user): JsonResponse
    {
        $result = $this->petService->getUserPets($user->id);
        return response()->json($result);
    }


    /**
     * @param Pet $pet
     * @return JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Pet $pet)
    {
        $result = $this->petService->deletePet($pet);
        return response()->json($result);
    }
}

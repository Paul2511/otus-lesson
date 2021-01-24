<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\ViewModels\Pet\PetDestroyViewModel;
use App\Http\ViewModels\Pet\PetIndexViewModel;
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

        $this->authorizeResource(Pet::class, 'pet');
    }

    public function index(User $user): JsonResponse
    {
        $pets = $this->petService->getUserPets($user);

        $viewModel = new PetIndexViewModel($pets);

        return $viewModel->json();
    }


    public function destroy(Pet $pet)
    {
        $this->petService->deletePet($pet);

        $viewModel = new PetDestroyViewModel();
        return $viewModel->json();
    }
}

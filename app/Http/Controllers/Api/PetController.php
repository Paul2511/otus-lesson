<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
    }

    public function index(int $userId): JsonResponse
    {
        $result = $this->petService->getUserPets($userId);
        return response()->json($result);
    }


    /**
     * @param $id
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $result = $this->petService->deletePet($id);
        return response()->json($result);
    }
}

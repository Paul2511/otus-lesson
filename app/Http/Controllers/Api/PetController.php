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
    }

    public function index(Request $request): JsonResponse
    {
        $userId = $request['user_id'] ?? null;
        $result = $this->petService->getPets($userId);
        return response()->json($result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function show(int $id): JsonResponse
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

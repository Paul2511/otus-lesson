<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\PetType\PetTypeGetRequest;
use App\Http\Requests\PetType\PetTypeRequest;
use App\Http\Resources\PetType\PetTypeCollection;
use App\Http\Resources\PetType\PetTypeResource;
use App\Models\PetType;
use App\Services\PetTypes\DTO\PetTypeDTO;
use App\Services\PetTypes\PetTypeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
class PetTypeController extends Controller
{
    /**
     * @var PetTypeService
     */
    private $petTypeService;

    public function __construct(
        PetTypeService $petTypeService
    )
    {
        $this->middleware('auth.jwt:api');
        $this->authorizeResource(PetType::class, 'petType');
        $this->petTypeService = $petTypeService;
    }

    public function index(PetTypeGetRequest $request): JsonResource
    {
        $perPage = $request->get('per_page', self::RESULTS_PER_PAGE);

        $petTypes = $this->petTypeService->getAll($perPage);

        return new PetTypeCollection($petTypes);
    }

    /**
     * @throws \App\Exceptions\PetType\PetTypeCreateException
     */
    public function store(PetTypeRequest $request): JsonResponse
    {
        $data = PetTypeDTO::fromRequest($request);

        $petType = $this->petTypeService->create($data);

        $message = [
            'message'=>[
                'title'=>trans('form.message.successTitle'),
                'text'=>trans('form.message.successText')]
        ];

        return (new PetTypeResource($petType))
            ->additional($message)
            ->response()
            ->setStatusCode(self::JSON_STATUS_CREATED);
    }

    /**
     * @throws \App\Exceptions\PetType\PetTypeUpdateException
     */
    public function update(PetTypeRequest $request, PetType $petType): JsonResponse
    {
        $data = PetTypeDTO::fromRequest($request);

        $petType = $this->petTypeService->update($petType, $data);

        $message = [
            'message'=>[
                'title'=>trans('form.message.successTitle'),
                'text'=>trans('form.message.successText')]
        ];

        return (new PetTypeResource($petType))
            ->additional($message)
            ->response()
            ->setStatusCode(self::JSON_STATUS_ACCEPTED);
    }

    /**
     * @throws \App\Exceptions\PetType\PetTypeDeleteException
     */
    public function destroy(PetType $petType): JsonResponse
    {
        $this->petTypeService->delete($petType);

        $message = [
            'message'=>[
                'title'=>trans('form.message.successDeleteTitle'),
                'text'=>trans('form.message.successDeleteText')]
        ];

        return response()->json($message);
    }
}

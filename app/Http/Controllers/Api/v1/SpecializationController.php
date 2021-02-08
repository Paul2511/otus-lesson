<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Specialization\SpecializationGetRequest;
use App\Http\Requests\Specialization\SpecializationRequest;
use App\Http\Resources\Specialization\SpecializationCollection;
use App\Http\Resources\Specialization\SpecializationResource;
use App\Models\Specialization;
use App\Services\Specializations\DTO\SpecializationDTO;
use App\Services\Specializations\SpecializationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
class SpecializationController extends Controller
{
    /**
     * @var SpecializationService
     */
    private $specializationService;

    public function __construct(
        SpecializationService $specializationService
    )
    {
        $this->middleware('auth.jwt:api');
        $this->authorizeResource(Specialization::class, 'specialization');
        $this->specializationService = $specializationService;
    }

    public function index(SpecializationGetRequest $request): JsonResource
    {
        $perPage = $request->get('per_page', self::RESULTS_PER_PAGE);

        $specializations = $this->specializationService->getAll($perPage);

        return new SpecializationCollection($specializations);
    }

    /**
     * @throws \App\Exceptions\Specialization\SpecializationCreateException
     */
    public function store(SpecializationRequest $request): JsonResponse
    {
        $data = SpecializationDTO::fromRequest($request);

        $specialization = $this->specializationService->create($data);

        $message = [
            'message'=>[
                'title'=>trans('form.message.successTitle'),
                'text'=>trans('form.message.successText')]
        ];

        return (new SpecializationResource($specialization))
            ->additional($message)
            ->response()
            ->setStatusCode(self::JSON_STATUS_CREATED);
    }

    /**
     * @throws \App\Exceptions\Specialization\SpecializationUpdateException
     */
    public function update(SpecializationRequest $request, Specialization $specialization): JsonResponse
    {
        $data = SpecializationDTO::fromRequest($request);

        $specialization = $this->specializationService->update($specialization, $data);

        $message = [
            'message'=>[
                'title'=>trans('form.message.successTitle'),
                'text'=>trans('form.message.successText')]
        ];

        return (new SpecializationResource($specialization))
            ->additional($message)
            ->response()
            ->setStatusCode(self::JSON_STATUS_ACCEPTED);
    }

    /**
     * @throws \App\Exceptions\Specialization\SpecializationDeleteException
     */
    public function destroy(Specialization $specialization): JsonResponse
    {
        $this->specializationService->delete($specialization);

        $message = [
            'message'=>[
                'title'=>trans('form.message.successDeleteTitle'),
                'text'=>trans('form.message.successDeleteText')]
        ];

        return response()->json($message);
    }
}

<?php

namespace App\Http\Controllers\Api\Surveys;

use App\Http\Controllers\Api\Surveys\Request\ApiSurveysIndexRequest;
use App\Http\Controllers\Api\Surveys\Resources\SurveyListItemResource;
use App\Http\Controllers\Controller;
use App\Models\Survey;
use App\Services\Surveys\SurveysService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Permission;

class ApiSurveysController extends Controller
{
    public const DEFAULT_API_RESPONSE_SIZE = 5;

    private SurveysService $surveysService;
    private string $model = Survey::class;

    public function __construct(SurveysService $surveysService)
    {
        $this->surveysService = $surveysService;
    }

    public function index(ApiSurveysIndexRequest $request): JsonResponse
    {
        $this->authorize(Permission::VIEW_ANY, $this->model);

        $limit = (int)$request->get('limit', static::DEFAULT_API_RESPONSE_SIZE);
        $offset = (int)$request->get('offset', 0);

        return response()->json($this->surveysService->getAll($limit, $offset));
    }

    public function list(ApiSurveysIndexRequest $request): JsonResponse
    {
        $this->authorize(Permission::VIEW_ANY, $this->model);

        $limit = (int)$request->get('limit', static::DEFAULT_API_RESPONSE_SIZE);
        $offset = (int)$request->get('offset', 0);

        $surveys = $this->surveysService->getAll($limit, $offset);

        return response()->json(SurveyListItemResource::collection($surveys));
    }

    public function store(Request $request): JsonResponse
    {
        $this->authorize(Permission::CREATE, $this->model);
        $survey = $this->surveysService->createFromArray($request->all());

        return response()->json(new SurveyListItemResource($survey));
    }

    public function show(Survey $survey): JsonResponse
    {
        $this->authorize(Permission::VIEW, $survey);

        return response()->json(new SurveyListItemResource($survey));
    }

    public function update(Request $request, Survey $survey): JsonResponse
    {
        $this->authorize(Permission::UPDATE, $survey);
        $survey = $this->surveysService->update($survey, $request->all());

        return response()->json(new SurveyListItemResource($survey));
    }

    public function destroy(Survey $survey): JsonResponse
    {
        $this->authorize(Permission::DELETE, $survey);
        $result = $this->surveysService->delete($survey);

        return response()->json(compact('result'));
    }
}

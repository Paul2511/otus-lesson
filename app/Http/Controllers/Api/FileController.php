<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\File\ImageUploadRequest;
use App\Http\ViewModels\File\UploadImageViewModel;
use App\Services\Files\DTO\UploadImageData;
use App\Services\Files\FileService;
use \Illuminate\Http\JsonResponse;
class FileController extends Controller
{
    /**
     * @var FileService
     */
    private $fileService;

    public function __construct(
        FileService $fileService
    )
    {
        $this->middleware('auth.jwt:api');
        $this->fileService = $fileService;
    }

    /**
     * Загрузка одного изображения
     */
    public function uploadImage(ImageUploadRequest $request): JsonResponse
    {
        $uploadData = UploadImageData::fromRequest($request);
        $imageData = $this->fileService->uploadImage($uploadData);

        $viewModel = new UploadImageViewModel($imageData);
        return $viewModel->json();
    }
}

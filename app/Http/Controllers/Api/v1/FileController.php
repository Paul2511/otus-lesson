<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\File\ImageUploadRequest;
use App\Http\Resources\File\FileResource;
use App\Services\Files\DTO\UploadImageData;
use App\Services\Files\FileService;
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
    public function uploadImage(ImageUploadRequest $request)
    {
        $uploadData = UploadImageData::fromRequest($request);
        $imageData = $this->fileService->uploadImage($uploadData);

        return new FileResource($imageData);
    }
}

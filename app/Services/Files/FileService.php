<?php


namespace App\Services\Files;

use App\Services\Files\DTO\ImageData;
use App\Services\Files\DTO\UploadImageData;
use Illuminate\Http\UploadedFile;
use App\Services\Files\Helpers\UploadHelper;
use App\Services\Files\Repositories\FileRepository;
use App\Services\Files\Handlers\FileDeleteHandler;
use App\Services\Files\Handlers\CreateThumbnailHandler;
use Storage;
class FileService
{
    /**
     * @var FileDeleteHandler
     */
    protected $fileDeleteHandler;
    /**
     * @var FileRepository
     */
    protected $fileRepository;
    /**
     * @var CreateThumbnailHandler
     */
    private $createThumbnailHandler;

    public function __construct(
        CreateThumbnailHandler $createThumbnailHandler,
        FileDeleteHandler $fileDeleteHandler,
        FileRepository $fileRepository
    )
    {
        $this->fileDeleteHandler = $fileDeleteHandler;
        $this->fileRepository = $fileRepository;
        $this->createThumbnailHandler = $createThumbnailHandler;
    }


    public function uploadImage(UploadImageData $uploadData): ImageData
    {
        $uploadPath = str_replace('.', '/', $uploadData->uploadPath);
        $filePath = $uploadPath . '/' . $uploadData->id;

        $file = $uploadData->file;
        $path = $file->store($filePath, $uploadData->disk);

        $imageSize = getimagesize($file->path()) ?? [];
        return ImageData::fromArray([
            'disk' => $uploadData->disk,
            'path'=>$path,
            'src' => Storage::url($path),
            'mime'=>$file->getMimeType(),
            'originalFileName'=>$file->getClientOriginalName(),
            'width' => $imageSize[0] ?? 0,
            'height' => $imageSize[1] ?? 0
        ]);
    }

    public function getAllFiles(?string $disk=null): array
    {
        $files = $this->fileRepository->getAllFiles($disk);

        $files = collect($files)->filter(function ($file){
            return $file !== '.gitignore';
        });

        return $files->toArray();
    }

    public function createThumbnail(ImageData $file): ?string
    {
        $original = $this->fileRepository->getFile($file->path, $file->disk);

        if ($original) {
            $newFileName = UploadHelper::getThumbFileName($file->path);
            $result = $this->createThumbnailHandler->handle($original, $newFileName, $file->disk);
            if ($result) {
                return $newFileName;
            }
        }

        return null;
    }
}
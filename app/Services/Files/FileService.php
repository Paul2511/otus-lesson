<?php


namespace App\Services\Files;

use App\Services\BaseService;
use App\Services\Files\DTO\ImageData;
use Illuminate\Http\UploadedFile;
use App\Services\Files\Helpers\UploadHelper;
use Intervention\Image\Exception\ImageException;
use Intervention\Image\Facades\Image;
use App\Services\Files\Repositories\FileRepository;
use App\Services\Files\Handlers\FileDeleteHandler;
use App\Services\Files\Handlers\CreateThumbnailHandler;
use Storage;
class FileService extends BaseService
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


    public function uploadImage(UploadedFile $file, ?array $data=[], ?string $disk=null): array
    {
        $disk = $disk ?? config('filesystems.default');
        $filePath = UploadHelper::getUploadPathFromArray($data);

        $path = $file->store($filePath, $disk);

        $imageSize = getimagesize($file->path()) ?? [];

        $result = ImageData::fromArray([
            'disk' => $disk,
            'path'=>$path,
            'src' => Storage::url($path),
            'mime'=>$file->getMimeType(),
            'originalFileName'=>$file->getClientOriginalName(),
            'width' => $imageSize[0] ?? 0,
            'height' => $imageSize[1] ?? 0
        ]);

        return [
            'fileData'=>$result,
            'success'=>true
        ];
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
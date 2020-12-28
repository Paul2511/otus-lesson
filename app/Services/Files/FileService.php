<?php


namespace App\Services\Files;

use App\Services\BaseService;
use Illuminate\Http\UploadedFile;
use App\Helpers\UploadHelper;
use Storage;
class FileService extends BaseService
{

    public function uploadImage(UploadedFile $file, ?array $data=[], ?string $disk = 'public'): array
    {
        $filePath = UploadHelper::getPathFromData($data);

        $path = $file->store($filePath, $disk);

        $imageSize = getimagesize($file->path()) ?? [];

        $result = [
            'disk' => $disk,
            'path'=>$path,
            'src' => Storage::url($path),
            'mime'=>$file->getMimeType(),
            'originalFileName'=>$file->getClientOriginalName(),
            'width' => $imageSize[0] ?? '-',
            'height' => $imageSize[1] ?? '-'
        ];

        return [
            'fileData'=>$result,
            'success'=>true
        ];
    }
}
<?php


namespace App\Services\Files\DTO;

use App\Http\Requests\File\ImageUploadRequest;
use App\Services\Files\Helpers\UploadHelper;
use Spatie\DataTransferObject\DataTransferObject;
class UploadImageData extends DataTransferObject
{
    /** @var \Illuminate\Http\UploadedFile|\Illuminate\Http\UploadedFile[]|array */
    public $file;

    public string $uploadPath;

    public string $id;

    public string $disk;

    public static function fromRequest(ImageUploadRequest $request): self
    {
        return new self([
            'file'=>$request->file('image'),
            'uploadPath'=>$request->get('uploadPath', UploadHelper::DEFAULT_UPLOAD_PATH),
            'id'=>(string)$request->get('id', UploadHelper::DEFAULT_UPLOAD_ID),
            'disk'=>$request->get('disk', config('filesystems.default')),
        ]);
    }
}
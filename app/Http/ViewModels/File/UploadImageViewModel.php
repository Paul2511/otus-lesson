<?php


namespace App\Http\ViewModels\File;

use App\Http\ViewModels\ViewModel;
use App\Services\Files\DTO\ImageData;

class UploadImageViewModel extends ViewModel
{
    public function __construct(ImageData $imageData)
    {
        $this->data['fileData'] = $imageData->toArray();
    }
}
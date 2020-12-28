<?php

namespace App\Http\Requests\File;

use App\Http\Requests\ApiRequest;
class ImageUploadRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        $max = config('filesystems.maxsize.image', 2048);
        return [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:'.$max,
        ];
    }
}

<?php


namespace App\Http\Requests\PetType;

use App\Http\Requests\ApiRequest;
class PetTypeRequest extends ApiRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'slug' => ['required'],
            'translates' => ['array']
        ];
    }
}
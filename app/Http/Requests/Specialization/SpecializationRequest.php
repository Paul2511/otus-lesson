<?php


namespace App\Http\Requests\Specialization;

use App\Http\Requests\ApiRequest;
class SpecializationRequest extends ApiRequest
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
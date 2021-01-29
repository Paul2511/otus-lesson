<?php

namespace App\Http\Requests\Pet;

use App\States\Pet\Sex\PetSex;
use App\Http\Requests\ApiRequest;
use Spatie\ModelStates\Validation\ValidStateRule;
class PetCreateRequest extends ApiRequest
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
        return [
            'name' => ['required'],
            'pet_type_id' => ['required','exists:\App\Models\PetType,id'],
            'sex' => [
                'required',
                'string',
                new ValidStateRule(PetSex::class)
            ]
        ];
    }
}

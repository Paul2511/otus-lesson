<?php

namespace App\Http\Requests\Pet;

use App\States\Pet\Sex\PetSex;
use App\Http\Requests\ApiRequest;
use Spatie\ModelStates\Validation\ValidStateRule;
class PetUpdateRequest extends ApiRequest
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
            'pet_type_id' => ['exists:\App\Models\PetType,id'],
            'sex' => [
                new ValidStateRule(PetSex::class)
            ],
            'photo' => ['array']
        ];
    }
}

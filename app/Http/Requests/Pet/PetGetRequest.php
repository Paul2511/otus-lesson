<?php


namespace App\Http\Requests\Pet;

use App\Http\Requests\ApiGetRequest;
use Illuminate\Validation\Rule;

class PetGetRequest extends ApiGetRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        $rules = parent::rules();
        $rules['sort'] = [
            Rule::in(['id', 'name', 'client_id', 'pet_type_id', 'sex', 'created_at'])
        ];

        return $rules;
    }
}
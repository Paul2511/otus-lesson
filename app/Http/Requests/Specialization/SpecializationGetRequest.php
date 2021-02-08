<?php


namespace App\Http\Requests\Specialization;

use App\Http\Requests\ApiGetRequest;
use Illuminate\Validation\Rule;

class SpecializationGetRequest extends ApiGetRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        $rules = parent::rules();
        $rules['sort'] = [
            Rule::in(['id', 'slug'])
        ];

        return $rules;
    }
}
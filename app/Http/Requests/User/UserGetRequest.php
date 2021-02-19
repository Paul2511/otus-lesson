<?php


namespace App\Http\Requests\User;

use App\Http\Requests\ApiGetRequest;
use Illuminate\Validation\Rule;

class UserGetRequest extends ApiGetRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        $rules = parent::rules();
        $rules['sort'] = [
            Rule::in(['id', 'name', 'role', 'status', 'email', 'created_at'])
        ];

        return $rules;
    }
}
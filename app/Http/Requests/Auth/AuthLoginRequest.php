<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\ApiRequest;
class AuthLoginRequest extends ApiRequest
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
            'email' => ['required'],
            'password' => ['required']
        ];
    }
}

<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\ApiRequest;
class AuthForgotPasswordRequest extends ApiRequest
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
            'email' => ['required', 'email', 'exists:\App\Models\User,email'],
        ];
    }

    public function messages()
    {
        return [
            'email.exists' => trans('user.emailNotFound')
        ];
    }
}

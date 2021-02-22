<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\ApiRequest;
class AuthResetPasswordRequest extends ApiRequest
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
            'token' => ['required'],
            'email' => ['required', 'email', 'exists:\App\Models\User,email'],
            'password' => ['required', 'confirmed', 'string', 'min:5'],
            'password_confirmation' => ['required', 'string', 'min:5']
        ];
    }

    public function messages()
    {
        return [
            'email.exists' => trans('user.emailNotFound')
        ];
    }
}

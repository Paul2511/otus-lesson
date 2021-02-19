<?php

namespace App\Http\Requests\User;

use App\Services\Localise\Locale;
use App\States\User\Role\UserRole;
use Illuminate\Validation\Rule;
use App\Http\Requests\ApiRequest;
use Spatie\ModelStates\Validation\ValidStateRule;
class UserRegisterRequest extends ApiRequest
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
            'password' => ['required', 'string', 'min:5', 'confirmed'],
            'password_confirmation' => ['required', 'string', 'min:5'],
            'email' => ['email','required','unique:users'],
            'role' => [
                new ValidStateRule(UserRole::class)
            ],
            'locale' => [
                Rule::in(Locale::$availableLocales)
            ]
        ];
    }

    public function messages()
    {
        return [
            'email.unique' => trans('user.emailExists')
        ];
    }
}

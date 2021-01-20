<?php

namespace App\Http\Requests\User;

use App\Services\Localise\Locale;
use App\Services\Users\Helpers\UserLabelsHelper;
use Illuminate\Validation\Rule;
use App\Http\Requests\ApiRequest;
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
            'password' => 'required|min:5',
            'email' => ['email','required','unique:users'],
            'role' => [
                Rule::in(array_keys(UserLabelsHelper::roleLabels()))
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

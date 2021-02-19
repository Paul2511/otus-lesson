<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\Rules\MatchOldPassword;
use App\Models\User;
use App\Http\Requests\ApiRequest;
class AuthChangePasswordRequest extends ApiRequest
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
        /** @var User $my */
        $my = auth()->user();

        $userId = $this->get('userId');

        $rules = [
            'newPassword' => ['required', 'confirmed', 'string', 'min:5'],
            'newPassword_confirmation' => ['required', 'string', 'min:5'],
        ];

        if (!$my->canManage || !$userId) {
            $rules['oldPassword'] = ['required', 'string', 'min:5', new MatchOldPassword];
        }

        return $rules;
    }

}

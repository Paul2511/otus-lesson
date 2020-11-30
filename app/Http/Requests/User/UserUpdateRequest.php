<?php

namespace App\Http\Requests\User;

use App\Models\User;
use Illuminate\Validation\Rule;
use App\Http\Requests\ApiRequest;
class UserUpdateRequest extends ApiRequest
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

    public function validationData()
    {
        $data = parent::validationData();

        if (isset($data['detail'])) {
            $data = array_merge($data, $data['detail']);
            unset($data['detail']);
        }

        return $data;
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'role' => ['required', 'integer', Rule::in(array_keys(User::roleLabels()))],
            'status' => ['required', 'integer', Rule::in(array_keys(User::statusLabels()))],
            'lastname' => ['string', 'nullable'],
            'firstname' => ['string' ,'nullable'],
            'middlename' => ['string','nullable']
        ];
    }
}

<?php

namespace App\Http\Requests\User;

use App\Services\Users\Helpers\UserLabelsHelper;
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
        $data = $this->validationData();
        $method = strtolower($this->method());

        return [
            'email' => [
                'email',
                Rule::requiredIf(function () use ($data, $method) {
                    return array_key_exists('email', $data) || $method !== 'patch';
                })
            ],
            'role' => [
                Rule::in(array_keys(UserLabelsHelper::roleLabels())),
                Rule::requiredIf(function () use ($data, $method) {
                    return array_key_exists('role', $data) || $method !== 'patch';
                })
            ],
            'status' => [
                'integer',
                Rule::in(array_keys(UserLabelsHelper::statusLabels())),
                Rule::requiredIf(function () use ($data, $method) {
                    return array_key_exists('status', $data) || $method !== 'patch';
                })
            ],
            'lastname' => ['string', 'nullable'],
            'firstname' => ['string' ,'nullable'],
            'middlename' => ['string','nullable']
        ];
    }
}

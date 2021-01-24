<?php

namespace App\Http\Requests\User;

use App\Models\User;
use App\Services\Localise\Locale;
use App\States\User\Status\UserStatus;
use App\Http\Requests\ApiRequest;
use Illuminate\Validation\Rule;
use Spatie\ModelStates\Validation\ValidStateRule;
class UserUpdateRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $data = $this->validationData();

        if (isset($data['status'])) {
            return \Gate::allows('updateSystem', User::class);
        }

        return true;
    }


    public function rules(): array
    {
        return [
            'status' => [
                'string',
                new ValidStateRule(UserStatus::class)
            ],
            'avatar' => ['array'],
            'locale' => [
                Rule::in(Locale::$availableLocales)
            ]
        ];
    }
}

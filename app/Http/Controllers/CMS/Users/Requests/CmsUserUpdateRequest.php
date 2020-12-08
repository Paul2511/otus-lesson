<?php


namespace App\Http\Controllers\CMS\Users\Requests;


use Illuminate\Validation\Rule;

class CmsUserUpdateRequest extends \App\Http\Requests\FormRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => ['required',Rule::unique('users')->ignore($this->user->id)]
        ];
    }
}

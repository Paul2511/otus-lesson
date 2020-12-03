<?php


namespace App\Http\Requests;

use Illuminate\Support\Arr;

class AdminUsersUpdateRequest extends FormRequest
{
    public function getFormUpdateData()
    {
        $data = $this->request->all();

        $data = Arr::except($data, [
            'password', 'confirm'
        ]);

        return $data;
    }

    public function rules()
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => __('messages.users.validate.first_name'),
            'last_name.required' => __('messages.users.validate.last_name'),
            'email.required' => __('messages.users.validate.email'),
            'phone.required' => __('messages.users.validate.phone'),
        ];
    }

}
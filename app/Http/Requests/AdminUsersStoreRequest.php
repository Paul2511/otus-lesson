<?php


namespace App\Http\Requests;

class AdminUsersStoreRequest extends FormRequest
{
    public function rules()
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'password' => 'string|min:8',
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
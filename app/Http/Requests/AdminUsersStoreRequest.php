<?php


namespace App\Http\Requests;



use Illuminate\Validation\Rule;

class AdminUsersStoreRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'full_name' => 'required|string|max:255',
            'password' => 'required|min:8',
            'email' => 'required|regex:/(.+)@(.+)\.(.+)/i|unique:users',
            'phone' => 'nullable|min:10|digits:11',
        ];
    }



    public function messages()
    {
        return [
            'first_name.required' => __('validate.full_name'),
            'email.required' => __('validate.email'),
            'phone.required' => __('validate.phone'),
            'password.required' => __('validate.password'),
        ];
    }

    public function getFormCreateData()
    {
        $data = $this->request->all();
        return $data;
    }

}

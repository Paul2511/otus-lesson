<?php


namespace App\Http\Requests;

class AdminUsersUpdateRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'full_name' => 'required|string|max:255',
            'phone' => 'nullable|digits:11',
        ];
    }



    public function messages()
    {
        return [
            'full_name.required' => __('validate.full_name'),
            'phone.required' => __('validate.phone'),
        ];
    }

    public function getFormUpdateData()
    {
        $data = $this->request->all();

        return $data;
    }

}

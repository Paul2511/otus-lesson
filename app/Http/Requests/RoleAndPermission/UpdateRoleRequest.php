<?php

namespace App\Http\Requests\RoleAndPermission;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoleRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title' => 'required|string'
        ];
    }

    public function authorize()
    {
        return true;
    }
}

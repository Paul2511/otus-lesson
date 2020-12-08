<?php


namespace App\Http\Requests;

use Arr;
use Illuminate\Foundation\Http\FormRequest;


class BaseFormRequest extends FormRequest
{
    public function rules()
    {
        return [];
    }

    public function getFormData()
    {
        $data = $this->request->all();

        $data = Arr::except($data, [
            '_token',
        ]);

        return $data;
    }

}

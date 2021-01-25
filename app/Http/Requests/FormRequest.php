<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest as BaseFormRequest;
use Illuminate\Support\Arr;

class FormRequest extends BaseFormRequest
{
    /**
     * @return mixed
     */
    public function getFormData()
    {
        $data = $this->request->all();
        $data = Arr::except($data, ['_token']);
        return $data;
    }
}

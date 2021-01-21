<?php

namespace App\Http\Requests;

use Illuminate\Support\Arr;

class FormRequest extends \Illuminate\Foundation\Http\FormRequest
{
    public function getFormData()
    {
        $data = $this->request->all();

        return Arr::except($data, [
            '_token'
        ]);
    }
}

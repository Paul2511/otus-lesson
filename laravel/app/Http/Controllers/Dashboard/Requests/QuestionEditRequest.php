<?php


namespace App\Http\Controllers\Dashboard\Requests;


use App\Http\Requests\FormRequest;

class QuestionEditRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title.ru' => 'required',
            'status' => 'required',
            'answer' => 'required|array',
        ];
    }
}

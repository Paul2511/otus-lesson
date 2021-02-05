<?php


namespace App\Http\Controllers\Dashboard\Requests;


use App\Http\Requests\FormRequest;

class QuestionCategoryEditRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title.ru' => 'required',
        ];
    }
}

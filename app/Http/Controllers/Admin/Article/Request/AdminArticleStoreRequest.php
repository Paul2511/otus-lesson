<?php


namespace App\Http\Controllers\Admin\Article\Request;


use App\Http\Requests\FormRequest;

class AdminArticleStoreRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'description' => 'required|max:1000',
            'meta_title' => 'required|max:255',
            'meta_description' => 'required|max:255',
        ];
    }


}

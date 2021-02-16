<?php


namespace App\Http\Controllers\Api\Surveys\Request;


use Illuminate\Foundation\Http\FormRequest;

class ApiSurveysIndexRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'limit' => 'nullable|integer|min:0|max:50'
        ];
    }
}

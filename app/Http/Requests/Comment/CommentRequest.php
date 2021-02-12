<?php


namespace App\Http\Requests\Comment;

use App\Http\Requests\ApiRequest;
class CommentRequest extends ApiRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'type' => ['required', 'string'],
            'row_id' => ['required', 'integer'],
            'body' => ['required', 'string'],
        ];
    }
}
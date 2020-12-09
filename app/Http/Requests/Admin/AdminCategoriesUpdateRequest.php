<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use \App\Services\Categories\DTO\UpdateCategoryDTO;

class AdminCategoriesUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'parent_id' => 'required|int',
            'title' => 'required|string|max:255',
            'status' => 'required|int|max:1'
        ];
    }
    
    public function generateUpdateCategoryDTO():UpdateCategoryDTO{
        return UpdateCategoryDTO::fromArray($this->validate());
    }
}

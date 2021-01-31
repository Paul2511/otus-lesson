<?php


namespace App\Http\Controllers\Admin\Countries\Requests;

use App\Services\Countries\DTO\UpdateCountryDTO;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCountryRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|unique:countries,name|max:255',
            'continent_name' => 'required|max:255',
            'status' => 'required|integer',
            'description' => 'nullable|max:1000'
        ];
    }

    public function generateUpdateCountryDTO(): UpdateCountryDTO
    {
        return UpdateCountryDTO::fromArray($this->validated());
    }
}

<?php


namespace App\Http\Controllers\CMS\Countries\Requests;


use App\Http\Requests\FormRequest;

class CmsCountryStoreRequest extends FormRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'country_code' => 'required|unique:countries',
            'country_name' => 'required|unique:countries'
        ];
    }
}

<?php


namespace App\Http\Controllers\Admin\Countries\Requests;

use App\Services\Countries\DTO\CreateCountryDTO;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

class StoreCountryRequest extends FormRequest
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

    public function generateCreateCountryDTO(): CreateCountryDTO
    {
        return CreateCountryDTO::fromArray($this->validated());
    }

//    public function getFormData()
//    {
//        $data = $this->request->all();
//
//        $data = Arr::except($data, [
//            '_token',
//        ]);
////        $data['created_user_id'] = Auth::id();
//
//        return $data;
//    }
}

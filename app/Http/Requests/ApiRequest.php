<?php


namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class ApiRequest extends FormRequest
{
    public function validationData()
    {
        $data = $this->all();
        return $data['data'] ?? $data;
    }

    public function getFromData() {
        $data = $this->request->all();

        return $data['data'] ?? $data;
    }

    public function rules() {}
}
<?php


namespace App\Http\Requests;


class SimpleRecordsGetRequest extends BaseFormRequest
{
    public function rules():array
    {
        return [
            'project' => 'required|int',
            'date_period' => 'required|string',
        ];
    }

    public function messages():array
    {
        return [
            'project.required' => 'Не выбран проект',
            'date_period.required' => 'Не заполнен период',
            'date_period.string' => 'Некорректный формат периода'
        ];
    }

    public function getFormData():array
    {
        $data = $this->request->all();
        return $data;
    }

}

<?php


namespace App\Http\Requests;


class ReportCallsGetRequest extends BaseFormRequest
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
        if (preg_match("/^\d{2}\.\d{2}\.\d{4}$/", $this->request->get('date_period'), $matches))
        {
            $date_start = $date_end= $this->request->get('date_period');
        } else {
            $dates = explode(' — ',$this->request->get('date_period'));
            $date_start = $dates[0];
            $date_end = $dates[1];
        }
        return $data = array(
            'project' => $this->request->get('project'),
            'date_start' => $date_start,
            'date_end' => $date_end,
        );
    }

}

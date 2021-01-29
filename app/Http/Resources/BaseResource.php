<?php


namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;
class BaseResource extends JsonResource
{
    public function toArray($request)
    {
        $result = parent::toArray($request);

        //на будущее делаем заказной вывод полей
        $fieldsRequest = $request->get('fields', null);
        if ($fieldsRequest) {
            $fields = explode(',', $fieldsRequest);
            $result = Arr::only($result, $fields);
        }

        return $result;
    }
}
<?php


namespace App\Services;


class BaseService
{
    public function success(?array $data = [], ?array $message = null): array
    {
        if (!$message) {
            $message = [
                'title'=>trans('form.message.successTitle'),
                'text'=>trans('form.message.successText')
            ];
        }
        return array_merge($data, ['success'=>true, 'message'=>$message]);
    }
}
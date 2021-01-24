<?php


namespace App\Http\ViewModels\User;

use App\Http\ViewModels\ViewModel;
use App\Models\User;
class UserUpdateViewModel extends ViewModel
{
    public function __construct(User $user)
    {
        $this->data['user'] = $user->toArray();
        $message = [
            'title'=>trans('form.message.successTitle'),
            'text'=>trans('form.message.successText')
        ];
        $this->data['message'] = $message;
    }
}
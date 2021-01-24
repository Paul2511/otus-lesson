<?php


namespace App\Http\ViewModels\User;

use App\Http\ViewModels\ViewModel;
use App\Models\User;
class UserShowViewModel extends ViewModel
{
    public function __construct(User $user)
    {
        $this->data['user'] = $user->toArray();
    }
}